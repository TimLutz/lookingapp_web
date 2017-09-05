<?php namespace repositories;

use App\User;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\models\UserBadge;
use App\models\Device;
use App\models\FlagModel;
use Cookie;
use Carbon\Carbon;

//use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class CommonRepository implements CommonRepositoryInterface
{
	/**
	  * Get Information for dashboard widgets.            
      * @return Response
	  * Created on: 1/10/2015
	  * Updated on: 15/10/2015
	**/

	public static function getinfo()
	{
		$data['users'] = User::where('role','2')->count();
		$data['profiletext'] = User::where('profiletext_change',1)->count();
    $data['photos'] = User::where(['photo_change'=>1])->count();
    $data['banuser'] = User::where(['status'=>0])->count();
    $data['reports'] = FlagModel::whereHas('flagUser',function($q){
      $q->where('status',1) ;
    })->whereHas('flagReceiverUser',function($q){
      $q->where('status',1) ;
    })->where(['archive'=>0])->orderBY('created_at','ASC')->count();

   /* $data['reports'] = DB::table('flags AS f')
                          ->join('users AS s','s.id','=','f.sender_id')
                          ->join('users AS r','r.id','=','f.receiver_id')
                          ->where(['f.archive'=>0,'r.status'=>1])
                          ->count();*/
        /*$data['reports'] = FlagModel::whereHas('flagUser',function($q){
      $q->where('status',1);
    })->whereHas('flagReceiverUser',function($q){
      $q->where('status',1);
    })->with(['flagUser'=>function($q1){
    	$q1->where(['status'=>1])->select('id','email');//->get();
    }
    ,'flagReceiverUser'=>function($q2){
    	$q2->where(['status'=>1])->select('id','email');//->get();
    }])
    ->where(['archive'=>0])
    ->orderBY('created_at','ASC')
    ->get();*/                  
		return $data;
	}

	/** Function to set size of photo **/
	public static function setPhoto($path,$width=50,$height=50){
		$url = asset('/timthumb.php?src='.$path.'&w='.$width.'&h='.$height.'&zc=2');
        return $url;
    }
    
    public static function encryptID($id = null)
    {
    	$encrypted = \Crypt::encrypt($id);
    	return $encrypted;
    }

    public static function decryptID($id = null)
    {
    	$decrypted = \Crypt::decrypt($id);
    	return $decrypted;
    }
				


   /*
	 * Added on : 06 dec 2016
	 * Added by : Jagraj Singh, Debut infotech
	 * DESC : for push notification (iOS)
	 * */	
	public function send_notification($user_data){			
		 $data['pem_path'] = base_path('../')."FrontLinePush.pem";	
		$data['message'] = $user_data['message'];//"I am checking for demo push notifications";
		$data['title'] = $user_data['title'];//"check notification on iOS";
		//$data['purpose'] = $user_data['purpose'];//"check notification on iOS";
		$data['passphrase'] = "abc123";
		$iosDevices = [];
		$androidDevices = [];
		//fetch device token from user id's sent in request
		if(!empty($user_data['user_ids'])){
			foreach($user_data['user_ids'] as $usrId){
				//check device token and type
				//$userDetails = User::where('id',$usrId)->first();	
				$device_detail = Device::where('user_id',$usrId)->first();	
				 $iosDevices = Device::where('user_id',$usrId)->lists('device_token');
					
				if(empty($device_detail)){
					return ['status'=>0,'error'=>'user does not exist'];
				}else{				
					if($device_detail->device_type == 'ios'){
						
						//$iosDevices[$usrId] = $device_detail->device_token;
						$data['device_token'] = $iosDevices;
						return $notifyIos = $this->send_notification_ios($data);
					}else{					
						return $notifyIos = $this->sendFCM($device_detail->device_token,$data['message'],$data['title'],$usrId);
					}	
				}							
			}					
		}else{
			//return error, no userids were received.
			$response['errors'] = 'Sorry, no user ids were recieved.';
            $response['status'] = 0;
		}
		return $response;
	}
	
	/*
	 * Added on : 18 nov 2016
	 * Added by : shivani, Debut infotech
	 * DESC : to send notification for ios
	 * */
	function send_notification_ios($data)
	{	
		
		$url = $_SERVER['DOCUMENT_ROOT'];

		$deviceToken = $data['device_token'];
		 
		$passphrase = $data['passphrase'];

		$message =$data['message'];
		
		$ctx = stream_context_create();
		//path to pem file.
		
		stream_context_set_option($ctx, 'ssl', 'local_cert',  $data['pem_path']);
		//pass phrase
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);	

		$count_notify = 0;
		//Getting Device Token from Database
		foreach($deviceToken as $key => $device)
		{			
			// Open a connection to the APNS server
			$fp = stream_socket_client(
				'ssl://gateway.sandbox.push.apple.com:2195', $err,
				//'ssl://gateway.push.apple.com:2195', $err,
				$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

			if (!$fp) 
				exit("Failed to connect: $err $errstr" . PHP_EOL);
				
			 'Connected to APNS' . PHP_EOL;
			 
			$badgeDetails = Device::where("device_token",$device)->first();
			$badgeCount = $badgeDetails->badge_count;
			if(!empty($badgeDetails)){
				 $badgeCount = $badgeDetails->badge_count +1;
			}
				
			//Create the payload body
			$body['aps'] = array(
					'alert' => array(
							'title'=>$data['title'],
							'body'  => $message,
						),
					'sound' => 'default',
					'content-available'=>1,
				    'badge' => $badgeCount,
				    //'notify_purpose'=>$data['purpose'],
				);
			// Encode the payload as JSON
			 $payload = json_encode($body);
			//echo $device."</br>";
			 $device_token =  $device;
			if(!empty($device_token)){
				
				$msg = chr(0) . pack('n', 32) . pack('H*',  $device_token) . pack('n', strlen($payload)) . $payload;
				$result = fwrite($fp, $msg, strlen($msg));
				if($result){		
					//update badges details					
					if(!empty($badgeDetails)){
						
						//update badge count
						$badgeDetails->update(['badge_count'=>$badgeCount]);						
					}	
					$resp['msg']  = 'Message successfully delivered';
					$resp['status'] = "1";				
				}
				else{					
					$resp['msg']  = 'Message not successfully delivered' . PHP_EOL;
					$resp['status'] = "0";	
				}
			}
			// Close the connection to the server
			fclose($fp);
		}
		
		return $resp;	
	}
    
    
    
  /*
	 * Added on : 8 dec 2016
	 * Added by : Jagraj, Debut infotech
	 * DESC : to send notification for android
	 * 
	 * */
	function sendFCM($id,$message,$title,$user_id) {
		//check badge details
		$badgeDetails = UserBadge::where("user_id",$user_id)->first();
		$badgeCount = 1;
		if(!empty($badgeDetails)){
			$badgeCount += $badgeDetails->notification_count;
		}
		$url = 'https://fcm.googleapis.com/fcm/send';
		$notification= array('title' => $title,'body' => $message,'badge' => $badgeCount);
		//$fields = array('registration_ids' => array('edPedLbZMZQ:APA91bHm8I11p08zm7E7GNhSFbF-Qpd65APPNvVH_Vn2_xi1KuWWOazA_bfEiKjWLy7fqbyv1rFDlF6mRlkm0jy1DLgm0cfRL72of_RSvF9BXSfKXSJl53RPmozaXFZQLwpiHh8IL0FH'),'notification' => $notification);
		$fields = array('registration_ids' => array((string)$id),'notification' => $notification);
		$headers = array('Authorization:key= AIzaSyAz8xB4zSDrq4CBE2dk7pAxmtP6FfmqmJo','Content-Type: application/json');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		// echo json_encode($fields);
		$result = curl_exec($ch);           
		echo curl_error($ch);
		if ($result === FALSE) {
			die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
		//update badges details					
		if(!empty($badgeDetails)){
			//update badge count
			$badgeDetails->update(["user_id"=>$user_id,'notification_count'=>$badgeCount]);						
		}else{
			//create a new record for user to save notification badge
			UserBadge::create(["user_id"=>$user_id,'notification_count'=>$badgeCount]);
		}
		return $result;
	}
	
	
	//for getting the difference between current time and time provided
  	function humanTiming ($time)
    {

        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }

    }


		//for converting the time zone to show on admin
		function converttimezone ($time)
		{
  		$servertimezone =  date_default_timezone_get();
  		$dt = Carbon::createFromFormat('Y-m-d H:i:s', $time, $servertimezone);
  		$dt->setTimezone('IST');

  		$newtime = $dt->format('Y-m-d H:i:s');
  		return $newtime; 
		}
}

?>

<?php namespace repositories;

use App\User;
use App\Quotation;
use App\Booking;
use App\Transaction;
use App\Services;
use App\Modes;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\Location;
use App\Settings;
use App\Faq;
use App\Testimonials;
use App\models\UserBadge;
use App\models\Device;
use App\Messages;
use App\models\Category;
use App\models\SubCategory;
use App\models\Product;
use App\models\Video;
use App\models\Task;
use App\Contact;
use App\Property;
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
		$data['users'] = User::where('role','2')->where('status','!=',2)->count();
		$data['tasks'] = Task::where('id','!=','')->count();
		$data['properties'] = Property::where('id','!=','')->count();
    $data['realtors'] = User::where('id','!=','')->where('type',1)->count();
		$data['both'] = User::where('id','!=','')->where('type',4)->count();
		$data['houseowners'] = User::where('id','!=','')->where('type',2)->count();
		
		//$data['quoteus'] = Quotation::where('status','!=','2')->where('type','2')->count();
		//$data['total_amount'] = Booking::where('status','!=','2')->sum('amount');
//		$data['total_amount'] = Booking::where('status','!=','2')->transactions->sum('amount');
	//	$data['total_amount'] = Transaction::where('payment_status','1')->sum('amount');
		/*$data['total_amount'] = DB::table('booking_detail')
            ->join('transactions', 'booking_detail.id', '=', 'transactions.booking_id')
            ->select('sum(transactions.amount)')
            ->where('payment_status','1')
            ->get();*/
    /* $data['total_amount'] =   DB::table('transactions')
  ->select([
    DB::raw('COALESCE(SUM(transactions.amount),0) AS amount'),
  ])
  ->leftJoin('booking_detail', 'booking_detail.id', '=', 'transactions.booking_id')
  ->where('booking_detail.status','!=','2')
  ->where('transactions.status','!=','2')
  ->first();*/

  /*$data['graphdata'] = DB::table('services')
  ->select([
    DB::raw('distinct users.id AS uid'),
  ])
  ->leftJoin('booking_detail', 'booking_detail.service_id', '=', 'services.id')
  ->leftJoin('users', 'booking_detail.user_id', '=', 'users.id')
  ->where('booking_detail.status','!=','2')
  ->where('services.status','!=','2')
  ->where('users.status','!=','2')
  ->groupBy('services.id')
            ->join('users', 'users.id', '=', 'booking_detail.user_id')
  ->get('services.name AS name');*/
  /*$data['graphdata'] = DB::table('booking_detail')
            ->leftjoin('users','users.id','=','booking_detail.user_id')
            ->where('booking_detail.status','!=','2')
		    ->where('users.status','!=','2')
		    ->groupBy('booking_detail.service_id')
            ->select(DB::raw('count(booking_detail.user_id) as users'),'booking_detail.service_id')
            ->distinct()
            ->orderBy('booking_detail.service_id','ASC')
            ->get();*/

   /*  SELECT distinct count(u.id) AS user_id, b.service_id AS service_name FROM booking_detail AS b LEFT OUTER JOIN users AS u ON u.id = b.user_id group by b.service_id*/


    
	//	print_r($data['graphdata']); 

		return $data;
	}

	
	/**
	  * Get latest notifications.            
      * @return Response
	  * Created on: 15/10/2015
	  * Updated on: 15/10/2015
	**/
	
	/*public static function getNotifications()
	{
		try
		{ 
			//Get total number of notifications
			$data['count']=Notification::where(array('owner_id'=>auth()->user()->id,'source_type'=>'story'))->get()->count();
			//Get latest Notifications
			$data['notify']=Notification::where(array('owner_id'=>auth()->user()->id,'source_type'=>'story'))->take(5)->get(array('title'));
			return $data;
		}
		catch (\Exception $e) 
		{
            $result = [
                'exception_message' => $e->getMessage()
            ];
			return view('errors.error', $result);
        }
	}*/
	
/*	public static function getGraphInfo()
	{
		$data = DB::table('booking_detail')
            ->leftjoin('services','services.id','=','booking_detail.service_id')
            ->leftjoin('users','users.id','=','booking_detail.user_id')
            ->where('booking_detail.status','!=','2')
		    ->where('services.status','!=','2')
		    ->where('users.status','!=','2')
		    ->groupBy('booking_detail.user_id')
            ->select('booking_detail.user_id','services.name','services.id As serviceid')
            ->distinct()
            ->get();
        //$services = Services::where('status','!=','2');    
    //    print_r($data); die();
        $test['Rockstar'] = 0;
        $test['Standard'] = 0;
        $test['Express'] = 0;
        
        $data1 = array();
        //print_r($data->toArray()); die();
        //$i = 0;
        foreach($data AS $data1)
        {
        echo $data1['user_id']; 

        }
die();
      //  print_r($data1);
	}*/

	/** Function to set size of photo **/
	public static function setPhoto($path,$width=50,$height=50){
		$url = asset('/timthumb.php?src='.$path.'&w='.$width.'&h='.$height.'&zc=2');
        return $url;
    }

   public static function getmodetype()
   {
      return Modes::where('status','!=','2')->get()->toArray();

   } 

   public static function getservices()
   {
      return Settings::where('status','1')->where('type','service')->groupby('title')->distinct()->get( )->toArray();   
      
   } 

   public static function getPickuplocation()
   {
    return Location::where('status','1')->where('user_id',Auth::user()->id)->get()->toArray();
   }

   public static function getDistance($origin = null,$destination = null)
    {    
      try {
          $request_url = "https://maps.googleapis.com/maps/api/distancematrix/xml?origins=".$origin."&destinations=".$destination."&sensor=true";     
//echo $destination; die();

          $xml = simplexml_load_file($request_url) or die("url not loading");// XML request
          $distance = $xml->row->element->distance->text;
          if($distance)
          {
          $distance = str_replace(array(" ","km"),"",$distance);
          $distance = str_replace(",","",$distance);
          $distance = $distance;                   
          //echo $distance = $distance/1.609344;                   
          if(!empty($distance)){
              $distn = round($distance,2);
          return $distn;
          }else {
          return 0;
          }
          } else {

          $smf= "Distance can not be calculated for this route.";
          return $smf;
          }
      } catch (Exception $e) {
          $result = [
                       'exception_message'=>$e->getMessage()   
                    ];
          return view('errors.error',$result);          
      }

    }

    public static function getRadius()
    {
      return Settings::where('status','1')->where('type','radius')->first();
    }

    public static function getAddtionalCharge($mode_id = null)
    {
      if($mode_id != '')
      {
        return Settings::where('status','1')->where('type','charges')->where('mode_type',$mode_id)->get(); 
      }
      else
      {
        return false;
      }
    }

    public static function getFullCharge($mode_id = null,$distance1=null,$distance2=null,$radius=null,$service_id = null)
    {
      if($mode_id != '' && $distance1 != '' && $distance2 != '' && $radius != '')
      {
        $addtional_charge = self::getAddtionalCharge($mode_id);
        $servicecharge = self::getFuelcharge();
        $inside = '';
        $outside = '';
        $test = '';
        foreach($addtional_charge AS $val)
        {
          if($val->title == 'inside radius')
          {
              $inside_radius_addtional_charge = $val->value;
          }
          if($val->title == 'outside radius')
          {
              $outside_radius_addtional_charge = $val->value;
          }
        }
        $add_charge = 0;
        $charge = 0;
        $total_addtional_charge = 0;
        if($radius)
        {
            
            $a = abs($distance1 - $radius->value);
            $b = abs($distance2 - $radius->value);
            $total = '';
            /**
            A: Pick address;
            B: Drop off address
            A: inside the radius B: inside the radius
            */
            $inside_radius_addtional_charge;
            if(($distance1 < $radius->value) &&($distance2 < $radius->value))
            {
                $total = (($a - $b) * $inside_radius_addtional_charge) + $servicecharge->value;
            }
             /**
            A: Pick address;
            B: Drop off address
            A: outside the radius B: outside the radius
            */
            else if(($distance1 > $radius->value) &&($distance2 > $radius->value))
            {
               $total = (($a - $b) * $outside_radius_addtional_charge) + + $servicecharge->value;
            }
            /**
            A: Pick address;
            B: Drop off address
            A: inside the radius B: outside the radius
            */
            else if(($distance1 < $radius->value) &&($distance2 > $radius->value))
            {
              $total = $a * $inside_radius_addtional_charge + $b*$outside_radius_addtional_charge + $servicecharge->value;
            }
            /**
            A: Pick address;
            B: Drop off address
            A: outside the radius B: inside the radius
            */
            else if(($distance1 > $radius->value) &&($distance2 < $radius->value))
            {
              $total = $a*$outside_radius_addtional_charge + $b*
              $inside_radius_addtional_charge + $servicecharge->value;
            }
            $services = self::getService($mode_id);
            $marcent = self::getMarcenttax();
            
            $vatdata = self::getVattax();
            if($service_id != '')
            {
                $subtotal = '';
                $vat = '';
                $marc = '';
                $martotal = '';
                $grandtotal = '';
                
                $subtotal = $total + $service_id['value'];
                $marc = ($subtotal * $marcent['value'])/100;
                $martotal = $subtotal + $marc;
                $vat = ($martotal * $vatdata['value'])/100;
                $grandtotal = $subtotal + $marc + $vat;
                $grandtotal = number_format($grandtotal,2,'.','');
            }
            else
            {
              $i = 0;
              foreach($services AS $service)
              {
                $subtotal = '';
                $vat = '';
                $marc = '';
                $martotal = '';
                $grandtotal = '';
                
                $subtotal = $total + $service['value'];
                $marc = ($subtotal * $marcent['value'])/100;
                $martotal = $subtotal + $marc;
                $vat = ($martotal * $vatdata['value'])/100;
                $servicedata[$i]['total'] = number_format(($subtotal + $marc + $vat),2,'.','');
                $servicedata[$i]['title'] = $service['title'];
                $servicedata[$i]['description'] = $service['description'];
                $i += 1;
              }
            }
          

        }
        if($service_id != '')
        {
          return $grandtotal;
        }
        else
        {
          return $servicedata; 
        }
      }
      else
      {
        return false;
      }
    }

    public static function getService($mode_id = null)
    {
      if($mode_id != '')
      {
        return Settings::where('status','1')->where('type','service')->where('mode_type',$mode_id)->get()->toArray();
      }
      else
      {
        return false;
      }
    }

    public static function getFuelcharge()
    {
      return Settings::where('status',1)->where('type','charges')->where('mode_type',5)->where('title','fuel charge')->first();
    }

    public static function getMarcenttax()
    {
     return Settings::where('status',1)->where('type','tax')->where('mode_type',5)->where('title','marchant tax')->first(); 
    }

    public static function getVattax()
    {
     return Settings::where('status',1)->where('type','tax')->where('mode_type',5)->where('title','vat tax')->first();  
    }

    public static function message()
    {
      return Messages::where('status',1)->get()->toArray();
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
				public static function getrelatedprods($prod_detail)
				{

				$cat_id = $prod_detail->cat_id;
				$sub_cat_id = $prod_detail->sub_cat_id;
        $style_id = $prod_detail->style_id;
				$products = Product::where('sub_cat_id',$sub_cat_id)->where('style_id',$style_id)->where('id','!=',$prod_detail->id)->get();
				$countpro = count($products);
				if($countpro ==  0)
				{

				$products = Product::where('cat_id',$cat_id)->where('style_id',$style_id)->where('id','!=',$prod_detail->id)->get();
				$countpro = count($products);
				if($countpro ==  0){
				$products = Product::where('id','!=',$prod_detail->id)->take(10)->get();
				return $products;
				}
				return $products;
				}
				return $products;
				}
    
    
    
    
    
     public static function setrecentlyviewed($prod_id)
    {
		
		
		if(isset($_COOKIE['product_view'])) {
			
			$products = unserialize($_COOKIE['product_view']);
			array_push($products,$prod_id);
			array_unique($products);
	   

			setcookie(
			"product_view",
			serialize($products),
			time() + (10 * 365 * 24 * 60 * 60)
			);
			
		} else {
			
			
			$product_view = array($prod_id);
			setcookie(
			"product_view",
			serialize($product_view),
			time() + (10 * 365 * 24 * 60 * 60)
			);
			
		}

		
    }
    
    
    
    
    
    
     public static function getrecentlyviewed()
    {
		
			$products = array(); 
			if(isset($_COOKIE['product_view'])) {
			$products = unserialize($_COOKIE['product_view']);
			} 
      krsort($products);
           return $products;
    }
    
    
		public static function getvistors()
		{
		$total = Settings::where('type','total_visitor')->where('key','total_visitor')->first();
		$total_visitor  = $total->value;
		$total->value = $total_visitor + 1;
		$total->save();

		
		return $total_visitor;
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

		//$dt = new DateTime($time);
		$servertimezone =  date_default_timezone_get();
		$dt = Carbon::createFromFormat('Y-m-d H:i:s', $time, $servertimezone);
		//$dt->setTimezone('IST');
		//$tz = new DateTimeZone('IST'); // or whatever zone you're after

		$dt->setTimezone('IST');

		$newtime = $dt->format('Y-m-d H:i:s');
		return $newtime; 

		}

    

    
}

?>

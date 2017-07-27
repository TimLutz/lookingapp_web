<?php
namespace App\Http\Repositary;
use App\Model\User;
use App\Model\JobsapplicationModel;
use App\Model\ShiftModel;
use App\Model\Token;
use JWTAuth;
use Twilio;


use DateTime;
use DateTimeZone;

use App\Model\EmailTemplate;
use App\Model\EmailVerification;

use App\Jobs\SendOtpEmail;
class CommonRepositary{
	
    /*==================================================================================================
    Function for genarating random otp for a user 
    ====================================================================================================
    */

    public function randomGenerator($length=6){
		$str = "";
		$characters = array_merge(range('A','Z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		if(User::where('otp',$str)->exists()){
			randomGenerator();
		}
		return $str;
	}

    /*==================================================================================================
    Function for genarating random otp for a user 
    ====================================================================================================
    */

    public function randomGeneratorRefferal($length=10){
        $str = "";
        $characters = array_merge(range('A','Z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        if(User::where('refferal_code',$str)->exists()){
            randomGeneratorRefferal();
        }
        return $str;
    }

	/*==================================================================================================
    Function for managing token for a user on one device 
    ====================================================================================================
    */
    public function getManageToken($token,$user){
        
        $token_get=Token::where('user_id',$user)->first();
        if($token_get){
           JWTAuth::invalidate($token_get->token);
           return  $token_get->update(array('token'=>$token));
        }else{
            $token_new=new Token(['user_id'=>$user,'token'=>$token]);
            return $token_new->save();
        }
    }

    /*==================================================================================================
    Function for sending text message to anyone
    ====================================================================================================
    */
    public function sendText($phone,$message){
    	try{
            Twilio::message($phone, $message);
        }
        catch(\Services_Twilio_RestException $e){
            return true;
        }
    }
    
    public function AdjustRating($rating, $userId)
    {
      $id = \Crypt::decrypt($userId);
      $userRating = User::where(array('_id'=>$id))->value('rating');
      
        switch ($rating) {
            case 5:
                $userRating += 0.1;
                break;
            case 4:
                $userRating += 0.05;
                break;    
            case 3:
                $userRating += 0.00;
                break;
            case 2:
                $userRating -= 0.05;
                break;
            case 1:
                $userRating += 0.1;
                break;            
            
            default:
                $userRating +=0.0;
                break;
        }
        if($userRating<=doubleval(5)){
            User::where(array('_id'=>$id))->update(['rating'=>$userRating]); 
            JobsapplicationModel::where('jobseeker_id',$id)->update(['rating'=>true]);
            return true;
        }
        return false;
    }

        /*
     * Added on : 18 nov 2016
     * Added by : shivani, Debut infotech
     * DESC : for push notification (iOS)
     * */   
    public function send_notification($user_data){          
        //If code is on dell server then use this pem file else use another
        if(env('PEMFILE')=='DELL'){
            //$data['pem_path'] = public_path("notify/TJ1.pem");
            $data['pem_path'] = base_path('../')."FrontLinePush.pem";
            $data['passphrase'] = "";
            
        }else{
            //$data['pem_path'] = public_path("notify/targetJob.pem");
            $data['pem_path'] = base_path('../')."FrontLinePush.pem";
            $data['passphrase'] = "";
        }
                
        $data['message'] = $user_data['message'];//"I am checking for demo push notifications";
        $data['title'] = $user_data['title'];//"check notification on iOS";
        $data['purpose'] = $user_data['purpose'];//"check notification on iOS";
        $data['job_id'] = isset($user_data['job_id']) ? $user_data['job_id'] : '';
        //added on : shivani - 28 june 2017
        $data['is_new'] = $user_data['is_new'];



        $iosDevices = [];
        $androidDevices = [];
        //fetch device token from user id's sent in request
        if(!empty($user_data['user_ids'])){

            foreach($user_data['user_ids'] as $usrId){
                $iosDevices = [];

                //check device token and type
                $userDetails = User::where('_id',$usrId)->first();

                


                if(empty($userDetails)){
                    return ['status'=>0,'error'=>'user does not exist'];
                }else{              
                    if($userDetails->device_type == 'ios'){
                        $iosDevices[$usrId] = $userDetails->device_token;
                        $data['device_token'] = $iosDevices;
                        //return $notifyIos = $this->send_notification_ios($data);
                        $notifyIos = $this->send_notification_ios($data);
                    }else{                  
                        // return $notifyIos = $this->sendFCM($userDetails->device_token,$data['message'],$data['title'],$data['purpose'],$usrId, $data['job_id']);
                        $notifyIos = $this->sendFCM($userDetails->device_token,$data['message'],$data['title'],$data['purpose'],$usrId, $data['job_id'],$data['is_new']);
                    }   
                }                           
            }
            $response['status'] = 1;

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
        
        try {
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
                 
                $badgeDetails = UserBadge::where("user_id",$key)->first();
                $badgeCount = 1;
                if(!empty($badgeDetails)){
                    $badgeCount += $badgeDetails->notification_count;
                }
                    
                //Create the payload body
                $body['aps'] = array(
                        'alert' => array(
                                'title'=>$data['title'],
                                'body'  => $message,
                            ),
                        'sound' => 'default',
                        'badge' => $badgeCount,
                        'notify_purpose'=>$data['purpose'],
                        'content-available'=>1,
                        'priority'=>'high',
                        'job_id' => $data['job_id'],
                        'is_new' => $data['is_new'], //added on : 28 june 2017, shivani
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
                            $badgeDetails->update(["user_id"=>$key,'notification_count'=>$badgeCount]);                     
                        }   else{
                            //create a new record for user to save notification badge
                            UserBadge::create(["user_id"=>$key,'notification_count'=>$badgeCount]);
                        }   
                        $resp['msg']  = 'Message successfully delivered';
                        $resp['status'] = "1";              
                    }
                    else{                   
                        $resp['msg']  = 'Message not successfully delivered' . PHP_EOL;
                        $resp['status'] = "1";  
                    }
                }
                // Close the connection to the server
                fclose($fp);

            }
            return $resp;   
        }
        catch(\Exception $e)
        {
            return ['status' => false, 'message' => "Notification not working"];
        }   
    }


    /*
     * Added on : 1 dec 2016
     * Added by : shivani, Debut infotech
     * DESC : to send notification for ios/android
     * 
     * */
    function sendFCM($id,$message,$title,$purpose,$user_id, $job_id = '',$is_new='') {     
        //check badge details
        $badgeDetails = UserBadge::where("user_id",$user_id)->first();
        $badgeCount = 1;
        if(!empty($badgeDetails)){
            $badgeCount += $badgeDetails->notification_count;
        }
        $url = 'https://fcm.googleapis.com/fcm/send';
        
        //$fields = array('registration_ids' => array('dVZwcExBxfY:APA91bEeQ61GWbECDsB4rRy3ksl4rWh7f3FeYJqBT1ZXMLJzA-3EQ-qsPtTEJjAot4d1xif2qP-S3cURfT7z_DU4patAOAlD6uMKWNuo9PwZnHY0uUIyiH7iV1nJ4p7O7JqIQoMmA7Jw'),'notification' => $notification);
       
        
        
        //$notification= array('title' => $title,'body' => $message,'sound'=>'default','click_action'=>'MAIN','action'=>(int)$action);
        
        //set notification fields
        $fields = array(
            'registration_ids' => array((string)$id),
            'priority'=>'high',
            //'notification' => $notification,
            'data'=>array('badge' => $badgeCount,'notify_purpose'=>$purpose,'action'=>$action,'title' => $title,'message' => $message, 'job_id' => $job_id, 'is_new' => $is_new)
        );
        //set headers.
        $headers = array('Authorization:key= AIzaSyA3AMs8s8WSUmsG54PBfF_DgPuXll0-E5A','Content-Type: application/json');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        //echo json_encode($fields);
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

    public function getAdminDetail()
    {
        return $data = User::where(array('role'=>1))->first();   
    }    


    public function commonDate($value='')
    {
       // $date = new \DateTime($value);
        $date = new DateTime($value, new DateTimeZone('UTC'));
        $date->setTimeZone(new DateTimeZone($_COOKIE['client_timezone']));
         $date->setTimezone(new \DateTimeZone('UTC'));
         return $formatted_date = $date->format("Y-m-d\TH:i:s\Z");
         //return $formatted_date = $date->format(DateTime::ATOM);

            //echo "<br />Date2: ". $formatted_date."<br />";
    }


    public function setShift($dates=null, $job_id=null)
    {
        foreach($dates As $k => $shift)
        {
          $shifts['job_id'] = $job_id;
          $shifts['job_id_ob'] = new \MongoDB\BSON\ObjectID($job_id);
          $shifts['start_date'] = $shift['start_date'];
          $shifts['end_date'] = $shift['end_date'];
          $shifts['status'] = true;
          ShiftModel::create($shifts);
        }
    }


    public function getAllNotification()
    {
      $notification = NotificationModel::where(array('status'=>true,'to'=>$this->auth->user()->_id))->get();
      
      $not_count= count($notification);
      $content =  view('employer.promo.ajaxnotification',compact('notification','not_count'))->render();
      $result = ['not_count'=>$not_count,'notification'=>$notification];
      return $result;
    }
    
}
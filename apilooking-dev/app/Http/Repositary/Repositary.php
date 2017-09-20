<?php
namespace App\Http\Repositary;
use App\Models\CoupenVerify;
use App\Models\User;
use App\Models\Generalfield;
use App\Models\GeneralInformation;
use App\Models\RestrictionModel;
use App\Models\ShareAlbumModel;
use App\Models\UserLooksexModel;
use App\Models\ViewerModel;
use App\Models\ChatModel;
use App\Models\JobSeekers;
use App\Models\UserLokDatesexTypeModel;
use Validator; 
use DB;
use Mail; 
use PushNotification;
use Carbon\Carbon;
use App\Models\UserLooksexdateModel;
class Repositary
{
	/*==================================================================================================
    Function for sendMail 
    ====================================================================================================
    */

	static function sendMail($email,$data=array(),$template,$subject){
		return Mail::send($template, $data, function($m) use($data,$email,$subject){
                $m->to($email)
                    ->subject($subject);
            });
	}


	/*==================================================================================================
    Function for genarating random otp for a user 
    ====================================================================================================
    */

    public function randomGeneratorRefferal($length=5){
        $str = "";
        $characters = array_merge(range('A','Z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        if(User::where('profile_id',$str)->exists()){
            randomGeneratorRefferal();
        }
        return $str;
    }

	/*==================================================================================================
    Function for get limit
    ====================================================================================================
    */


    public function getlimit($membertype=null,$limit=null)
    {
    	$match_limit = RestrictionModel::where(['member_type'=>$membertype,'limit_type'=>$limit])->first();
        if ($match_limit) {
            $limit = $match_limit->limit;
        } else {
            $limit = 0;
        }
        //echo $member_type;die;
        return $limit;
    }

    /*==================================================================================================
    Function for check view user 
    ====================================================================================================
    */

    public function check_view($id)
    {
    	    
        $views = ViewerModel::where(['viewer_user_id'=>$id,'is_view'=>1])->first();
        if ($views) {
            $is_view = 1;
        } else {
            $is_view = 0;
        }
        return $is_view;
        
    }

    /*==================================================================================================
    Function for sharealbum to user 
    ====================================================================================================
    */

    public function check_sharealbum($id)
    {
        $views = ShareAlbumModel::where(['receiver_id'=>$id,'is_view'=>1])->first();    
        if ($views) {
            $is_view = 1;
        } else {
            $is_view = 0;
        }
        return $is_view;
    }

    /*==================================================================================================
    Function for count user view
    ====================================================================================================
    */

    public function count_view($id)
    {
        $views = ViewerModel::where(['viewer_user_id'=>$id,'is_view'=>1])->count();
        return $views;
    }

    /*==================================================================================================
    Function for count sharealbum 
    ====================================================================================================
    */

    public function count_sharealbum($id) {
        $views = ShareAlbumModel::where(['receiver_id'=>$id,'is_view'=>1])->count();    
        return $views;
    }

    /*==================================================================================================
    Function for check active profile
    ====================================================================================================
    */

    public function check_profile_active($currentDate=null,$id=null)
    {
    	$if_exist_profile = UserLooksexdateModel::where(['user_id'=>$id,'look_type'=>'sex'])
    										  ->where('start_time','<=',$currentDate)
    										  ->where('end_time','>=',$currentDate)
    										  ->get();
    	
        if (count($if_exist_profile) > 0) {
            $is_profile_active = 1;
        } else {
            $is_profile_active = 0;
        }
        return $is_profile_active;
    }
    
    /*==================================================================================================
    Function for get distance
    ====================================================================================================
    */

    public function distance($lat1=null, $lon1=null, $lat2=null, $lon2=null, $unit=null) {
        $this->autoRender = false;
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        /*         * *** M= Miles ,K=Kilometers, N = Nautical Miles ************* */
        if ($unit == "K") {
            if (is_nan($miles) == 1) {
                $miles = 0;
            }
            return round(($miles * 1.609344));
        } else if ($unit == "N") {
            if (is_nan($miles) == 1) {
                $miles = 0;
            }
            return round(($miles * 0.8684));
        } else {
            if (is_nan($miles) == 1) {
                $miles = 0;
            }
            return round($miles);
        }
    }

    /*==================================================================================================
    Function for exchange height weight
    ====================================================================================================
    */

    public function getHeightWidthValue($value1=null,$value2=null)
    {
    	# code...
    	$a1=$value1;
    	$a2 = $value2;
	    if ($a1 > $a2) {
            $a1_change = $a2;
            $a2_change = $a1;
            $a1 = $a1_change;
            $a2 = $a2_change;
        }
	    return ['to'=>$a1,'from'=>$a2];            
    }

    /*==================================================================================================
    Function for save identities
    ====================================================================================================
    */

    public function saveIdentites($identite=null,$his_identitie=null,$clientId=null)
    {
    	$identity = $his_identity = array();
    	//print_r($identite);
    	$identite = explode(',', str_replace([', ',' ,',' , '], ',', trim($identite)));
    	$his_identitie = explode(',', str_replace([', ',' ,',' , '], ',', trim($his_identitie)));
    	foreach($identite AS $key => $value)
        {
            $identity[$key]['user_id'] = $clientId;
            $identity[$key]['type'] = 'identity';
            $identity[$key]['name'] = $value;
        }

        foreach($his_identitie AS $key => $value)
        {
            $his_identity[$key]['user_id'] = $clientId;
            $his_identity[$key]['type'] = 'his_identites';
            $his_identity[$key]['name'] = $value;
        }

        return $IdentityData = array_merge($identity,$his_identity); 
        
    }
	
	/*==================================================================================================
    Function for chat user
    ====================================================================================================
    */

	public function commonChatUser($cId=null,$rId)
	{
		return ChatModel::where(['user_id'=>$cId,'chat_user_id'=>$rId])->first();
	}

    /*==================================================================================================
    Function for sent notification.
    ====================================================================================================
    */
	public function sentNotification($device_token,$device_type,$messages,$data)
	{
        try {

            $message = PushNotification::Message($messages,$data);
            $dType = 'appNameIOS';
            if($device_type == 'android')
            {
                $dType = 'appNameAndroid';
            }

            PushNotification::app($dType)
                        ->to($device_token)
                        ->send($message);
            
        } catch (Exception $e) {
            return false;
        }
		
	}

    public function saveLooksexvalue($data=null,$userid=null,$looksexid=null,$type=null)
    {
        if(isset($data['my_physical_appearance']))
        {
            $this->insertLookData($data['my_physical_appearance'],$userid,$looksexid,'my_physical_appearance',$type);               
        }

        if(isset($data['his_physical_appearance']))
        {
            $this->insertLookData($data['his_physical_appearance'],$userid,$looksexid,'his_physical_appearance',$type);  
        }

        if(isset($data['my_sextual_preferences']))
        {
            $this->insertLookData($data['my_sextual_preferences'],$userid,$looksexid,'my_sextual_preferences',$type);  
        }

        if(isset($data['his_sextual_preferences']))
        {
            $this->insertLookData($data['his_sextual_preferences'],$userid,$looksexid,'his_sextual_preferences',$type);   
        }

        if(isset($data['my_social_habits']))
        {
            $this->insertLookData($data['my_social_habits'],$userid,$looksexid,'my_social_habits',$type);  
        }

        if(isset($data['his_social_habits']))
        {
            $this->insertLookData($data['his_social_habits'],$userid,$looksexid,'his_social_habits',$type);  
        }

        if(isset($data['my_traits']))
        {
            $this->insertLookData($data['my_traits'],$userid,$looksexid,'my_traits',$type);  
        }

        if(isset($data['his_traits']))
        {
            $this->insertLookData($data['his_traits'],$userid,$looksexid,'his_traits',$type);  
        }

        if(isset($data['my_interest']))
        {
            $this->insertLookData($data['my_interest'],$userid,$looksexid,'my_interest',$type);  
        }
    }

    public function insertLookData($data=null,$userid=null,$looksexid=null,$type,$looktype=null)
    {
        $myphysical =explode(',', trim(str_replace([', ',' ,',' , '], ',', trim($data))));
        foreach($myphysical AS $key => $value)
        {
            $data1[$key]['user_id'] = $userid;
            $data1[$key]['lookdatesex_id'] = $looksexid;
            $data1[$key]['type'] = $type;
            $data1[$key]['looktype'] = $looktype;
            $data1[$key]['name'] = trim($value);
            $data1[$key]['created_at'] = Carbon::now();
            $data1[$key]['updated_at'] = Carbon::now();
        }
    //    print_r($data1); die('here');
        return UserLokDatesexTypeModel::insert($data1);    
    }

    


    /*
     * Added on : 28 aug 2017, Lovepreet
     * DESC : to get difference between current time and passed value
     * */
    public function check_difference_in_hours($startTime){
        $currentTime = Carbon::now();
        $start_time = Carbon::parse($startTime);
        //return $start_time->diffInHours($currentTime);
        $start_time = $start_time->diffInHours($currentTime);

        
        if($start_time<1)
        {
            return 0;
        }
        else if($start_time>=1 && $start_time<24)
        {
            return 1;
        }
        else
        {
            return 2;
        }
        

    }
}

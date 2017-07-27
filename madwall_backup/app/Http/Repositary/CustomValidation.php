<?php
namespace App\Http\Repositary;
use Illuminate\Validation\Validator;
use JWTAuth;
use App\Model\User;
use DB;


/*===============================================================================================
	Class for custom validation Created by debut Infotech Pankaj Cheema
=================================================================================================
*/
class CustomValidation extends Validator{
	
	/*=====================================================================
		Validaton for checking that otp is expired or not 
	=======================================================================
	*/
	public function validateOtpExpire($attribute, $value, $parameters)
    {
        $user=User::where(array('otp'=>$value))->first();
        
        if(!$user || $user->otp_expire < \Carbon\Carbon::now()){
            return false;
        }
        
        return true;
    }

    /*=======================================================================
    	Function for deleting user if he tries to register again
    ==========================================================================
    */
    public function validateReRegister($attribute, $value, $parameters)
    {
        $user=User::where(array('email'=>$value,'status'=>false,'profile_complete'=>1))->first();
        if($user){
        	$user->delete();
        }
        
        return true;
    }
    public function validateOtpVerified($attribute, $value, $parameters)
    {
        $user=User::where(array('email'=>$value,'status'=>false))->orWhere('phone',$value)->first();
        if($user){
            return false;
        }
        
        return true;
    }  //attempt

    public function validateAttemptCount($attribute, $value, $parameters)
    {
        $user=User::where(array('_id'=>JWTAuth::parseToken()->authenticate()->_id))->first();
        if(!$user->health_quiz_attempt){
            return false;
        }
        
        return true;
    }

    /*===========================================================================================
        Custom validation rule added by pankaj cheema debutinfotech 
    =============================================================================================*/

    public function validateCustomUnique( $attribute, $value, $parameters)
    {
        
        if(count($parameters)>2){
            $value_exist=DB::table( $parameters[0] )->where(array($parameters[1]=>strtolower($value) ,'is_deleted'=>false))->where('_id','!=',$parameters[2])->first();
        } else {
            $value_exist=DB::table( $parameters[0] )->where(array($parameters[1]=>strtolower($value) ,'is_deleted'=>false))->first();
        }
        
        if($value_exist){
            return false;
        }

        
        return true;
    }

    public function validateAlphaSpaces($attribute, $value)
    {
        return preg_match('/^[\pL\s]+$/u', $value);
    }
    
    public function validateCaptcha($attribute, $value)
    {
        return (new Captcha)->validate($value);
    }

    public function validateAlphaSpacesNumric($attribute,$value)
    {
        return preg_match('/^[\pL\s0-9]+$/u', $value);
    }
    public function validatePlusNumric($attribute,$value)
    {
        return preg_match('/^(?=.*[0-9])[- +()0-9]+$/', $value);
    }
    public function validatePasswordCustom($attribute, $value, $parameters)
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d](?=.*?[\W_]).{6,25}$/', $value);
    }


    public function validateDatesize($attribute, $value, $parameters)
    {
        $data = explode(',', $value);

        if(count($data)>30)
            return false;
        else
            return true;
    }

    public function validateCheckindustry($attribute, $value, $parameters)
    {
        if(count($value)>3)
            return false;
        else
            return true;
    }

    public function validatecustomTitle($attribute, $value, $parameters)
    {
        return preg_match("/^[a-zA-Z0-9 ' ']{5,50}$/",$value);
    }
    
    public function validateCustomDescription($attribute, $value, $parameters)
    {
        return preg_match("/^[a-zA-Z0-9 '.,'-()\-]{50,250}+$/",$value);

    }

    public function validateCustomSalaryrange($attribute, $value, $parameters)
    {
        return preg_match("/^[0-9 '.']{1,4}+$/",$value);
    }
    
    public function validateCustomWorker($attribute, $value, $parameters)
    {
        return preg_match("/^[0-9]{1,3}+$/",$value);
    }

    public function validateCustomMin($attribute, $value, $parameters)
    {
       
        $v1 = strtotime('UTC'.$value);
        $v2 = strtotime('UTC'.$parameters[0]);
        $diff = $v1 - $v2;
        $vreme_rada = date('H:i', $diff);
        
        $time = explode(':', $vreme_rada);
        if($time[0]<1 && $time[1]>=00)
            return false;
        else
            return true;
    }

    public function validateCustomMax($attribute, $value, $parameters)
    {
        $v1 = strtotime('UTC'.$value);
        $v2 = strtotime('UTC'.$parameters[0]);
        $diff = $v1 - $v2;
        $vreme_rada = date('H:i', $diff);
        
        $time = explode(':', $vreme_rada);
        if($time[0] >14  || $time[0] >=14 && $time[1]>00)
            return false;
        else
            return true;
    }

    public function validateCustomUniqueEmail($attribute, $value, $parameters)
    {
        $value = strtolower($value);
        $user=User::where(array('email'=>$value))->first();
        if($user){
            return false;
        }
        
        return true;
    }

    public function validateCustomUser($attribute, $value, $parameters)
    {
        $user=User::where(array('email'=>$value))->first();
        if($user)
            return true;
        else
            return false;

    }

    public function validateCustomLocation($attribute, $value, $parameters)
    {
        if(!empty($value))
        {
            if(empty($parameters[0]) || empty($parameters[1]))
                return false;
        }

        return true;
    }

    public function validateCustomUsercheck($attribute, $value, $parameters)
    {

        $user = User::where(array('email'=>$value,'approved'=>2))->first();
        if($user)
            return false;
        else
            return true;
    }
}
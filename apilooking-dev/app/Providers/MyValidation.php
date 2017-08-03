<?php 
namespace App\Providers;
 
use Illuminate\Validation\Validator;
use JWTAuth;
use App\Models\Experience;
use App\Models\JobSeekers;
use App\Models\JobApplication;
 
class MyValidation extends Validator {
 
    public function validateMongoInteger($attribute, $value, $parameters)
    {
        if(gettype($value)=='integer')
            {
            	return true;
            }
            return false;
    }
    public function validateMongoDouble($attribute, $value, $parameters)
    {
        if(gettype($value)=='double' ||gettype($value)=='integer')
            {
            	return true;
            }
            return false;
    }
    public function validateMongoCoordinates($attribute, $value, $parameters) 
    {
        if(gettype($value)=='array')
            {
            	return true;
            }
            return false;
    }
    public function validateMongoBoolean($attribute, $value, $parameters) 
    {
        if(gettype($value)=='boolean')
            {
            	return true;
            }
            return false;
    }
    public function validateAlphaSpaces($attribute, $value, $parameters) 
    {
        return preg_match('/^[\pL\s]+$/u', $value);
    }
    /*
        * function for adding validation to the count of proffesional count
    */

    public function validateExperienceProfessionalCount($attribute, $value, $parameters) 
    {
       $count=Experience::where(array('user_id'=>JWTAuth::parseToken()->authenticate()->_id,'status'=>true,'experience_type'=>'Professional'))->count();
       return $count < 10;
    }
     /*
        * function for adding validation to the count of personal count
    */
    public function validateExperiencePersonalCount($attribute, $value, $parameters) 
    {
       $count=Experience::where(array('user_id'=>JWTAuth::parseToken()->authenticate()->_id,'status'=>true,'experience_type'=>'Personal'))->count();
       return $count < 5;
    }

    public function validateTotalPercentage($attribute, $value, $parameters) 
    {
       
       $cv_percentage=Jobseekers::where('user_id',JWTAuth::parseToken()->authenticate()->_id)->first();
        return $cv_percentage->cv_percentage>=60;
    }
    public function validateApplied($attribute, $value, $parameters) 
    {
       
       if(JobApplication::where(array('user_id'=>JWTAuth::parseToken()->authenticate()->_id,'job_id'=>$value))->where('application_status','!=','view')->exists())
       {
        return false;
       }
       return true;
    }
    public function validateDocument($attribute, $value, $parameters) 
    {
       
       foreach($value as $valid)
       {
		   if(isset($valid['filename']) && isset($valid['type']))
		   {
			   if($valid['filename']=='' || $valid['type']=='')
			   {
				   return false;
			   }
			   return true;
		   }
		   else{
			   return false;
		   }
		   
	   }
       
    }
    public function validateDoctypenumber($attribute, $value, $parameters) 
    {
       
       foreach($value as $valid)
       {
		   if (is_numeric($valid['type'])) {
		  return true;
		  }
		  else{
			  return false;
		  }
		   
	   }
       
    }

    public function validateCustomIdentity($attribute, $value, $parameters)
    {
        if(count($value)>5)
            return false;
        else
            return true;
    }
    

    public function validateAgeRestriction($attribute, $value, $parameters)
    {
        
    }

 
}

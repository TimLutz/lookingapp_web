<?php namespace app\Services;
use Auth;
use App\Models\User;
use App\Models\AddPointContact;


use Illuminate\Validation\Validator;
use LaravelCaptcha\Lib\Captcha;


class Validation extends Validator {
	
	public function validateAlphaNumNospace($attribute, $value)
    {
		return preg_match('/^[a-zA-Z0-9\-_]{0,50}$/', $value);
	}

	public function validatealphaNumeric($attribute, $value)
    {
		return preg_match('/^[a-zA-Z0-9 "-]+$/', $value);
	}
	
	public function validateAliasCustom($attribute, $value)
    {
		return preg_match('/^[a-zA-Z0-9-.]{0,70}$/', $value);
	}
	
	//name with alphabets, spaces, '—'
	public function validateTitleCustom($attribute, $value)
    {
		return preg_match('/^[a-zA-Z0-9 "—]{0,50}$/', $value);
	}
	

	  public function validateAlphaSpaces($attribute, $value)
    {
        return preg_match('/^[\pL\s]+$/u', $value);
    }
	
	public function validateCaptcha($attribute, $value)
	{
		return (new Captcha)->validate($value);
	}

	public function validateGreaterThan($attribute, $value, $parameters)
	{
		if (isset($parameters[0])) {
			$other = $parameters[0];
			return intval($value) > intval($other);
			} else {
			return true;
			}
	}


	public function validateMinMax($attribute, $value)
	{
		return preg_match('/^(10000|[0-9]{1,4})%?$/', $value);
	}

	public function validateEmailUrl($attribute, $value, $parameters)
	{

	$email_r = explode("@",$value);
	$cases = array('www.'.$email_r[1],'http://'.$email_r[1], 'https://'.$email_r[1], 'http://www.'.$email_r[1], 'https://www.'.$email_r[1],$email_r[1]);


	if(in_array($parameters[0], $cases)){
	return true;

	}
	else {
	return false;
	}
	}


	public function validateEmailContact($attribute, $value, $parameters)
	{

		$id =Auth::user()->id;
		$user = User::findOrfail($id);

		
		$my_contact = $user->contact->pluck('email')->toArray();
		if(in_array($parameters[0], $my_contact) || $parameters[0] == $user['email']){
			$response =false;
		}else{
			$response =true;
		}

		return $response;
		
	}


	public function validatePhone($attribute, $value, $parameters)
     {
        return preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $value);
     }
     
     public function validateCustomUrl($attribute, $value)
     {
      return preg_match("/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/", $value);
     }
     
  /*    public function validateAlphaSpaces($attribute, $value)
    {
        return preg_match('/^[\pL\s]+$/u', $value);
    }
	
     */
     
      public function validatePasswordCustom($attribute, $value, $parameters)
     {
        return preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d][A-Za-z\d!@#$%^&*()_+]{6,20}$/', $value);
     }
     
     
    public function validateYoutubeUrl($attribute, $value){
		return preg_match('/^(http|https):\/\/(?:www\.)?youtube.com\/embed\/\S*$/', $value);
	}
	 public function validateFacebookUrl($attribute, $value){
		return preg_match('/(?:(?:http|https):\/\/)?(?:www.)?facebook.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[?\w\-]*\/)?(?:profile.php\?id=(?=\d.*))?([\w\-]*)/', $value);
	}
	 public function validateTwitterUrl($attribute, $value){
		return preg_match('/(?:http:\/\/)?(?:www\.)?twitter\.com\/(?:(?:\w)*#!\/)?(?:pages\/)?(?:[\w\-]*\/)*([\w\-]*)/', $value);
	}

	public function validateAlphaSpacesNumric($attribute,$value)
	{
		return preg_match('/^[\pL\s0-9,]+$/u', $value);
	}
	
	public function validateTrimInput($attribute,$value)
			{
			return preg_match('/^[a-zA-Z0-9_]+( [a-zA-Z0-9_]+)*$/', $value);
			}


}

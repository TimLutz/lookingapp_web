<?php namespace app\Services;
use Auth;
use App\Models\User;
use App\Models\AddPointContact;


use Illuminate\Validation\Validator;
use LaravelCaptcha\Lib\Captcha;


class Validation extends Validator {

	public function validatealphaNumeric($attribute, $value)
    {
		return preg_match('/^[a-zA-Z0-9 "-]+$/', $value);
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
			return intval($value) >= intval($other);
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
        return preg_match("/^(https?:\/\/)?([\da-z\.-\.([.\*]+)]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $value);
        
        //return preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', $value);
        //return preg_match('(http(s)?://)?([\w-]+\.)+[\w-]+(/[\w- ;,./?%&=]*)?', $value);
     }
     
  /*    public function validateAlphaSpaces($attribute, $value)
    {
        return preg_match('/^[\pL\s]+$/u', $value);
    }
	
     */
     
     public function validatePasswordCustom($attribute, $value, $parameters)
     {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/', $value);
     }
     
     
    public function validateYoutubeUrl($attribute, $value){
		return preg_match('/^(http|https):\/\/(?:www\.)?youtube.com\/embed\/\S*$/', $value);
	}


}

<?php namespace app\Services;

use Illuminate\Validation\Validator;
use LaravelCaptcha\Lib\Captcha;

class Validation extends Validator {

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
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d](?=.*?[\W_]).{6,}$/', $value);
    }
}
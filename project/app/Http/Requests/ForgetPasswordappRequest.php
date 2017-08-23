<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ForgetPasswordappRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			//'old_password' => 'required',
            //'password' => 'passwordcustom|confirmed|min:6|max:20',
            'email'=>'required|email|exists:users',
			'password' => 'required|confirmed|min:8|max:16',
			'password_confirmation' => 'required',	
		];
    }
    
    
      public function messages()
	{
		return [
            'email.required'=>'Please enter your register email',
            'email.email'=>'Invalid Email',
            'password.required'=>'Please enter password',
            'password.confirmed'=>'Password donot matched',
            'password.Min'=>'Please enter minimum 8 character.',
            'password.Max'=>'Please enter maximum 16 character.',
		    'password_confirmation.required' => 'Confirm password field is required',
            'email.exists'=>'Email doesn`t exist in the our record',
		];
	}
}

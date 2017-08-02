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
			'password' => 'confirmed|min:8|max:20',
			'password_confirmation' => 'required',	
		];
    }
    
    
      public function messages()
	{
		return [
		//'password.passwordcustom' => 'The Password must contain one number,one alphabet and one special characeter.',
		    'password_confirmation.required' => 'Confirm password field is required',
		];
	}
}

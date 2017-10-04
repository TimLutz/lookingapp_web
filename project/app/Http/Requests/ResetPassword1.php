<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ResetPassword1 extends Request
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
            'old_password' => 'required',
        //    'password' => 'required|confirmed|password_custom|min:6|max:30',
            'password' => 'required|confirmed|min:8|max:16',
            'password_confirmation' => 'required',
        ];
    }
    
    
      public function messages()
        {
        return [
        'password.password_custom' => 'Password should be of atleast 6 characters, one uppercase, one lowercase and one number',
            'password_confirmation.required' => 'Confirm password field is required',
        ];
    }
}

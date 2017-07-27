<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
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
            /*'old_password' => 'required|max:30',*/
            'email'=>'required|email',
            'password'=>'required|confirmed|password_custom|',
            'password_confirmation'=>'required|password_custom',
        ];
    }

    public function messages(){
        $message['password.required'] = 'Please enter Password';
        $message['password.confirmed'] = 'Passwords do not match';
        $message['password_confirmation.required'] = 'Please enter Confirm Password';
        $message['password_confirmation.password_custom'] = 'Password should be at least 6 characters long containing at least 1 number and 1 alphabet';
         $message['password.password_custom'] = 'Password should be at least 6 characters long containing at least 1 number and 1 alphabet';
        $message['email.required']='Please enter email';
        $message['email.email']='Invalid email';
        return $message;
    }
}

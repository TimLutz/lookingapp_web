<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class ChangeEmployerPassword extends FormRequest
{
    /*****************************************************************
     * Determine if the user is authorized to make this request.
     * @return bool
     *****************************************************************/
    public function authorize()
    {
        return true;
    }

    /******************************************************
     * Get the validation rules that apply to the request.
     * @return array
     ******************************************************/
    public function rules()
    {
        return [
           'old_password'       => 'bail|required|',
            'password'          => array(
                                        'required',
                                        'min:6',
                                        'regex:/^(?=.*[a-z])(?=.*\d).+$/',
                ),
            'password_confirmation' => 'required|same:password',
        ];
    }

    /************************************************************
     * Get the error messages for the defined validation rules.
     * @return array
     ************************************************************/
    public function messages() {
        return [
            'old_password'          => 'Please Enter Old Password.',
            'password'              => 'Please Enter New Password.',
            'password.min'          => 'Password should be at least 6 characters long.',
            'password_confirmation' => 'Please Enter Confirmed Password.',
            'password.regex'        => 'Password should contain at least 1 number and 1 alphabet.',
            'password_confirmation.same'        => 'New password and confirm password do not match.Please enter both again.',
        ];
    }
}

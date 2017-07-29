<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            //
            'first_name'=>'required|alpha|min:3|max:50',
            'last_name'=>'required|min:2|max:50',
            'phone_number'=>trim('required|numeric|digits_between:10,12'),
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
            'agree'=>'required'
        ];
    }
}

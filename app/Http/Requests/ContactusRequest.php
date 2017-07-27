<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactusRequest extends FormRequest
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
            'name'=>'required|alpha_spaces',
            'email'=>'required|email',
            'content'=>'required|Min:50|Max:500',
        ];
    }

    public function messages()
    {
        return [
                'name.required'=>'Please enter Name',    
                'name.alpha_spaces'=>'Please enter a valid name',    
                'email.required'=>'Please enter Email',    
                'email.email'=>'Please enter a valid email',    
                'content.required'=>'Please specify a message for the admin',    
                'content.min'=>'Please enter the message between 50 to 500 characters only',    
                'content.max'=>'Please enter the message between 50 to 500 characters only',    
               ];
    }
}

<?php

namespace App\Http\Requests;

use Input;
use App\Http\Requests\Request;
use Illuminate\Http\Request as HttpRequest;

class ClientRequest extends Request
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
    public function rules(HttpRequest $request)
    {
		
		$id = '';
		
			 if(isset($request['idedit'])){
				   $id = \Crypt::decrypt($request['idedit']); 
			 }
			
			 
          if(isset($request['idedit']))
		{
			$valid= array(
            'name' => trim('required|alpha_spaces|trim_input|max:50'),
            'email' => trim('required|email|max:250|unique:users,email,'.$id.',id'),
            'phone' => trim('required|digits_between:8,16|trim_input|unique:users,phone,'.$id.',id'),
           // 'type' => trim('required'),
            'password' => trim('passwordcustom|confirmed|min:6|max:20'),	
            'address' => 'required|min:3',
            //'photo' => 'required|image',
            'status'=> 'required',
            'type'=> 'required|numeric',
          );  
		
			
		}
		else{
			$valid= array(
            'name' => trim('required|alpha_spaces|trim_input|max:50'),
            'email' => trim('required|email|max:250|unique:users,email,'.$id.',id'),
            'phone' => trim('required|digits_between:8,16|trim_input|unique:users,phone,'.$id.',id'),
            'type' => trim('required'),
            'password' => trim('required|passwordcustom|confirmed|min:6|max:20'),	
            'password_confirmation' => 'required',	
            'address' => 'required|min:3',
            //'photo' => 'required|image',
            'status'=> 'required',
          );  
		}
        
        return $valid; 
    }
    
    public function messages()
	{
		return [
		    'name.trim_input' => 'This field is Required',
		    'phone.trim_input' => 'This field is Required',
			'photo.required' => 'Profile Picture is Required',
			'photo.image' => 'Upload only Image',
			'password.passwordcustom' => 'The Password must contain one number,one alphabet and one special character.'
			
		];
	}
  
}

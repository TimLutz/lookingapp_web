<?php

namespace App\Http\Requests;

use Input;
use App\Http\Requests\Request;
use Illuminate\Http\Request as HttpRequest;
use Validator;

class TechnicianRequest extends Request
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
            'phone' => trim('required|trim_input|digits_between:8,16|unique:users,phone,'.$id.',id'),
            'address' => 'required',
            //'photo' => 'required|image',
            'status'=> 'required',
            'domain'=> 'required',
          );  
		
		}
		else{
			$valid= array(
            'name' => trim('required|alpha_spaces|trim_input|max:50'),
            'email' => trim('required|email|max:250|unique:users,email,'.$id.',id'),
            'phone' => trim('required|trim_input|digits_between:8,16|unique:users,phone,'.$id.',id'),
            'address' => 'required|min:3',
            'photo' => 'required|image',
            'status'=> 'required',
            'domain'=> 'required|trim_input',
          );  
		}
        
        return $valid; 
    }
    
    public function messages()
	{
		return [
			'photo.required' => 'Profile Picture is Required',
			'photo.image' => 'Please upload only image file',
			'password.passwordcustom' => 'The Password must contain one number,one alphabet and one special characeter.',
			'phone.trim_input' => 'This field is Required.',
			'name.trim_input' => 'This field is Required.',
			'domain.trim_input' => 'This field is Required.',
			
			
		];
	}
  
}

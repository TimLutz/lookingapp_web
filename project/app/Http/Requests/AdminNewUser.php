<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminNewUser extends Request {

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
			'name' 	=> trim('required|alpha_spaces|min:3|max:32'),
			'phone' 	=> trim('required|numeric|between:8,16'),
			
			'email'		 => trim('required|email|unique:users|max:255'),
			//'company'       => 'required',
			'password'	 	=> 'required|confirmed|min:6|max:30',
			//'type' 			=> 'required'		
		];
	}
	public function messages()
{
	return [
	//'first_name.required'=>"The name field is required",
	'email.email_url'=>'Email host and Company Url should be same',
	'password.passwordcustom' => 'password should be of atleast 6 characters, one uppercase, one lowercase and one number',
	];
}
}

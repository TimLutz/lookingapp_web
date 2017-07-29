<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Input;
use Validator;
class EditsettingRequest extends Request
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
       Validator::extend('numdash', function($attribute, $value)
		{
			return preg_match('/^[\d-]*\d[\d-]*$/', $value);
		});
		$rules = array();
		$request = Input::all();
		if($request['type']== 'number'){
			$rules['value'] = 'required|numdash';
		}
		if($request['type']== 'text_videos' || $request['type']== 'page' || $request['type']== 'text_quote' || $request['type']== 'address_location'){
			$rules['value'] = 'required';
		}
		return $rules;
    }
      public function messages()
	{
		return [
		    'value.numdash' => 'Only numbers and dashes allowed',
			
		];
	}
    
}

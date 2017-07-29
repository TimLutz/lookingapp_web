<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Input;

class CategoryeditRequest extends Request
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
        $request = Input::all();
		return [
            'name' => 'required|min:3|max:125|alpha_spaces',
            'alias' => 'required|AliasCustom',
            'min_width' => 'required|numeric|min:1|max:999',
            'max_width' => 'required|numeric|min:1|max:999|greater_than:'.$request['min_width'],
            'min_length' => 'required|numeric|min:1|max:999',
            'max_length' => 'required|numeric|min:1|max:999|greater_than:'.$request['min_width'],
			'sort_num' => 'numeric|max:999',
			'status' => 'required',
        ];
        
    }
    
     public function messages()
	{
		return [
			'sort_num.numeric' => 'Order number must be a number',
			'sort_num.max' => 'Order number can be a three digit number at max',
			'min_width.min' => 'Minimum width must be greater than zero',
			'max_width.min' => 'Maximum width must be greater than zero',
			'max_width.greater_than' => 'Maximum width must be greater than minimum width',
			'min_length.min' => 'Minimum length must be greater than zero',
			'max_length.min' => 'Maximum length must be greater than zero',
			'max_length.greater_than' => 'Maximum length must be greater than minimum length',
			'alias.alias_custom' => 'Alias should be 50 characters max and without space'
			
		];
	}
  
}

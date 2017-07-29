<?php

namespace App\Http\Requests;

use Input;
use App\Http\Requests\Request;

class CategoryRequest extends Request
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
            'name' => 'required|min:3|max:125|alpha_spaces|unique:categories',
            'alias' => 'required|AliasCustom|unique:categories',
            'min_width' => 'required|numeric|min:1|max:999',
            'max_width' => 'required|numeric|min:1|max:999|greater_than:'.$request['min_width'],
            'min_length' => 'required|numeric|min:1|max:999',
            'max_length' => 'required|numeric|min:1|max:999|greater_than:'.$request['min_width'],
            'sort_num' => 'required|numeric|max:999',
			'imagepro' => 'required',
            'status' => 'required',
        ];
        
    }
    
    public function messages()
	{
		return [
			'alias.unique' => 'This alias is already used for some other category',
		    'imagepro.required' => 'Image is required',
			'sort_num.required' => 'Order number is required',
			'sort_num.numeric' => 'Order number must be a number',
			'min_width.min' => 'Minimum width must be greater than zero',
			'max_width.min' => 'Maximum width must be greater than zero',
			'max_width.greater_than' => 'Maximum width must be greater than minimum width',
			'min_length.min' => 'Minimum length must be greater than zero',
			'max_length.min' => 'Maximum length must be greater than zero',
			'max_length.greater_than' => 'Maximum length must be greater than minimum length',
			'sort_num.max' => 'Order number can be a three digit number at max',
			'alias.alias_custom' => 'Alias should be 50 characters max and without space',
			
		];
	}
  
}

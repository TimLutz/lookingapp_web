<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddItem extends Request {

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
            'seller_user_id' 					=> 'required',
			'title' 							=> 'required',
	        'description' 						=> 'required',
	        'rating' 							=> 'required',
	        'item_active' 						=> 'required',
	        'price_in_primary_currency' 		=> 'required',
	        'primary_currency' 					=> 'required',
	        'type' 								=> 'required',
	        'restriction' 						=> 'required',
	        
        ];
	}
	
	public function messages()
	{
		return [
		];
	}
}

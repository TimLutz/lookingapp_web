<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Validator;
use Illuminate\Http\Request as HttpRequest;
class PropertyRequest extends Request
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
		
      switch($this->request->get('action'))
		{
			case 'add':
			{  
                $rules= array(
			'user_id' => 'required',
			'property_name' => 'required',
			'property_address' =>'required',
			'status' => 'required',
		);
		
			foreach($request->option as $key=>$option){
			$rules['option.'.$key] = 'required|max:50';
			
		}
		 }
		 case 'edit':
			{
				 $rules= array(
			'user_id' => 'required',
			'property_name' => 'required|max:150',
			'property_address' =>'required',
			'status' => 'required',
		);
		
			foreach($request->option as $key=>$option){
			$rules['option.'.$key] = 'required|max:50';
			
		}
		 }
   	default:break;
		}
			return $rules; 
	}
    public function messages()
	{
		 $messages = array(
			'user_id.required' => 'Houseowner is required',
		    'property_name.required' => 'Property Name is required',
		    'property_name.max' => 'Property name cannot be more than 150 characters',
		    'property_address.required' => 'Property Address is required',
		    'status.required' => 'Status is required',
		    'option.required' => 'This field is required',
		    'option.max' => 'Only 50 characters allowed',
		  
		);
		foreach($this->request->get('option') as $key=>$option){
		$messages['option.'.$key.'.required'] = 'This field is required';
		$messages['option.'.$key.'.max'] = 'Only 50 characters allowed';
		}
		return $messages;
	}
}

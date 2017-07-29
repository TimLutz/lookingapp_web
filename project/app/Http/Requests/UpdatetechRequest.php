<?php

namespace App\Http\Requests;

use Input;
use App\Http\Requests\Request;
use Illuminate\Http\Request as HttpRequest;

class UpdatetechRequest extends Request
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
		$valid= array(
            
            'technician' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'priority' => 'required',
            );
        return $valid; 
    }
    
    public function messages()
	{
		return [
			'technician.required' => 'Technician is required',
			'start_datetime.required' => 'Start Datetime is required',
			'end_datetime.required' => 'End Datetime is required',
			'priority.required' => 'Priority is required',
			
		];
	}
  
}

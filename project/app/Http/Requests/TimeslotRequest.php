<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Validator;
class TimeslotRequest extends Request
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
		
      switch($this->request->get('action'))
		{
			case 'add':
			{  
                 return [
						'from' => 'required',
						'to' => 'required',
						'status' => 'required'
             ];
		 }
		 case 'edit':
			{
				return [
						'from' => 'required',
						'to' => 'required',
						'status' => 'required'
             ];
		 }
   	default:break;
		}
		
	}
    public function messages()
	{
		return [
			'from.alias_custom' => 'Alias should be 50 characters max and without space',
		    'alias.regex' => 'The alias must contain only letters and numbers without spaces',
		    'title.title_custom' => "The title field may only contain letters,'-','.' and whitespaces.",
		    'name.alphaNumeric' => 'The name field may only contain letters and whitespaces. ',
		    'title.max' => ' The title field should not be more than 125 characters',
		    
		];
	}
}

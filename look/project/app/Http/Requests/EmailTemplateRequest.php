<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmailTemplateRequest extends Request
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
        return [
            'name' => 'required|alphaSpaces|min:3|max:50',
            'subject' => 'required|alphaNumeric|min:3|max:100',
            'content' => 'required|min:3'
        ];
    }
    public function messages()
	{
		return [
		    'name.min' => 'The name field must have atleast 3 characters.',
			'name.max' => ' The name field should not be more than 50 characters.',
			'name.alpha_spaces' => 'The name field may only contain letters and whitespaces.',
			'subject.required' => 'The subject field is required.',
			'subject.alpha_numeric' => 'The subject field may only contain letters , numbers and whitespaces.',
			'subject.min' => ' Subject Name field must have atleast 3 characters.',
			'subject.max' => ' Subject Name field should not be more than 100 characters.',
			'content.min' => 'Content field must have atleast 3 characters.'
			//'content.max' => 'Content field should not be more than 500 characters.'
			
		];
	}
}

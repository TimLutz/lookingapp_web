<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Validator;
class PagesRequest extends Request
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
						'title' => 'required|title_custom|min:3|max:125',
						'name' => 'required|alphaNumeric|min:3|max:125',
						'content' => 'required|min:3',
						//'alias' => 'required|AliasCustom|min:3|max:124|unique:pages',
						'meta_title' => 'required|min:3|max:50|alphaSpaces',
						'meta_description' => 'required|min:3|max:500',
						'meta_tags' => 'required|alphaNumeric|min:3|max:50',
						'status' => 'required'
             ];
		 }
		 case 'edit':
			{
				return [
						'title' => 'required|title_custom|min:3|max:125',
						'name' => 'required|alphaNumeric|min:3|max:125',
						'content' => 'required|min:3',
						//'alias' => 'required|AliasCustom|min:3|max:125|unique:pages,alias,'.$this->pageid.',id',
                       //'sort_num' => 'required|numeric|digits_between:1,2|unique:testimonials,sort_num,'.$this->pageid.',id',
                        'meta_title' => 'required|min:3|max:50|alphaSpaces',
						'meta_description' => 'required|min:3|max:500',
						'meta_tags' => 'required|alphaNumeric|min:3|max:50',
						'status' => 'required'
             ];
		 }
   	default:break;
		}
		
	}
    public function messages()
	{
		return [
			'alias.alias_custom' => 'Alias should be 50 characters max and without space',
		    'alias.regex' => 'The alias must contain only letters and numbers without spaces',
		    'title.title_custom' => "The title field may only contain letters,'-','.' and whitespaces.",
		    'name.alphaNumeric' => 'The name field may only contain letters and whitespaces. ',
		    'title.max' => ' The title field should not be more than 125 characters',
		    'title.min' => 'The title field must be atleast 3 characters',
		    //'content.max' => ' The content field should not be more than 500 characters',
		    'content.min' => 'The content field must be atleast 3 characters',
		    'alias.max' => ' The alias field should not be more than 125 characters',
		    'alias.min' => 'The alias field must be atleast 3 characters',
		    'meta_title.max' => ' The metatitle field should not be more than 50 characters',
		    'meta_title.min' => 'The metatitle field must be atleast 3 characters',
		    'meta_description.max' => ' The meta Description field should not be more than 500 characters',
		    'meta_description.min' => 'The meta Description field must be atleast 3 characters',
		    'meta_tags.max' => ' The metatag field should not be more than 50 characters',
		    'meta_tags.min' => 'The metatag field must be atleast 3 characters',
		    //'content.alpha_spaces' => 'The content field may only contain letters and whitespaces.',
		    'meta_title.alpha_spaces' => ' The metatitle may only contain letters and whitespaces',
		    'meta_description.alpha_numeric' => 'The Meta Description may only contain letters,numbers and whitespaces',
		    'meta_tags.alpha_numeric' => 'The meta tags should only contain letters,numbers and whitespaces'
		];
	}
}

<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditAdminProfile extends Request
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
            //
            'name'=>'required|alpha_spaces|min:3|max:32',
            //~ 'last_name'=>'required|alpha_spaces|min:3|max:32',
            'pic'=>'image'
        ];
    }
    
    public function messages()
	{
		return [
			'pic.image'	=> 'The profile picture must be an image.',
			'first_name.alpha_spaces'=> 'First name can have alphabets and spaces only.',
			'first_name.required'=> 'First name is Required.',
			'last_name.alpha_spaces'=> 'Last name can have alphabets and spaces only.',
			'last_name.required'=> 'Last name is Required.',
			'pic.image'	=> 'The profile picture must be an image.'
		];
	}
}

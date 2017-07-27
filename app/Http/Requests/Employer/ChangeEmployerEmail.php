<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class ChangeEmployerEmail extends FormRequest
{
    /*****************************************************************
     * Determine if the user is authorized to make this request.
     * @return bool
     *****************************************************************/
    public function authorize()
    {
        return true;
    }

    /******************************************************
     * Get the validation rules that apply to the request.
     * @return array
     ******************************************************/
    public function rules()
    {
        return [
           'new_email'       => 'required',
        ];
    }

    /************************************************************
     * Get the error messages for the defined validation rules.
     * @return array
     ************************************************************/
    public function messages() {
        return [
            'new_email' => 'Please enter new email.',
        ];
    }
}

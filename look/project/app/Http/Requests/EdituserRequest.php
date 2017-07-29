<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EdituserRequest extends Request
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
            'first_name'=>'required|Min:3|Max:50',
            'last_name'=>'required|Min:2|Max:50',
            'phone_number'=>trim('required|numeric|digits_between:10,12'),
            'address'=>'required|Min:2|Max:300'
        ];
    }
}

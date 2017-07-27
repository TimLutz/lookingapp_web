<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutusRequest extends FormRequest
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
            'message'=>'required|Min:50|Max:500',
        ];
    }

    public function messages()
    {
       return [
                'message.required'=>'Please specify your message.',
                'message.min'=>'Please specify message between 50 – 250 characters only.',
                'message.max'=>'Please specify message between 50 – 250 characters only.',
              ];
    }
}

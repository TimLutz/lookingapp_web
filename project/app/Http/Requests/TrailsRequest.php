<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TrailsRequest extends Request
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

    public function rules()
    {
        switch ($this->get('edit')) {
            case 'edit':
                $rules =  [
                    'days'=>'numeric|required'
                ];
                break;
            
            default:
                $rules =  [
                    'days'=>'numeric|required'
                ];
                break;
        }
        return $rules;    
       
    }

    public function messages()
    {
        return [
                    'days.numeric'=>'Days must be numeric',
                    'days.required'=>'Days can`t be empty'
               ];
    }
}

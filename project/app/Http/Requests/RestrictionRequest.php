<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RestrictionRequest extends Request
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
        switch ($this->get('edit')) {
            case 'edit':
                $rules =  [
                    'limit'=>'numeric|required'
                ];
                break;
            
            default:
                $rules =  [
                    'limit'=>'numeric|required'
                ];
                break;
        }
        return $rules;    
       
    }

    public function messages()
    {
        return [
                    'limit.numeric'=>'Limit must be numeric',
                    'limit.required'=>'Limit can`t be empty'
               ];
    }
}

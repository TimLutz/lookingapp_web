<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Input;
use App\Model\User;
class EmployerRequest extends FormRequest
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
       /* echo strlen(Input::get('phone'));
        die();*/

        return [
            //
            'first_name'=>'required|alpha|Min:2|Max:20',
            'last_name'=>'required|alpha|Min:2|Max:20',
            'phone'=>'required_if:company_contact,==,""|unique:users|',
            'company_name'=>'required|alpha_spaces|Min:2|Max:20',
            //'email'=>'required|email|unique:users|custom_unique_email',
            'email'=>'required|email|custom_unique_email',
            'password'=>'required|confirmed|password_custom',
            'password_confirmation'=>'required|password_custom',
            'company_address'=>'required|custom_location:'.Input::get('lat').','.Input::get('lat'),
            'user_image'=>'required|mimes:jpeg,png',
            'industry_type'=>'required|checkindustry',
            'agree'=>'required',
           /* 'contact_name'=>'required|Min:2|Max:20|alpha_spaces',*/
            'company_contact'=>'required_if:phone,==,""|unique:users',
            'number_worker'=>'required|numeric',
            'company_description'=>'required|Min:10'
        ];
    }


    public function messages(){
        

        $user = User::where(array('approved'=>2,'email'=>strtolower(Input::get('email'))))->first();
        if($user)
        {
            return [
                'first_name.required'=>'Please enter Contact First Name.',
                'last_name.required'=>'Please enter Contact Last Name.',
                'company_name.required'=>'Please enter Company Name.',
                'company_name.min'=>'Please enter Company name between 2-20 characters.',
                'company_name.max'=>'Please enter Company name between 2-20 characters.',
                'first_name.min'=>'Please enter Contact First Name between 2-20 characters.',
                'last_name.max'=>'Please enter Contact Last Name between 2-20 characters.',
                'last_name.min'=>'Please enter Contact Last Name between 2-20 characters.',
                'first_name.max'=>'Please enter Contact First Name between 2-20 characters.',
                'email.required'=>'Please enter your email.',
                'email.email'=>'Please enter a valid Email.',
                'password.required'=>'Please enter Password.',
                'password.confirmed'=>'Passwords do not match.',
                'password_confirmation.required'=>'Please enter Confirm Password.',
                'company_address.required'=>'Please enter location.',
                'industry_type.required'=>'Please select at least one value in type of industry field.',
                'agree.required'=>'Please agree to the T&C and Privacy Policy.',
                'user_image.required'=>'Image is required.',
                'user_image.mimes'=>'Image must be jpg and png.',
                'contact_name.required'=>'Please enter contact name.',
                'password.password_custom'=>'Password should be atleast one uppercase, one lowercase, alphabet and number',
                'company_contact.required_if'=>'Please enter contact number.',
                'phone.required_if'=>'Please enter at least one Contact Number',
                'number_worker.required'=>'Please select at least one value in number of workers’ field',
                'company_name.alpha_spaces'=>'Please enter a valid name without numbers or special characters.',
                /*'phone.numeric'=>'Please enter a valid mobile number',*/
                'email.unique'=>'Email already exists',
                'password.password_custom'=>'Password should be at between 6 to 25 characters long containing at least 1 number and 1 alphabet',
                'password_confirmation.password_custom'=>'Password should be at between 6 to 25 characters long containing at least 1 number and 1 alphabet',
                'first_name.alpha'=>'Please enter a valid Contact firstname without spaces numbers or special characters.', 
                'last_name.alpha'=>'Please enter a valid Contact lastname without spaces numbers or special characters.',
                'industry_type.checkindustry'=>'You cannot select more than 3 values in type of industry field.', 
                'phone.unique'=>'Your profile was declined by administrator.',
                'company_description.required'=>'Please enter Company description.',
                'email.custom_unique_email'=>'Your profile was declined by administrator.',
                'phone.min'=>'Phone number field should not accept less than 10 and more than 15 numbers',
                'phone.max'=>'Phone number field should not accept less than 10 and more than 15 numbers',
                'contact_name.alpha_spaces'=>'Please enter a valid contact name without numbers or special characters.',
                /*'company_contact.numeric'=>'Please enter a valid contact number.',*/
                'company_contact.min'=>'Phone number field should not accept less than 10 and more than 15 numbers.',
                'company_contact.max'=>'Phone number field should not accept less than 10 and more than 15 numbers.',
                'company_contact.unique'=>'Contact Number already exists.',
                'company_address.custom_location'=>'Please specify a valid location.',
                'email.custom_usercheck'=>'Your profile was declined by administrator',
                
            ];
        }
        else
        {
            return [
                'first_name.required'=>'Please enter Contact First Name.',
                'last_name.required'=>'Please enter Contact Last Name.',
                'company_name.required'=>'Please enter Company Name.',
                'company_name.min'=>'Please enter Company name between 2-20 characters.',
                'company_name.max'=>'Please enter Company name between 2-20 characters.',
                'first_name.min'=>'Please enter Contact First Name between 2-20 characters.',
                'last_name.max'=>'Please enter Contact Last Name between 2-20 characters.',
                'last_name.min'=>'Please enter Contact Last Name between 2-20 characters.',
                'first_name.max'=>'Please enter Contact First Name between 2-20 characters.',
                'email.required'=>'Please enter your email.',
                'email.email'=>'Please enter a valid Email.',
                'password.required'=>'Please enter Password.',
                'password.confirmed'=>'Passwords do not match.',
                'password_confirmation.required'=>'Please enter Confirm Password.',
                'company_address.required'=>'Please enter location.',
                'industry_type.required'=>'Please select at least one value in type of industry field.',
                'agree.required'=>'Please agree to the T&C and privacy policy.',
                'user_image.required'=>'Image is required.',
                'user_image.mimes'=>'Image must be jpg and png.',
                'contact_name.required'=>'Please enter contact name.',
                'password.password_custom'=>'Password should be atleast one uppercase, one lowercase, alphabet and number',
                'company_contact.required_if'=>'Please enter contact number.',
                'phone.required_if'=>'Please enter at least one Contact Number',
                'number_worker.required'=>'Please select at least one value in number of workers’ field',
                'company_name.alpha_spaces'=>'Please enter a valid name without numbers or special characters.',
                /*'phone.numeric'=>'Please enter a valid mobile number',*/
                'email.unique'=>'Email already exists',
                'password.password_custom'=>'Password should be at between 6 to 25 characters long containing at least 1 number and 1 alphabet',
                'password_confirmation.password_custom'=>'Password should be at between 6 to 25 characters long containing at least 1 number and 1 alphabet',
                'first_name.alpha'=>'Please enter a valid Contact firstname without spaces numbers or special characters.', 
                'last_name.alpha'=>'Please enter a valid Contact lastname without spaces numbers or special characters.',
                'industry_type.checkindustry'=>'You cannot select more than 3 values in type of industry field.', 
                'phone.unique'=>'Phone number already exist.',
                'company_description.required'=>'Please enter Company description.',
                'email.custom_unique_email'=>'Email already exist.',
                'phone.min'=>'Phone number field should not accept less than 10 and more than 15 numbers',
                'phone.max'=>'Phone number field should not accept less than 10 and more than 15 numbers',
                'contact_name.alpha_spaces'=>'Please enter a valid contact name without numbers or special characters.',
                /*'company_contact.numeric'=>'Please enter a valid contact number.',*/
                'company_contact.min'=>'Phone number field should not accept less than 10 and more than 15 numbers.',
                'company_contact.max'=>'Phone number field should not accept less than 10 and more than 15 numbers.',
                'company_contact.unique'=>'Contact Number already exists.',
                'company_address.custom_location'=>'Please specify a valid location.',
                'email.custom_usercheck'=>'Your profile was declined by administrator',
                
            ];
        }
    }
}

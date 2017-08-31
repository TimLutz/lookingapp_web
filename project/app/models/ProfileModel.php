<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProfileModel extends Model
{
    // Table name
    protected $table = 'profiles';

 // Field in table
    protected $fillable = ['user_id','start_time','end_time','profile_name','location','identity','ethnicity','position','behaviour','latitude','longitude','travel_plans','orientation','safe_sex','HIV_status','cock_size','cock_type','kinks_and_fetishes','birthday','race','height','height_cm','weight','Weight_kg','hair_color','body_hair','facial_hair','eye_color','body_type','drugs','drinking','smoking','about_me','his_identitie','relationship_status','where_I_leave','facebook_link','twitter_link','linkedin_link','age'];


    /*public function setBirthdayAttribute($value) {
    	//die('bcvcn');
        $this->attributes['birthday'] = $value;
        $this->attributes['age'] = Carbon::now()->diffInYears(Carbon::parse($value));
    }


	public function getBirthdayAttribute($value)
	{
		return strtolower($value);
	}*/
}

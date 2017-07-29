<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserpartnerModel extends Model
{
    //
    protected $table = 'user_partners';

    protected $fillable = ['user_id','location','sexual_role','orientation','safe_sex','HIV_status','cock_size','cock_type','kinks_and_fetishes','age_range','race','height','weight','hair_color','body_hair','facial_hair','eye_color','body_type','drugs','drinking','smoking','ethinicity','identities','position','behaviour'];
}

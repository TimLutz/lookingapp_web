<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLooksexdateModel extends Model
{
    //
    protected $table = 'user_look_datesex';

    protected $fillable = ['user_id','look_type','profile_name','description','start_time','end_time','duration','notification_time','is_notify','is_active'];

    protected $dates = ['created_at','updated_at','end_time','start_time'];


    public function Userdatesextype()
    {
    	return $this->hasMany('App\Models\UserLokDatesexTypeModel','lookdatesex_id');
    }
}

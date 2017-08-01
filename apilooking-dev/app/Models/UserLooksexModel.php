<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLooksexModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='user_looksexes';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = [
        'user_id','profile_name','description','my_physical_appearance','his_physical_appearance',' 	my_sextual_preferences','his_sextual_preferences','my_social_habits','his_social_habits','start_time','end_time','duration','notification_time','is_notify','is_active'
    ];
}
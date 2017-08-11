<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserLookdateModel extends Model
{
    //
    protected $table = 'user_lookdates';

    protected $fillable = ['user_id','profile_name','my_traits','his_traits','my_interest','my_physical_appearance','his_physical_appearance','my_sextual_preferences','his_sextual_preferences','my_social_habits','his_social_habits'];
}

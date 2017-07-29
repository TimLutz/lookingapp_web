<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = 'location';

    protected $fillable = ['user_id','contact_name','street_no','street_name','email','mobile','note','pick_loc','drop_loc','status'];
}

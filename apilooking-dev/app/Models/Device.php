<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $table = 'devices';
    protected $fillable = ['device_token','device_type','user_id'];

  
}

<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Notificationadmin extends Model
{
    //
    protected $table = 'admin_notifications';
    protected $fillable = ['from_id','to_id','type','content','status'];

    
}

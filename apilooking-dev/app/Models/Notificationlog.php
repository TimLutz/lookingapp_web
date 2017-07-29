<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Notificationlog extends Model
{
    //
    protected $table = 'notification_logs';
    protected $fillable = ['task_id','task_type','title','sent_to_id'];

  
}

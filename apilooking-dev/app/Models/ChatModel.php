<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='chat_users';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = [
        'user_id','blocked_id','blook_dt'
    ];
    
    

   


}
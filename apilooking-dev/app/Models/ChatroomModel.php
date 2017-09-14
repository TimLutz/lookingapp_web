<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatroomModel extends Model
{
    //
    protected $table = 'chat_room';

    protected $fillable = ['from_user','to_user','invite'];
}

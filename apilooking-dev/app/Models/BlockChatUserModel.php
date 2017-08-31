<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class BlockChatUserModel extends Model
{
    //
    protected $table = 'block_chat_users';

    protected $fillable = ['user_id','block_user_id','is_blocked'];
}

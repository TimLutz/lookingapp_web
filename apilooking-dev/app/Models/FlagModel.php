<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlagModel extends Model
{
    //
    protected $table = 'flags';
    protected $fillable = ['sender_id','receiver_id','archive','flag'];
}

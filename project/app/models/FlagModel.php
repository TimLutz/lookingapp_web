<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlagModel extends Model
{
    //
    protected $table = 'flags';
    protected $fillable = ['sender_id','receiver_id','archive','flag'];

    public function flagUser()
    {
    	return $this->belongsTo('App\User','sender_id');
    }

    public function flagReceiverUser()
    {
    	return $this->belongsTo('App\User','receiver_id');
    }
}

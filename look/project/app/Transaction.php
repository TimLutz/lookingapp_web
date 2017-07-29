<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
     protected $table = 'transactions';

     protected $fillable = ['user_id','service_id','booking_id','amount','payment_status','transaction_id','remarks','status'];

    public function bookings()
    {
    	return $this->belongsTo('App\Booking','booking_id');
    }

    public function userss()
    {
    	return $this->belongsTo('App\User','user_id')->where('status','!=','2');
    }

    public function services()
    {
    	return $this->belongsTo('App\Services','service_id')->where('status','!=','2');
    }
}

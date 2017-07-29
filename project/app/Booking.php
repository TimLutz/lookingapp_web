<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $table = 'booking_detail';

    protected $fillable = ['user_id','quotation_id','pic_companyname','pic_email','pic_mobile','pic_streetno','pic_streetname','pic_landmark','del_companyname','del_email','del_mobile','del_streetno','del_streetname','del_landmark','service_id','mode_type','delivery_date','pickup_time','delivery_time','atl','amount','item_description','order_status','comment','status'];

    //protected $fillable = ['order_status','comment'];

    public function transactions()
    {
    	return $this->hasOne('App\Transaction', 'booking_id')->where('status',1)
                                                             ->where('payment_status',1);
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id')->where('status','1');
    }

    public function service()
    {
    	return $this->belongsTo('App\Services','service_id')->where('status','!=','2');
    }

    public function quotatio()
    {
        return $this->belongsTo('App\Quotation', 'quotation_id')->where('status','!=','2');
    }

    public function modes()
    {
        return $this->belongsTo('App\Modes','mode_type')->where('status','!=','2');
    }
}

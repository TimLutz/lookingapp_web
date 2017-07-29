<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    //
	protected $table = 'quotation';

	protected $fillable = ['pick_location','drop_location','email','mobile','mode_type','type','package_description','delivery_date','quotation_price','competingname','message','status','service_id','user_id','amount','note'];

    public function users()
	{
		return $this->belongsTo('App\User')->where('status','!=','2');
	}
	
	public function servicee()
	{
		return $this->belongsTo('App\Services','service_id')->where('status','!=','2');
	} 

	public function booked()
	{
		return $this->hasOne('App\Booking','quotation_id')->where('status','!=','2');
	}

	public function mode()
	{
		return $this->belongsTo('App\Modes','mode_type')->where('status','!=','2');
	}


}

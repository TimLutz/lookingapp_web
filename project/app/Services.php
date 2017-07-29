<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    //
    protected $table = 'services';

    public function bookservice()
    {
    	return $this->hasMany('App\Booking','service_id');
    }

    public function transactionser()
    {
        return $this->hasMany('App\Transaction','service_id');
    }
    
    public function setStatus($id, $status)
	{
		
		
	   // return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="faqs" data-status="'.($status ? 0 : 1).'"><i class="fa fa-circle '.($status ? "active" : "inactive").'"></i></a>';
		return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-action="dashboard" data-table="services" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa-circle text-success active" : "fa-circle text-danger inactive").'"></i></a>'; 
	}
}

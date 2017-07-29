<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicecharge extends Model
{
    //
    protected $table = 'service_charge';
    
    protected $fillable  = ['type','price','status'];

    public function setStatus($id, $status)
	{
		
		
	   // return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="faqs" data-status="'.($status ? 0 : 1).'"><i class="fa fa-circle '.($status ? "active" : "inactive").'"></i></a>';
		return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-action="dashboard" data-table="service_charge" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa-circle text-success active" : "fa-circle text-danger inactive").'"></i></a>';
	}
}

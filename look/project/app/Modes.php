<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modes extends Model
{
    //

    protected $table = 'mode_delivery';

    protected $fillable = ['title','description','status'];

    public function setStatus($id, $status)
	{
		
		
	   // return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="faqs" data-status="'.($status ? 0 : 1).'"><i class="fa fa-circle '.($status ? "active" : "inactive").'"></i></a>';
		return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-action="dashboard" data-table="mode_delivery" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa-circle text-success active" : "fa-circle text-danger inactive").'"></i></a>';
	}

	public function quotemode()
	{
		return $this->hasMany('App\Quotation','mode_type')->where('status','!=','2');
	}

	public function bookmode()
	{
		return $this->hasMany('App\Modes','mode_type')->where('status','!=','2');
	}

	public function setting()
	{
		return $this->hasMany('App\Settings','mode_type')->where('status','!=','2');
	}
}

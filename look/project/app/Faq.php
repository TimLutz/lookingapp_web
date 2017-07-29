<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    //
    
    protected $table = 'faqs';
    
    protected $fillable = [
	    'question',
	    'answer',
	    'status',
	    'sort_order',
	    'status','sort_num'
	];
	
	public function setStatus($id, $status)
	{
		// return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="faqs" data-status="'.($status ? 0 : 1).'"><i class="fa fa-circle '.($status ? "active" : "inactive").'"></i></a>';
		return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="faqs" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa-circle text-success active" : "fa-circle text-danger inactive").'"></i></a>';
	}
	
	
	
}

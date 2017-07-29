<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
     protected $table = 'managehomes';
    
    protected $fillable = [
	    'name',
	    'description',
	    'type',
	    'type_value',
	    'image',
	    'button_text',
	    'url',
	    'product_id',
	    'sort_num',
	    'sort_num_grid',
	    'status',
	    'urltype'
	    
	];
	
	public function setStatus($id, $status)
	{
		
		return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="managehomes" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa-circle text-success active" : "fa-circle text-danger inactive").'"></i></a>';
	}

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyAttribute extends Model
{
    
    protected $table = 'property_attributes';
    
     protected $fillable = [
	    'prop_id',
	    'attribute_name',
	    'status'
	];
	
		/**  Belongs To Relationship with Property Model  **/
	public function property()
	{
		return $this->belongsTo('App\Property');
	}
	
	public function setStatus($id, $status)
	{
		
		return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="property_attributes" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa-circle text-success active" : "fa-circle text-danger inactive").'"></i></a>';
	}
}

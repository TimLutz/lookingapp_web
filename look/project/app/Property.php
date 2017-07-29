<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
 //   protected $fillable = ['status'];
    protected $table = 'properties';
    
     protected $fillable = [
	    'user_id',
	    'property_name',
	    'property_address',
	    'latitude',
	    'longitude',
	    'city',
	    'state',
	    'zipcode',
	    'status'
	];
	
	/**  Has Many Relationship with PropertyAttribute Model  **/
	public function property_attributes()
	{
		return $this->hasMany('App\PropertyAttribute','prop_id');
	}
	
	
	
	
	public function setStatus($id, $status)
	{
		
		return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="properties" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa-circle text-success active" : "fa-circle text-danger inactive").'"></i></a>';
	}
}

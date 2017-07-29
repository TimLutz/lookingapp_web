<?php

namespace App\Models;

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
		return $this->hasMany('App\Models\PropertyAttribute','prop_id');
	}
}

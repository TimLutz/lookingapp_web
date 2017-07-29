<?php

namespace App\Models;

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
		return $this->belongsTo('App\Models\Property');
	}
}

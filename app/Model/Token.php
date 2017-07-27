<?php 
namespace App\Model;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Token extends Eloquent {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'token',
        
    ];
	
	

}

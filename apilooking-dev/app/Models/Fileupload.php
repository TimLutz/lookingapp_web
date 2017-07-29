<?php namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Fileupload extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $collection = 'uploadedfiles';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['file_name','file_path'];

	
    protected $dates = ['created_at','updated_at'];

    
	

	
	
}

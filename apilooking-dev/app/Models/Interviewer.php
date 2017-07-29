<?php namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Interviewer extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $collection = 'employer_interviewer';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['employer_id','interviewer_name','interviewer_email','status'];

	
   
	
	public function Employer()
    {
        return $this->belongsTo('App\Models\User');
    }
	
	
}

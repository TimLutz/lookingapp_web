<?php namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class JobApplication extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $collection = 'job_applications';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['job_id','user_id','application_status','interviewer_name','jobseeker_status','status','interviewer_id'];

	
    protected $dates=['interview_scheduled_time','interview_date'];
	
    public function jobseekers()
    {
        return $this->hasOne('App\Models\JobSeekers','user_id','user_id');
    }
    public function user()
    {
        return $this->hasOne('App\Models\User','_id','user_id');
    }
    public function interviewer()
    {
        return $this->hasOne('App\Models\Interviewer','_id','interviewer_id');
    }
    public function generalinfo()
    {
        return $this->hasOne('App\Models\GeneralInformation','user_id','user_id');
    }
	
	
}

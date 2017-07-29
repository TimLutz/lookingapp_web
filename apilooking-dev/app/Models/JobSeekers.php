<?php namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class JobSeekers extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $collection = 'jobseekers';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	
	protected $fillable = ['user_id','skills','languages','target_job_category','cv_percentage','overall_rating','location_allowed','push_notofication_allowed','more_info','general_cv_percentage','skills_percentage','language_percentage','experience_percentage','proffesional_experience','personal_experience_percentage','personal_experience','job_contract_type','preffered_city','total_experience']; 

	
   
	
	public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function jobapplication()
    {
        return $this->hasMany('App\Models\JobApplication','user_id','user_id');
    }
    public function experience()
    {
    	return $this->hasMany('App\Models\Experience','user_id','user_id');
    }
	
	
}

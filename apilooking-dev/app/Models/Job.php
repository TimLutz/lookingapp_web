<?php namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Job extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $collection = 'jobs';
	protected $with=['jobcategory'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['job_title','job_description','job_cat_id','coordinates','job_type','job_published_level','job_min_age','job_max_age','employer_id','job_salary_per_hour','job_education_level_required','job_experience','job_contract_type','job_address','job_image_full','status','languages','job_city','job_image_medium','job_image_thumbnail'];

	
    protected $dates=['job_start_date','job_end_date','deleted_at'];

    public function getJobCatIdAttribute($value)
    {
        return (string)$value;
    }
    public function jobcategory()
    {
    	return $this->belongsTo('App\Models\Jobcategory','job_cat_id','_id');
    }
	

	
	
}

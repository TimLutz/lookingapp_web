<?php namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Experience extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $collection = 'user_experiences';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	
    protected $fillable = ['job_title_for_experince','company_name','contact_person_name','experience_type','experience_start_date','experience_end_date','current_working','contact_person_email','contact_person_phone','verified_by_referral','referance_letter','doc_path'];
    
    /**
     * The attributes that are dates.
     *
     * @var array
     */
	
	protected $dates=['experience_start_date','experience_end_date'];
}

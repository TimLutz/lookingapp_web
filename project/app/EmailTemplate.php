<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'subject',
        'content'
    ];
	
	/**  Has Many Relationship with EmailTemplateAttribute Model  **/
	public function template_attributes()
	{
		return $this->hasMany('App\EmailTemplateAttribute','email_template_id');
	}

}

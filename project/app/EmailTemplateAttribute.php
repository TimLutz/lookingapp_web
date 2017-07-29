<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateAttribute extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'email_template_id',
		'variable'
    ];

	/**  Belongs To Relationship with EmailTemplate Model  **/
	public function email_template()
	{
		return $this->belongsTo('App\EmailTemplate');
	}
}

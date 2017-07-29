<?php namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class ContactRequest extends Moloquent {
	
	use SoftDeletes;
	
	protected $collection = 'contact_requests';
	protected $primarykey = "_id";

	protected $fillable = ['user_id', 'type', 'subject','content'];
	
	public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

} 

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model {

protected $table = 'testimonials';

	protected $fillable = [
	    'organisation',
	    'employee_name',
	    'employee_designation',
	    'description',
	    'loc_id',
		'image',
		'img_alt_txt',
		'status','sort_num'
	];	
	public function setStatus($id, $status)
	{
	    return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="testimonials" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa-circle text-success active" : "fa-circle text-danger inactive").'"></i></a>';
	}
	
	public function scopeStatus($query, $value){
	    $query->where('status', '=', $value);
	}
	public function settings()
	{
		return $this->belongsTo('App\Settings','loc_id');
	}
}

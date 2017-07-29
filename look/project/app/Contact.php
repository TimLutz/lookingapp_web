<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $table = 'contacts';
    protected $fillable = ['name','address','city','state','product_id','zip','number','interested_in','email','subject','message','comment'];

    public function settings()
	{
		return $this->belongsTo('App\Settings','interested_in');
	}
	
	public function products()
	{
		return $this->belongsTo('App\models\Product','product_id');
	}
    
    public function setStatus($id, $status)
    {
        return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="contacts" data-action="contact" title="Update status" data-status="'.($status ? 0 : 1).'"><i class="fa fa-circle '.($status ? "active" : "inactive").'"></i></a>';
    }
    
}

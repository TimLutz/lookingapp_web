<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  //   protected $fillable = ['status'];
   // protected $table = 'pages';
   protected $fillable = [
        'title',
		'name',
		'meta_title',
		'meta_description',
		'meta_tags',
        'content',
        'status',
		'alias'
    ];
	
	protected $dates = [
        'created_at',
        'updated_at'
    ];
    
    public function setStatus($id, $status)
	{
	    return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="pages" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa-circle text-success active" : "fa-circle text-danger inactive").'"></i></a>';
	}
}

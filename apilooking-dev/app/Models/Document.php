<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $table = 'documents';
    protected $fillable = ['type','type_id','filename'];

    /**  Belongs To Relationship with Task Model  **/
	public function task()
	{
		return $this->belongsTo('App\Models\Task');
	}
}

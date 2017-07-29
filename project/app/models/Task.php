<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $table = 'tasks';
    
        protected $fillable = ['task_name','client_id','note_detail','priority','document_id','technician_id','assigned_date','scheduled_date','start_datetime','end_datetime','task_completed_date','rating','comments','property_id','attribute_id','status'];
    
     /**  Has Many Relationship with Document Model  **/
	public function task_documents()
	{
		return $this->hasMany('App\models\Document','type_id');
	}

    public function setStatus($id, $status)
	{
		
		return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-action="dashboard" data-table="tasks" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa-circle text-success active" : "fa-circle text-danger inactive").'"></i></a>';
	}
    
}

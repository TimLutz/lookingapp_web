<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Generalnote extends Model
{
    //
    protected $table = 'general_notes';
    protected $fillable = ['user_id','client_notes'];

    public function setStatus($id, $status)
	{
		
		return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-action="dashboard" data-table="general_notes" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa-circle text-success active" : "fa-circle text-danger inactive").'"></i></a>';
	}
    
}

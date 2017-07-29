<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Generalfield extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $collection='general_fields';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = [
        'question','status','type_of_question','option',
    ];
    
     public function setStatus($id, $status)
    {
        return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="general_fields" data-action="pages" data-status="'.($status ? 0 : 1).'"><i class="fa fa-circle '.($status ? "active" : "inactive").'"></i></a>';
    }

   


}

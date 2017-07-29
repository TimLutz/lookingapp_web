<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model ;

class Plan extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['plan_start_date','plan_end_date'];
    protected $fillable = [
        'plan_name', 'plan_descritpion','plan_type','status','plan_duration'
    ];


    public function setStatus($id, $status)
    {
        return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="plans" data-action="pages" data-status="'.($status ? 0 : 1).'"><i class="fa fa-circle '.($status ? "active" : "inactive").'"></i></a>';
    }

   
}

<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class EmployerSubscription extends Model
{
    protected $table='employer_subscription_tracking';
    protected $dates = ['subscription_start_date','subscription_end_date','plan_expire'];
    protected $fillable = [
        'employer_id', 'view_cv_count','plan_expire','plan_id','remaining_view_count',
    ];
    
    public function user()
    {
    	 return $this->belongsTo('App\Models\User','employer_id','_id');
    }

    

}

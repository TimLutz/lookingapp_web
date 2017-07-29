<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Jobcategory extends Eloquent
{
    protected $collection='job_category';
    protected $dates = ['created_at','updated_at','deleted_at'];
    
    protected $fillable = [
        'job_cat_name', 'job_cat_description','job_cat_image','status',
    ];
    
   
}


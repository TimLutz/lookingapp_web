<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Skill extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $collection='master_skills';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = [
        'skill_name','status',
    ];
    
    

   


}

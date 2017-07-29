<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Language extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $collection='master_languages';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = [
        'language_name','status', 'proficeincy_level',
    ];
    
    

   


}

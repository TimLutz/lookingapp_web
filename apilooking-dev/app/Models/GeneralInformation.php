<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class GeneralInformation extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $collection='general_information';
    protected $dates = ['created_at','updated_at'];
    
    
    
   


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestrictionModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='user_restrictions';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = [
        'member_type','limit_type','limit','name'
    ];
    
    

   


}
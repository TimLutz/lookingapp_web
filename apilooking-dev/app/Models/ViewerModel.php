<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewerModel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='viewers';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = [
        'user_id','viewer_user_id','is_view'
    ];
    
    

   


}
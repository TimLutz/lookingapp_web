<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Cronejob extends Model
{
    //
    protected $table = 'crone_jobs';
    protected $fillable = ['type','status','description'];

  
}

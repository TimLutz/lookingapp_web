<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    //
    protected $table = 'timeslots';
    protected $fillable = ['from','to','status'];

    
}

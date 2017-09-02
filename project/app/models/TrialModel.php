<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TrialModel extends Model
{
    //
    protected $table = 'trials';

    protected $fillable = ['days'];
}

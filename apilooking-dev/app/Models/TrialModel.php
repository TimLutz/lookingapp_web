<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrialModel extends Model
{
    //
    protected $table = 'trials';

    protected $fillable = ['month'];
}

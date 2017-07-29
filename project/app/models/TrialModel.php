<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TrialModel extends Model
{
    //
    protected $table = 'trials';

    protected $fillable = ['month'];
}

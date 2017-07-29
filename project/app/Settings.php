<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    //
    protected $table = 'settings';

    protected $fillable = ['sort_num','type','key','value'];

   

}

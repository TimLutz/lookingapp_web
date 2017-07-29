<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected $table = 'note';
    protected $fillable = ['title','description','status'];

}

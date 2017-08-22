<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhraseModel extends Model
{
    //
	protected $table = 'phrases';
	protected $fillable = ['user_id','phrases'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLokDatesexTypeModel extends Model
{
    //
    protected $table = 'user_lok_datesex_type';

    protected $fillable = ['user_id','lookdatesex_id','type','looktype','name'];

    protected $dates = ['created_at','updated_at'];
}

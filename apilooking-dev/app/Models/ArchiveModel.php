<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchiveModel extends Model
{
    //
    protected $table = 'archives';

    protected $fillable = ['user_id','photo_name','caption'];

    protected $dates = ['created_at','updated_at'];

}
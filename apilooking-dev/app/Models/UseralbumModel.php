<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UseralbumModel extends Model
{
    //
    protected $table = 'user_albums';
    protected $fillable = ['user_id','photo_name','file_type','caption','album_type'];
    
}

<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FavouriteModel extends Model
{
    //
    protected $table = 'favourites';
    protected $fillable = ['user_id','favourite_user_id','is_favourite','browse'];
}

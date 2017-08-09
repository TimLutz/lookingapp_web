<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserIdentityModel extends Model
{
    //
    protected $table = 'user_identities';
    protected $fillable = ['user_id','type','name'];
}

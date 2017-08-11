<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileLockModel extends Model
{
    //
    protected $table = 'profile_locks';

    protected $fillable = ['user_id','look_user_id','is_looked','count','browse'];


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileLockModel extends Model
{
    //
    protected $table = 'profile_locks';

    protected $fillable = ['user_id','lock_user_id','is_locked','count','browse'];


}

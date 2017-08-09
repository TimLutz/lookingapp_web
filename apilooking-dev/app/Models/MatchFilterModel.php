<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchFilterModel extends Model
{
    //
    protected $table = 'matches_filter_values';

    protected $fillable = ['user_id','enable_filters','online','match','user_photos','his_identities','his_seeking','ethnicity','relationship_status','age','height','weight','type','list_array'];
}

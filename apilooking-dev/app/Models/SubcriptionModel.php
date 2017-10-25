<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubcriptionModel extends Model
{
    //
	protected $table = 'subscriptions';

	protected $fillable = ['price','month'];

	protected $dates = ['created_at','updated_at'];
}

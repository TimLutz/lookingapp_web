<?php namespace App\models;

use Illuminate\Database\Eloquent\Model;


class UserBadge extends Model{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_badges';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id','notification_count'];

	
    
	

	
	
}

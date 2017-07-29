<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use  Authenticatable, CanResetPassword;

	protected $connection = 'mysql';
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	  protected $fillable = ['screen_name','token','email','password','original_password','country','city','status','profile_status','online_status','lat','long','profile_pic','profile_pic_type','is_completed','device_token','device_type','registration_status','accuracy','member_type','is_trial','removead','profiletext_change','photo_change','role','remember_token','created_at','updated_at','valid_upto'];


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password'];
}

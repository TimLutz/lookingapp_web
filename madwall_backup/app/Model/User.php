<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Notifications\UserResetPasswordNotification;
class User extends Model implements 
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Notifiable, Authenticatable, Authorizable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [ ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*==========================
        Relation With timeslots
    ============================
    */
    public function timeslots(){
        return $this->HasMany('App\Model\TimeSlot','user_id','_id');
    }

    /*============================
        Relation With jobs model
    ==============================
    */
    public function userjobs(){
        return $this->HasMany('App\Model\JobsModel','user_id','_id');
    }
    
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
    
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }
}

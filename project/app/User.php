<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

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
    protected $hidden = ['password', 'remember_token'];
    

    public function setPhoto($path, $photo){
        $photo = ($photo ? $photo : 'null');
        if(file_exists($path.$photo)){
            return '<img src="/'.$path.$photo.'" />';
        }
        return '<img src="/uploads/userDefImage.png">';
    }
     public function setStatus($id, $status)
    {
        
        
       // return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-table="faqs" data-status="'.($status ? 0 : 1).'"><i class="fa fa-circle '.($status ? "active" : "inactive").'"></i></a>';
        return '<a href="javascript:void(0);" class="changeStatus" data-id="'.$id.'" data-action="dashboard" data-table="users" data-status="'.($status ? 0 : 1).'"><i class="fa '.($status ? "fa fa-check-circle text-success active" : "fa fa-check-circle text-danger inactive").'"></i></a>';
    }

    public function Profile()
    {
        return $this->hasOne('App\models\ProfileModel','user_id');
    }
}

<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use App\Model\NotificationModel;
use Blade;
use Auth;
use Flash;
class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }

    public static function getAllNotification()
    {
      $notification = NotificationModel::where(array('status'=>true,'to'=>Auth::user()->_id))->get();
      
      $not_count= count($notification);
     // $content =  view('employer.promo.ajaxnotification',compact('notification','not_count'))->render();
      $result = ['not_count'=>$not_count,'notification'=>$notification];
      return $result;
    }

    public static function checkUser()
    {
    	if(Auth::user()->role == 3)
        {
            if(Auth::user()->approved==2){
                flash()->error('Your profile was declined by administrator.');
               return redirect('employer/logout');
            }
        }
    }
}
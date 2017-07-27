<?php namespace repositories;
use App\User;
use Auth;
use Cookie;
use Illuminate\Support\Facades\DB;

class MadwallGlobalFunctions implements MadWallGlobalInterface
{
	
	/** Function to set size of photo **/
	public static function setPhoto( $path,$width=50,$height=50 ){
		$url = asset('/timthumb.php?src='.$path.'&w='.$width.'&h='.$height.'&zc=2');
        return $url;
    }
       
}
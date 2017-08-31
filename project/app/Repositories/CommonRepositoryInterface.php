<?php
namespace repositories;

interface CommonRepositoryInterface
{  
	public static function getinfo();
	//public static function getNotifications();
	public static function setPhoto($path,$width=50,$height=50);
}

?>

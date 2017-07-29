<?php
namespace repositories;

interface CommonRepositoryInterface
{  
	public static function getinfo();
	//public static function getNotifications();
	public static function setPhoto($path,$width=50,$height=50);

	//public static function getGraphInfo();
	public static function getmodetype();
	public static function getservices();
	public static function getPickuplocation();
	public static function getDistance($origin=null, $destination=null);
	public static function getRadius();
	public static function getAddtionalCharge($mode_id = null);
	public static function getFullCharge($mode_id = null,$distance1=null,$distance2=null,$radius=null,$service_id = null);
	public static function getService($mode_id = null);
	public static function getFuelcharge();
	public static function getMarcenttax();
	public static function getVattax();
	public static function message();
}

?>

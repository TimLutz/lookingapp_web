<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['backbutton']], function() 
{
	Route::controller('pages', 'PagesController');
	Route::group(['prefix' =>getenv('adminurl'),'backbutton'], function()
	{
		Route::get('/', 'Admin\AdminController@Index');
		Route::get('users/genrateCsv','Admin\UsersController@genrateCsv');
		Route::get('users/genrateCsv1','Admin\UsersController@genrateCsvBannedUser');
		Route::post('pages/list-pages', 'Admin\PagesController@ListPages');
		Route::controller('users','Admin\UsersController');
		Route::controller('photos','Admin\PhotosController');
		Route::controller('trials','Admin\TrialController');
		Route::controller('reports','Admin\UserReportController');
		Route::controller('profiletext','Admin\ProfiletextController');
		Route::controller('userrestriction','Admin\UserRestrictionController');
		Route::controller('multidelete', 'Admin\MultideleteController');
		Route::controller('auth', 'Admin\AdminauthController');
		Route::controller('dashboard', 'Admin\AdminController');
		Route::controller('password', 'Admin\AdminPasswordController');
		Route::controller('password', 'Admin\AdminPasswordController');
		Route::resource('template', 'Admin\TemplateController');
		Route::resource('pages', 'Admin\PagesController');
	});
	Route::controller('common', 'CommonController');
	
Route::get('terms','PagesController@getTandc');
Route::get('reset-password/{token}', 'PasswordController@reset');
Route::post('app-password-reset', 'PasswordController@Resetpassword');
});	

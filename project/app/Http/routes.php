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
		Route::get('users/genrateCsv','admin\UsersController@genrateCsv');
		Route::get('users/genrateCsv1','admin\UsersController@genrateCsvBannedUser');
		Route::controller('users','Admin\UsersController');
		Route::controller('photos','Admin\PhotosController');
		Route::controller('multidelete', 'Admin\MultideleteController');
		Route::controller('auth', 'Admin\AdminauthController');
		Route::controller('dashboard', 'Admin\AdminController');
		Route::controller('password', 'Admin\AdminPasswordController');
		Route::controller('password', 'Admin\AdminPasswordController');
		Route::resource('template', 'Admin\TemplateController');
	});
	Route::controller('common', 'CommonController');
	
Route::get('reset-password/{token}', 'PasswordController@reset');
Route::post('app-password-reset', 'PasswordController@Resetpassword');
});	

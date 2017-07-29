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
Route::controller('pages', 'PagesController');

	Route::group(['prefix' => getenv('adminurl')], function()
	{
		Route::post('notification','admin\NotificationController@changestatus');
		Route::controller('timeslot', 'admin\TimeslotController');
		Route::get('properties/{userid}','admin\PropertyController@getIndex');
		Route::post('properties/list-properties/{userid}','admin\PropertyController@postListProperties');
			Route::get('/', 'Admin\AdminController@Index');
			Route::controller('users','admin\UsersController');
			Route::controller('tasks','admin\TaskController');
			Route::post('status','admin\TaskController@status');
			Route::post('technician-assigned','admin\TaskController@technicianAssigned');
			Route::post('updatestatus','admin\TaskController@updatestatus');
			Route::post('technicianupdate','admin\TaskController@technicianupdate');
			Route::controller('notes','admin\GeneralNotesController');
			
			Route::controller('properties','admin\PropertyController');
			
			Route::post('contact/change-status', 'admin\ContactusController@postChangeStatus');
			Route::post('/dashboard/detailsTestimonials','admin\TestimonialsController@detailstestimonials');
			Route::resource('contact', 'admin\ContactusController');
			
			Route::resource('pages', 'admin\PagesController');
			Route::post('pages/list-pages', 'admin\PagesController@ListPages');
			Route::resource('services', 'admin\ServiceController');
			Route::controller('multidelete', 'admin\MultideleteController');
			Route::controller('auth', 'admin\AdminauthController');
			Route::controller('dashboard', 'admin\AdminController');
			Route::controller('password', 'admin\AdminPasswordController');
			Route::resource('template', 'admin\TemplateController');
			
			Route::resource('interest', 'admin\InterestController');
			Route::resource('settings', 'admin\SettingsController');
			Route::controller('homepage', 'admin\HomepageController');
			Route::resource('setting', 'admin\SettingsController');
			Route::resource('location', 'admin\AddresslocationController');
		
			
	});
	
	Route::controller('common', 'CommonController');
	
Route::get('reset-password/{token}', 'PasswordController@reset');
Route::post('app-password-reset', 'PasswordController@Resetpassword');

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->welcome();
});

//routes for api

$app->group(['prefix' => 'api','namespace' => 'App\Http\Controllers'], function ($app) {

	
	$app->post('social/login', 'Auth\AuthController@postSocialLogin');
	
	// property routes here
	$app->post('all-property', 'PropertyController@allproperty');
	$app->post('create-property', 'PropertyController@createProperty');
	$app->post('edit-property', 'PropertyController@editProperty');
	$app->DELETE('delete-property', 'PropertyController@deleteProperty');
	
	// Task routes here
	$app->post('todo-list', 'TaskController@todolist');
	$app->post('upload-file', 'TaskController@Uploadfile');
	$app->post('create-task', 'TaskController@taskcreate');
	$app->post('update-task', 'TaskController@taskupdate');
	$app->post('complete-task', 'TaskController@taskcomplete');
	$app->DELETE('delete-task', 'TaskController@taskdelete');
	$app->post('reschedule-task', 'TaskController@taskreschedule');
	$app->post('all-tasks', 'TaskController@alltasks');
	$app->post('this-task', 'TaskController@particulartask');
	$app->post('status-tasks', 'TaskController@taskparstatus');
	$app->post('tasks-history', 'TaskController@taskhistory');
	
	//General-Notes routes here
	$app->post('all-notes', 'NotesController@generalnotes');
	$app->post('create-note', 'NotesController@notecreate');
	$app->post('update-note', 'NotesController@noteupdate');
	$app->DELETE('delete-note', 'NotesController@notedelete');
	
	//Notification routes here
	$app->post('notification-toggle', 'NotificationController@updateNotifyType');
	$app->post('badge-reset', 'NotificationController@updatebadge');
	$app->post('all-notifications', 'NotificationController@allnotifications');
	
	$app->post('auth/login', 'Auth\AuthController@postLogin');
	$app->post('auth/logout', 'Auth\AuthController@postLogout');
	$app->get('auth/refreshtoken', 'Auth\AuthController@refreshToken');

	$app->post('forget-password', 'UserController@ForgetPassword');
	$app->get('profile-data', 'UserController@profiledata');
	$app->post('changepassword', 'UserController@changepassword');
	$app->post('changename', 'UserController@changename');
	$app->post('userimage-upload', 'UserController@uploadimage');
	
    $app->post('send-mail', 'CronejobController@cronejob');
    $app->post('user-profile', 'UserController@postUserProfile');
    $app->post('auth/register', 'Auth\RegisterController@postRegister');
    
    
    
    //Timeslot routes here
	$app->post('all-timeslots', 'TimeslotController@alltimeslot');

    });





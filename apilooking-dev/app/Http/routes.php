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
	$app->post('auth/login', 'Auth\AuthController@postLogin');
	$app->post('forget_password', 'UserController@ForgetPassword');
    $app->post('auth/register', 'Auth\RegisterController@postRegister');
    $app->post('user_profile', 'UserController@postUserProfile');
    $app->post('profile_picture', 'UserController@postProfilePicture');
    $app->post('find_members', 'UserController@getFilterValue');
    $app->post('view_profile_details', 'UserController@getUserProfileDetail');
    $app->post('update_location','UserController@postUpdateLocation');
    $app->post('save_filter_cache','UserController@postFilterCache');
    $app->post('add_favourite_screen','UserController@postAddFavouriteScreen');
    $app->post('sent_invitation','UserController@postSentInvitation');
    $app->post('add_note','UserController@postAddNote');
    $app->post('lock_unlock_details_profile','UserController@postLockUnlockProfileDeials');
    $app->post('block_user','UserController@postBlockUser');
    $app->post('profile_details1','UserController@getUserProfileDetail1');
    $app->post('add_chat_user','UserController@postAddChatUser');
});





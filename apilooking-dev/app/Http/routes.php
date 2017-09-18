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
    $app->post('add_phrases','UserController@postAddPhrases');
    $app->post('view_phrases','UserController@postViewPhrases');
    $app->post('delete_phrases','UserController@postDeletePhrases');
    $app->post('unshare_all_album_access','UserController@postUnshareAllAlbumAccess');
    $app->post('share_album','UserController@postShareAlbum');
    $app->post('add_flag','UserController@postAddFlag');
    $app->post('chat_message_push_notification','UserController@postChatMessagePushNotification');
    $app->post('declain_invitation','UserController@postDeclainInvitation');
    $app->get('terms','UserController@getTermsAndCondition');
    $app->post('add_looking_sex','UserController@postAddSexRecord');
    
});







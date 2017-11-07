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
    $app->get('terms','UserController@getTermsAndCondition');
    });

    $app->post('auth/register', 'Auth\RegisterController@postRegister');
    
    $app->group(['prefix' => 'api','namespace' => 'App\Http\Controllers','middleware' => 'jwtcustom'], function ($app) {
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
    $app->post('add_looking_sex','UserController@postAddSexRecord');
    $app->post('view_favourite_screen','UserController@postViewFavouriteScreen');
    $app->post('view_chat_users','UserController@postViewChatusers');
    $app->post('view_looking_sex','UserController@postViewLookingSex');
    $app->get('blocked_user_list','UserController@getBlockedUserList');
    $app->post('time_extend_looksex_profile','UserController@postTimeExtendLooksexProfile');
    $app->get('member_album','UserController@getMemberAlbum');
    $app->post('rename_caption_album_image','UserController@postRenameCaptionAlbumImage');
    $app->post('delete_album_picture','UserController@postDeleteAlbumPicture');
    $app->post('move_archive','UserController@postMoveArchive');
    $app->get('view_archive','UserController@getViewArchive');
    $app->post('delete_archive','UserController@postDeleteArchive');
    $app->get('view_receive_album','UserController@getViewReceiveAlbum');
    $app->post('unblock_all_users','UserController@postUnblockAllUsers');
    $app->post('add_looking_date','UserController@postAddLookingDate');
    $app->get('my_profile','UserController@getMyProfile');
    $app->get('view_looking_date','UserController@getViewLookingDate');
    $app->post('rename_profile_lookingdates','UserController@postRenameProfileLookingdates');
    $app->post('rename_profile_lookingsex','UserController@postRenameProfileLookingsex');
    $app->post('update_profilelock_count','UserController@postUpdateProfilelockCount');
    $app->post('lock_detail_profile','UserController@postLockDetailProfile');
    $app->post('move_archive_to_private','UserController@postMoveArchiveToPrivate');
    $app->post('manage_album_access','UserController@postManageAlbumAccess');
    $app->post('add_recent_image','UserController@postAddRecentImage');
    $app->post('profile_viewers_details','UserController@getProfileViewersDetails');
    $app->post('profile_viewed_details','UserController@getProfileViewedDetails');
    $app->post('use_profile_looksex','UserController@postUseProfileLooksex');
    $app->post('use_profile_lookdates','UserController@postUseProfileLookdate');
    $app->post('profile_details','UserController@postProfileDetail');
    $app->get('payment_details','UserController@getPaymentDetails');
    $app->post('payment_success','UserController@postPaymentSuccess');
    $app->post('stop_current_search','UserController@postStopCurrentSearch');
    $app->post('edit_profile','UserController@postEditProfile');
    $app->post('partner_profile','UserController@postPartnerProfile');
    $app->post('block_chat_user','UserController@postBlockChatUser');
    $app->post('change_password','UserController@postChangePassword');
    $app->post('check_is_active','UserController@postCheckIsActive');
    $app->get('setting','UserController@getSetting');
    $app->post('chat_notification','UserController@postChatNotification');
    
});





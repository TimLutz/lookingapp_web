<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/auth/register', 'Auth\RegisterController@postRegister');

Route::post('/auth/login', 'Auth\LoginController@apiLogin');
Route::post('/auth/otplogin', 'Auth\LoginController@otpVerification');
Route::post('/auth/resend-otp', 'Auth\LoginController@otpResend');
Route::get('/agrement', 'Auth\LoginController@getAgrement'); 
Route::post('/auth/forget-password', 'Auth\ForgotPasswordController@getApiForgetPassword');
Route::post('/auth/set-password', 'Auth\ResetPasswordController@apiResetPassword');
Route::get('/hear-about-us', 'Api\UserController@getHearAboutIdProof'); //general-info
Route::post('/general-info', 'Api\UserController@postGeneralInfo');
Route::get('/general-info', 'Api\UserController@getGeneralInfo');
Route::post('/quiz', 'Api\QuizController@postMadwallQuiz');
Route::get('/quiz', 'Api\QuizController@getMadwallQuiz');
Route::get('/health-quiz', 'Api\QuizController@getMadwallHealthQuiz');
Route::post('/create-quiz', 'Api\QuizController@saveQuiz');
Route::post('/health-quiz', 'Api\QuizController@postMadwallHealthQuiz');
Route::get('/submit-quiz', 'Api\QuizController@submitQuiz');
Route::get('/token', 'Api\QuizController@tokenexpire');
Route::get('/time-slots', 'Api\TimeSlotController@getTimeSlot');
Route::post('/time-slots', 'Api\TimeSlotController@setTimeSlot'); //getApprovedInfo
Route::get('/approved', 'Api\UserController@getApprovedInfo');
Route::get('/additional-timeslot', 'Api\TimeSlotController@resetTimeSlot');

Route::post('/auth/change-password', 'Auth\ResetPasswordController@apiChnagePassword');
Route::post('/edit-profile', 'Api\UserController@EditProfile');
Route::get('/get-profile', 'Api\UserController@getProfile');
Route::get('/dashboard-info', 'Api\UserController@DashboardInfo');
Route::get('/email-verification', 'Api\UserController@postEmailVerification');  // Verify Email
Route::post('/upload-documents', 'Api\UserController@uploadOtherDocuments');  // Upload Other Documents
//Route::post('/create-cms', 'Api\CmsPagesController@createCMSPage'); //code used to create cms pages through api

Route::get('/terms-conditions', 'Api\CmsPagesController@getTermsAndConditions');
Route::get('/privacy-policy', 'Api\CmsPagesController@getPrivacyPolicy');
Route::get('/about-madwall', 'Api\CmsPagesController@getAboutMadwall');

Route::post('/contact-us', 'Api\UserController@saveContactUs'); //manageNotification
Route::get('/tutorial-watch', 'Api\UserController@tutorialWatched');
Route::post('/notification', 'Api\UserController@manageNotification'); //updateMobile
Route::post('/update-phone', 'Api\UserController@updateMobile');  //updateMobileOtp
Route::post('/update-phone-resend', 'Api\UserController@updateMobileOtp');
Route::get('/faq', 'Api\FaqController@getFaq');
Route::get('/more', 'Api\CmsPagesController@getMore');
Route::post('/get-jobs', 'Api\JobController@getMannualAutomaticJobs');  // Get Automatic and Mannual Jobs
//Route::post('/get-offered-jobs', 'Api\JobController@getOfferedJobs');  // Get Offered Jobs
Route::post('/get-applied-accpeted-jobs', 'Api\JobController@getAppliedAcceptedJobs');  // Get Applied Jobs
//Route::post('/get-accpeted-jobs', 'Api\JobController@getAcceptedJobs'); // Get Accepted Jobs
Route::post('/get-job-detail', 'Api\JobController@getJobDetail');  // Get Detail of Job
Route::get('/categories-for-search', 'Api\JobController@getCategoriesForSearch');  // Get Categories for search
Route::post('/search-by-category', 'Api\JobController@postJobsByCategory');  // Search Jobs By Category
Route::post('/apply-job', 'Api\JobController@postApplyJob');  // Apply for Jobs
Route::post('/accept-job', 'Api\JobController@postAcceptJob');  // Apply for Automatic and Mannual Job
Route::post('/decline-job', 'Api\JobController@postDeclineJob');  // Decline  Job in case of offered
Route::post('/cancel-job', 'Api\JobController@postCancelJob');  // Cancel Job
Route::post('/view-new-job', 'Api\JobController@postViewNewJobs');  // View New Jobs
Route::get('/view-job-schedule', 'Api\JobController@getJobSchedule');  // View Job Schedule
Route::post('/my-earnings', 'Api\JobController@getMyEarnings');  // View Job Schedule
Route::post('/user-profile', 'Api\UserController@postUserProfile');  // update profile

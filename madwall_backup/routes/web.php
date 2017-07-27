<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@indexEmployer');


Route::get( '/terms-condtion', 'Webpage\WebPageController@termsCondtions' ); // View the Admin Profile
Route::get( '/about-us', 'Webpage\WebPageController@aboutUs' ); // View the Admin Profile
Route::get( '/privacy-policy', 'Webpage\WebPageController@privacyPolicy' ); // View the Admin Profile
Route::get( '/termscondtion', 'Webpage\WebPageController@apitermsCondtions' ); // View the Admin Profile
Route::get( '/aboutus', 'Webpage\WebPageController@apiaboutUs' ); // View the Admin Profile
Route::get( '/privacypolicy', 'Webpage\WebPageController@apiprivacyPolicy' ); //

Route::post('/auth/employe/register', 'Auth\RegisterController@postEmployeregister');
Route::post('/employer/login', 'Auth\LoginController@postEmployelogin');
Route::get('employer/logout', 'Auth\LoginController@getEmployerLogout');
Route::post('employer/forgotpassword', 'Auth\ForgotPasswordController@postEmployerForgotPassword');
Route::get('employer/reset/{code}', 'Auth\PasswordController@getReset');
Route::post('employer/reset', 'Auth\PasswordController@postReset');

Route::get('/email_verification/{code}', 'HomeController@getConfirmEmail');
Route::get('/register/verify/{confirmationCode}', [
    'uses' => 'Employer\RegistrationController@confirm'
]);
Route::get('complete-job','CronController@complateJobs');
Route::get('process-job','CronController@ProcessJob');
Route::get('automatic-job','CronController@AutomaticJob');
Auth::routes();
	
	// Employer Route Group
Route::group(['prefix' => 'employer'], function() {
	Route::get('/post_job/{id}', 'Employer\EmployerhomeController@createPost');
	// Admin Profile Routes
	Route::get( 'dashboard', 'Employer\EmployerhomeController@index');
	Route::get( 'view-profile', 'Employer\EditProfileController@index' ); // View the Admin Profile
	Route::post( 'edit-profile', 'Employer\EditProfileController@editProfile' ); // Update Admin Profile
	Route::get( 'view-change-password', 'Employer\EditProfileController@ViewChangePassword' ); // View for Change Password 
	Route::post( 'change-password', 'Employer\EditProfileController@ChangePassword' ); // Update Admin Profile
	Route::post( 'change-email', 'Employer\EditProfileController@ChangeEmail' ); // Update Admin Profile
	
	
	
	
	
	
	Route::get( 'company-profile', 'Employer\EditProfileController@ViewCompanyProfile' ); // View for Change Password 
	Route::get('post_job', 'Employer\EmployerhomeController@createPost');
	Route::post('subcategory', 'Employer\EmployerhomeController@Subcategory');
	Route::post('skills', 'Employer\EmployerhomeController@Skills');
	Route::post('savejob', 'Employer\EmployerhomeController@postSavejob');
	Route::get('jobdata', 'Employer\EmployerhomeController@getJobpost');
	Route::get('jobdetail/{id}', 'Employer\EmployerhomeController@getJobdetail');
	Route::post('deletejob', 'Employer\EmployerhomeController@postDeletejob');
	Route::get('editjob/{id}', 'Employer\EmployerhomeController@getEditjob');
	Route::post('editJob/{id}', 'Employer\EmployerhomeController@postEditjob');

	Route::post('subcategory', 'Employer\EmployerhomeController@Subcategory');
	Route::post('skills', 'Employer\EmployerhomeController@Skills');
	Route::post('rating', 'Employer\EmployerhomeController@postJobRating');
	Route::post('jobdetail/jobapplylisting', 'Employer\EmployerhomeController@postUserAppliedJob');
	Route::post('acceptreject', 'Employer\EmployerhomeController@postAcceptjob');
	Route::get('jobhistory', 'Employer\EmployerhomeController@getJobhistory');
	Route::get('about', 'Employer\EmployerhomeController@getAbout');
	Route::post('employer-jobs', 'Employer\EmployerhomeController@EmployerJobsName');
	Route::post('savejob', 'Employer\EmployerhomeController@postSavejob');
	Route::post('verfiylink', 'Employer\EmployerhomeController@postVeficationLink');
	Route::post('contact-us', 'Employer\EmployerhomeController@postContactus');
	Route::post('about-us', 'Employer\EmployerhomeController@postAboutUs');
	Route::post('history-listing', 'Employer\EmployerhomeController@jobHistoryListing');
	Route::post('job-rating', 'Employer\EmployerhomeController@postEmployerUserRating');
	Route::post('all-notification', 'Employer\EmployerhomeController@getAllNotification');
	Route::post('jobs-users', 'Employer\EmployerhomeController@postJobsUsers');
	Route::post('update-notification', 'Employer\EmployerhomeController@postUpdateNotify');
	Route::get('history-detail/{id}', 'Employer\EmployerhomeController@getJobHistoryDetail');

	
});



Route::group(['prefix' => 'admin' ,'middleware' => ['backbutton']], function() {
	
	Route::get( 'dashboard', 'HomeController@index' ); // Trigger After Login

		// Admin Profile Routes
	/*Route::get( 'view-profile', 'Admin\AdminController@index' ); // View the Admin Profile
	Route::post( 'edit-profile', 'Admin\AdminController@editProfile' ); // Update Admin Profile
	Route::get( 'view-change-password', 'Admin\AdminController@ViewChangePassword' ); // View for Change Password 
	Route::post( 'change-password', 'Admin\AdminController@ChangePassword' ); // Update Admin Profile

	// Category Routes 
	Route::get( 'list-categories', 'Admin\CategoryController@index' ); // List All Category
	Route::post( 'filter-data', 'Admin\CategoryController@filterCategories' ); // Filter Data Used by ajax
	Route::get( 'add-category', 'Admin\CategoryController@create' ); // Load View to add Category
	Route::post( 'add-category', 'Admin\CategoryController@store' ); // Add New Category
	Route::post( 'view-category', 'Admin\CategoryController@viewCategory' ); // Load View to view Category
	Route::get( 'edit-category/{cat_id}', 'Admin\CategoryController@update' ); // Load View to update Category
	Route::post( 'edit-category/{cat_id}', 'Admin\CategoryController@edit' ); // Update Category
	Route::post( 'delete/{cat_id}', 'Admin\CategoryController@destroy' ); // Delete Category
	//Route::post( 'delete-releted-subcategory/{cat_id}', 'Admin\CategoryController@deleteReletedSubcategory' ); // Delete Category
	
	Route::post( 'lock-category', 'Admin\CategoryController@changeStatus' );

	// Subcategory Routes 
	Route::get( 'list-subcategories', 'Admin\SubCategoryController@index' ); // List All Category
	Route::post( 'filter-subcategories', 'Admin\SubCategoryController@filterSubcategories' ); // Filter Data Used by ajax
	Route::get( 'add-subcategories', 'Admin\SubCategoryController@create' ); // Load View to add Category
	Route::post( 'store-subcategories', 'Admin\SubCategoryController@addSubcategories' ); // Add New Category
	Route::post( 'view-subcategories', 'Admin\SubCategoryController@viewSubcategories' ); // Load View to view Category
	Route::get( 'edit-subcategory/{subcat_id}', 'Admin\SubCategoryController@update' ); // Load View to update Category
	Route::post( 'edit-subcategory/{subcat_id}', 'Admin\SubCategoryController@editSubcategory' ); // Update Category
	Route::post( 'delete-subcategory/{subcat_id}', 'Admin\SubCategoryController@destroy' ); // Delete Category
	Route::post( 'lock-subcategories', 'Admin\SubCategoryController@changeStatus' );
	
	// Skill Routes 
	Route::get( 'list-skills', 'Admin\SkillController@index' ); // List All Skills
	Route::post( 'filter-skill', 'Admin\SkillController@filterSkills' ); // Filter Skills Used by ajax
	Route::get( 'add-skill', 'Admin\SkillController@create' ); // Load View to add Skill
	Route::post( 'add-skill', 'Admin\SkillController@store' ); // Add New Skill
	Route::post( 'view-skill', 'Admin\SkillController@viewSkill' ); // Load View to view Skill
	Route::get( 'edit-skill/{skill_id}', 'Admin\SkillController@update' ); // Load View to update Skill
	Route::post( 'edit-skill/{skill_id}', 'Admin\SkillController@edit' ); // Update Skill
	Route::post( 'delete-skill/{skill_id}', 'Admin\SkillController@destroy' ); // Delete Skill

	// Email Template Routes 
	Route::get( 'list-emails', 'Admin\EmailController@index' ); // List All Emails
	Route::post( 'filter-email', 'Admin\EmailController@filterEmails' ); // Filter Data Used by ajax
	Route::get( 'add-email', 'Admin\EmailController@create' ); // Load View to add Email
	Route::post( 'add-email', 'Admin\EmailController@store' ); // Add New Email
	Route::post( 'view-email', 'Admin\EmailController@viewEmail' ); // Load View to view Email
	Route::get( 'edit-email/{email_id}', 'Admin\EmailController@update' ); // Load View to update Email
	Route::post( 'edit-email/{email_id}', 'Admin\EmailController@edit' ); // Update Email
	Route::post( 'delete-email/{email_id}', 'Admin\EmailController@destroy' ); // Delete Email

	// Commission Routes 
	Route::get( 'list-commissions', 'Admin\CommissionController@index' ); // List All Emails
	Route::post( 'filter-commission', 'Admin\CommissionController@filterCommissions' ); // Filter Data Used by ajax
	Route::get( 'add-commission', 'Admin\CommissionController@create' ); // Load View to add Email
	Route::post( 'add-commission', 'Admin\CommissionController@store' ); // Add New Email
	Route::post( 'view-commission', 'Admin\CommissionController@viewCommission' ); // Load View to view Email
	Route::get( 'edit-commission/{commission_id}', 'Admin\CommissionController@update' ); // Load View to update Email
	Route::post( 'edit-commission/{commission_id}', 'Admin\CommissionController@edit' ); // Update Email
	Route::post( 'delete-commission/{commission_id}', 'Admin\CommissionController@destroy' ); // Delete Email
	
	// Jobseeker Routes 
	Route::get( 'list-waitingemployee', 'Admin\JobSeekerController@getWaitlistEmploye' ); // List of Waiting Jobseekers
	Route::get( 'list-approvedemployee', 'Admin\JobSeekerController@getApprovedEmploye' ); // List of Approved Jobseekers
	Route::post( 'filter-jobseekerwaitlists', 'Admin\JobSeekerController@jobSeekerWaitListing' ); // Filter Waiting Jobseekers
	Route::post( 'filter-jobseekerapproved', 'Admin\JobSeekerController@jobSeekerApprovedListing' ); // Filter Approved Jobseekers
	Route::post( 'improve-disimprove-user/{user_id}', 'Admin\JobSeekerController@improveDisimproveUser' ); // Load View to add Email
	//Route::post( 'view-time-slots', 'Admin\JobSeekerController@viewTimeSlots' ); // Timeslot View
	Route::post( 'view-approved-jobseeker', 'Admin\JobSeekerController@viewApprovedJobseeker' ); // Add New Email
	Route::get( 'assign-time-slot/{user_id}', 'Admin\JobSeekerController@assignTimeSlot' ); // Load View to view Email
	Route::post( 'save-time-slot', 'Admin\JobSeekerController@saveTimeSlot' ); // Load View to view Email
	Route::post( 'approve-waitlisting-jobseeker-data', 'Admin\JobSeekerController@approveWaitlistingJobseeker' ); // Load View to view Email
	Route::post( 'edit-approve-waitlisting-jobseeker-data', 'Admin\JobSeekerController@editApproveWaitlistingJobseekerData' ); // Load View to view Email
	Route::post( 'decline-waitlisting-jobseeker', 'Admin\JobSeekerController@declineWaitlistingJobseeker' ); // Load View to view Email
	Route::get( 'edit-approved-employee/{user_id}', 'Admin\JobSeekerController@updateApprovedJobSeeker' ); // Load View to update Email
	Route::get( 'view-detail-approved-employee/{user_id}', 'Admin\JobSeekerController@viewDetailApprovedJobseeker' ); // Load View to update Email
	Route::post( 'edit-approved-jobseeker/{user_id}', 'Admin\JobSeekerController@editApprovedJobSeeker' ); // Update Email
	Route::post( 'block-employee', 'Admin\JobSeekerController@blockUser' ); // Update Email
	//Route::get('htmltopdfview',array('as'=>'htmltopdfview','uses'=>'Admin\JobSeekerController@htmltopdfview'));
	//Route::get( 'htmltopdfview','Admin\JobSeekerController@exportPDF');
	//Route::post('exportPDF', 'Admin\JobSeekerController@exportPDF');
	Route::get('htmltopdfview/{id}', 'Admin\JobSeekerController@htmltopdfview');
	Route::get( 'select-subcategory/{cat_id}', 'Admin\JobSeekerController@selectSubcategory' );
	Route::get( 'select-skills/{subCategory_id}', 'Admin\JobSeekerController@selectSkills' );
	Route::post( 'unblock-employee', 'Admin\JobSeekerController@unBlockUser' ); // Update Email
	
	// Employer Routes 
	Route::get( 'list-employerwaitlist', 'Admin\EmployerController@getWaitlistEmployer' ); // List of Waiting Jobseekers
	Route::get( 'list-approvedemployer', 'Admin\EmployerController@getApprovedEmployer' ); // List of Approved Jobseekers
	Route::post( 'filter-employerwaitlists', 'Admin\EmployerController@employerWaitListing' ); // Filter Waiting Jobseekers
	Route::get( 'view-detail/{user_id}', 'Admin\EmployerController@viewDetailOfWaitingEmployer' ); // Filter Waiting Jobseekers
	Route::post( 'filter-approvedemployer', 'Admin\EmployerController@approvedEmployerList' ); // Filter Approved Jobseekers
	Route::post( 'approve-waiting-employer', 'Admin\EmployerController@approveWaitingEmployer' ); // Load View to view Email
	Route::post( 'decline-waiting-employer', 'Admin\EmployerController@declineWaitingEmployer' ); // Load View to view Email
	Route::get( 'edit-approved-employer/{user_id}', 'Admin\EmployerController@updateApprovedEmployer' ); // Load View to update Email
	Route::get( 'detail-approved-employer/{user_id}', 'Admin\EmployerController@detailApprovedEmployer' ); // Load View to update Email
	Route::post( 'edit-approved-employer', 'Admin\EmployerController@giveCommisssionToEmployer' ); // Update Email
	Route::post( 'block-employer', 'Admin\EmployerController@blockEmployer' ); // Update Email
	Route::post( 'unblock-employer', 'Admin\EmployerController@unBlockEmployer' ); // Update Email

	// Cms Routes 
	Route::get( 'list-cms', 'Admin\CmsController@index' ); // List All cms
	Route::post( 'filter-cms', 'Admin\CmsController@filterCms' ); // Filter cms Used by ajax
	//Route::get( 'add-cms', 'Admin\CmsController@create' ); // Load View to add cms
	//Route::post( 'add-cms', 'Admin\CmsController@store' ); // Add New cms
	Route::post( 'view-cms', 'Admin\CmsController@viewCms' ); // Load View to view cms
	Route::get( 'edit-cms/{cms_id}', 'Admin\CmsController@update' ); // Load View to update cms
	Route::post( 'edit-cms/{cms_id}', 'Admin\CmsController@edit' ); // Update cms
	Route::post( 'delete-cms/{cms_id}', 'Admin\CmsController@destroy' ); // Delete cms

	// Faq Routes 
	Route::get( 'list-faqs', 'Admin\FaqController@index' ); // List All cms
	Route::post( 'filter-faq', 'Admin\FaqController@filterFaqs' ); // Filter cms Used by ajax
	Route::get( 'add-faq', 'Admin\FaqController@create' ); // Load View to add cms
	Route::post( 'add-faq', 'Admin\FaqController@store' ); // Add New cms
	Route::post( 'view-faq', 'Admin\FaqController@viewFaq' ); // Load View to view cms
	Route::get( 'edit-faq/{faq_id}', 'Admin\FaqController@update' ); // Load View to update cms
	Route::post( 'edit-faq/{faq_id}', 'Admin\FaqController@edit' ); // Update cms
	Route::post( 'delete-faq/{faq_id}', 'Admin\FaqController@destroy' ); // Delete cms

	// General Info Routes 
	Route::get( 'list-generalinfo', 'Admin\GeneralInfoController@index' ); // List All cms
	Route::post( 'filter-generalinfo', 'Admin\GeneralInfoController@filterGeneralinfo' ); // Filter cms Used by ajax
	Route::get( 'add-generalinfo', 'Admin\GeneralInfoController@create' ); // Load View to add cms
	Route::post( 'add-generalinfo', 'Admin\GeneralInfoController@store' ); // Add New cms
	Route::post( 'view-generalinfo', 'Admin\GeneralInfoController@viewGeneralinfo' ); // Load View to view cms
	Route::get( 'edit-generalinfo/{ginfo_id}', 'Admin\GeneralInfoController@update' ); // Load View to update cms
	Route::post( 'edit-generalinfo/{ginfo_id}', 'Admin\GeneralInfoController@edit' ); // Update cms
	Route::post( 'delete-generalinfo/{ginfo_id}', 'Admin\GeneralInfoController@destroy' ); // Delete cms

	// Jobs Routes 
	Route::get( 'list-jobs', 'Admin\JobController@index' ); // List All cms
	Route::post( 'filter-jobs', 'Admin\JobController@filterJobs' ); // Filter cms Used by ajax
	Route::get( 'view-job-detail/{job_id}', 'Admin\JobController@viewJobDetail' ); // Update cms


	// Contact Us 
	Route::get( 'list-contacts', 'Admin\ContactController@index' ); // List All cms
	Route::post( 'filter-contacts', 'Admin\ContactController@filterContacts' ); // Filter cms Used by ajax
	Route::post( 'view-contact', 'Admin\ContactController@viewContact' ); // Load View to view Skill
	
	Route::post( 'change-status', 'HomeController@changeStatus' ); */

});

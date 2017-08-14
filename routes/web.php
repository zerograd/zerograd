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
//Data Seed **************************REMAIN COMMENTED IF NOT NEEDED****************************************
Route::get('/seed','SeedController@seedPostings');
Route::get('/apicheck','APIController@index');
Route::get('/map','APIController@map');


//Testing new theme
Route::get('/newtheme','HomeController@newtheme');
Route::get('/posting/{id}',array(
	'as' => 'get-posting',
	'uses' => 'PostingController@index'
)); 
Route::get('/resume-page/{id}',array(
	'as' => 'resume-page',
	'uses' => 'StudentController@profile'
));
Route::get('/contact',array(
	'as' => 'contact-us',
	'uses' => 'HomeController@contact'
));
Route::get('/resume/add',array(
	'as' => 'add-resume',
	'uses' => 'ResumeController@addResume'
));

Route::get('manage-resume',array(
	'as' => 'manage-resume',
	'uses' => 'ResumeController@manageResume'
));

Route::get('/test/template/{id}/',array(
	'as' => 'test-template',
	'uses' => 'ResumeController@testTemplate'
));



Route::post('/post-data',array(
	'as' => 'post-data',
	'uses' => 'ResumeController@postViaResumeBuilder'
));

Route::post('/delete-data',array(
	'as' => 'delete-data',
	'uses' => 'ResumeController@deleteViaResumeBuilder'
));

Route::post('/delete-builder',array(
	'as' => 'delete-builder',
	'uses' => 'ResumeController@deleteBuilderResume'
));





Route::post('update-resume',array(
	'as' => 'update-resume',
	'uses' => 'ResumeController@updateResume'
));


Route::post('update-resume-input',array(
	'as' => 'update-resume-input',
	'uses' => 'ResumeController@updateResumeViaInput'
));

Route::get('employer/myaccount','EmployerController@myAccount');

Route::get('logout','StudentController@logout');

Route::get('/employer/logout','EmployerController@logout');

Route::post('resume/delete',array(
	'as' => 'delete-resume',
	'uses' => 'ResumeController@deleteResume'
));

Route::post('resume/create',array(
	'as' => 'create-resume',
	'uses' => 'ResumeController@createResume'
));

Route::post('/seen',array(
	'as' => 'seen',
	'uses' => 'StudentController@seenJob'
));



Route::get('job-alerts',array(
	'as' => 'job-alerts',
	'uses' => 'StudentController@jobAlerts'
));

Route::post('job-alerts/create',array(
	'as' => 'job-alerts-create',
	'uses' => 'StudentController@createJobAlerts'
));

Route::post('job-alerts/update',array(
	'as' => 'job-alerts-update',
	'uses' => 'StudentController@updateJobAlerts'
));

Route::post('job-alerts/destroy',array(
	'as' => 'delete-alert',
	'uses' => 'StudentController@deleteJobAlerts'
));

Route::get('/my-account',array(
	'as' => 'my-account',
	'uses' => 'StudentController@myAccount'
));

Route::get('/dashboard',array(
	'as' => 'dashboard',
	'uses' => 'StudentController@dashboard'
));

Route::get('/browse-jobs',array(
	'as' => 'browse-jobs',
	'uses' => 'APIController@browseJobs'
));

Route::get('/browse-categories',array(
	'as' => 'browse-categories',
	'uses' => 'HomeController@browseCategories'
));

Route::post('/password-reset',array(
	'as' => 'password-reset',
	'uses' => 'HomeController@passwordReset'
));

Route::post('/newpassword',array(
	'as' => 'new-password',
	'uses' => 'HomeController@newPassword'
));


Route::post('/job-pagination',array(
	'as' => 'job-pagination',
	'uses' => 'APIController@pagination'
));

Route::get('/add-jobs',array(
	'as' => 'add-jobs',
	'uses' => 'EmployerController@addJob'
));

Route::get('/manage-jobs',array(
	'as' => 'manage-jobs',
	'uses' => 'EmployerController@manageJobs'
));



Route::post('/upload-resume',array(
	'as' => 'upload-resume',
	'uses' => 'ResumeController@uploadResume'
));

Route::get('/manage-applications/{posting?}',array(
	'as' => 'manage-applications',
	'uses' => 'EmployerController@manageApplications'
));

Route::get('/browse-resumes',array(
	'as' => 'browse-resumes',
	'uses' => 'EmployerController@browseResumes'
));

Route::post('/filter-applications',array(
	'as' => 'filter-applications',
	'uses' => 'EmployerController@filterApplications'
));


Route::get('/resources',array(
	'as' => 'resources',
	'uses' => 'HomeController@resources'
));

Route::get('/resources/{id}/{title}',array(
	'as' => 'get-resource',
	'uses' => 'HomeController@getResource'
));





Route::get('/results',function(){
	return redirect('/browse-jobs');
});

Route::post('/results',array(
	'as' => 'apicheck',
	'uses' => 'APIController@getSearch'
));
Route::post('apicheck/filter',array(
	'as' => 'api-filter',
	'uses' => 'APIController@filterAPI'
));
//Zerograd page
Route::get('/','HomeController@newtheme');
Route::get('/login','HomeController@login');
Route::get('/student-form',function(){
	return view('logins.student');
});
Route::get('/employer-form',function(){
	return view('logins.employer');
});
Route::get('/employee-form',function(){
	return view('logins.student');
});
Route::post('/search',array(
	'as' => 'submit-search',
	'uses' => 'HomeController@search'
));
Route::get('/search','HomeController@searchResults');
Route::post('/filter',array(
	'as' => 'filter-results',
	'uses' => 'HomeController@filter'
));
Route::post('/load-more',array(
	'as' => 'load-more',
	'uses' => 'HomeController@loadMore'
));
Route::get('/filter-by-category/{id}',array(
	'as' => 'filter-by-category',
	'uses' => 'HomeController@getfilterByCategory'
));
Route::get('/about','HomeController@about');




// STUDENT GROUP PREFIX
Route::group(['prefix' => 'student','middleware' => 'redirectsession'], function () {
	Route::get('/home','StudentController@home');
	Route::get('/profile/{id}',array(
		'as' => 'student-profile',
		'uses' => 'StudentController@profile'		
	));
	Route::get('/search-tool','StudentController@searchTool');


	Route::get('/resume/{id}',array(
		'as' => 'preview-resume',
		'uses' => 'StudentController@previewResume'		
	));
	Route::post('/skills-save',array(
		'as' => 'skills-save',
		'uses' => 'StudentController@saveSkills'		
	));
	Route::post('/profile-project-update',array(
		'as' => 'profile-project-update',
		'uses' => 'StudentController@updateProfileProject'		
	));
	Route::post('/profile-project-delete',array(
		'as' => 'profile-project-delete',
		'uses' => 'StudentController@deleteProfileProject'		
	));

	Route::post('/submit-summary',array(
		'as' => 'submit-summary',
		'uses' => 'StudentController@submitSummary'		
	));

	Route::post('/update-school',array(
		'as' => 'update-school',
		'uses' => 'StudentController@updateSchool'	
	));
	Route::post('/education-delete',array(
		'as' => 'education-delete',
		'uses' => 'StudentController@deleteSchool'	
	));

	Route::post('/update-work',array(
		'as' => 'update-work',
		'uses' => 'StudentController@updateWork'	
	));
	Route::post('/update-volunteer',array(
		'as' => 'update-volunteer',
		'uses' => 'StudentController@updateVolunteer'	
	));

	Route::post('/save-top-resume',array(
		'as' => 'save-top-resume',
		'uses' => 'StudentController@saveTopResume'	
	));

	Route::post('/experience-delete',array(
		'as' => 'experience-delete',
		'uses' => 'StudentController@deleteExperience'	
	));

	Route::post('/volunteer-delete',array(
		'as' => 'volunteer-delete',
		'uses' => 'StudentController@deleteVolunteer'	
	));

});
//StudentController
Route::get('/student-login','StudentController@index');
Route::post('/student-login/login','StudentController@verifyLogin');
Route::get('/student/logout','StudentController@logout');
Route::get('/student-register','StudentController@getRegister');
Route::post('/student-register/register','StudentController@postRegister');


//EmployerController
Route::get('/company/{id}',array(
	'as' => 'company-get',
	'uses' => 'EmployerController@index'		
));

Route::get('/company/{id}/edit',array(
	'as' => 'employer-profile-edit',
	'uses' => 'EmployerController@profileEdit'		
));

Route::post('/company/profile/upload',array(
	'as' => 'companyprofile-upload',
	'uses' => 'EmployerController@uploadImage'
));

Route::post('/company/profile/update',array(
	'as' => 'companyprofile-update',
	'uses' => 'EmployerController@publicProfileUpdate'
));

//PostingController


Route::post('/save-job/{id}',array(
		'as' => 'save-job',
		'uses' => 'PostingController@saveJob'	
));

Route::post('/unsave-job/{id}',array(
		'as' => 'unsave-job',
		'uses' => 'PostingController@unsaveJob'	
));

Route::post('/apply-to-job/{id}',array(
		'as' => 'apply-to-job',
		'uses' => 'PostingController@applyJob'	
));

Route::get('/download/{postingID}/{id}',array(
		'as' => 'download-cv',
		'uses' => 'EmployerController@downloadCSV'	
));

Route::post('/update-application',array(
		'as' => 'update-application',
		'uses' => 'EmployerController@updateApplication'	
));





//Student Profile public

Route::get('/profile/{id}',array(
	'as' => 'public-profile',
	'uses' => 'StudentController@publicProfile'		
));

Route::get('/profile/{id}/edit',array(
	'as' => 'public-profile-edit',
	'uses' => 'StudentController@publicProfileEdit'		
));

Route::post('/profile/upload',array(
	'as' => 'profile-upload',
	'uses' => 'StudentController@uploadImage'
));

Route::post('/profile/update',array(
	'as' => 'profile-update',
	'uses' => 'StudentController@publicProfileUpdate'
));

Route::get('/settings',array(
	'as' => 'student-settings',
	'uses' => 'StudentController@getSettings'		
));


Route::post('/update-personal-info',array(
	'as' => 'update-personal-info',
	'uses' => 'StudentController@updatePersonalInfo'
));

Route::post('/update-password',array(
	'as' => 'update-password',
	'uses' => 'StudentController@updatePassword'
));

Route::post('/student-request',array(
	'as' => 'student-request',
	'uses' => 'StudentController@sendRequest'
));

Route::post('/accept-request',array(
	'as' => 'accept-request',
	'uses' => 'StudentController@acceptRequest'
));

Route::post('/seen-notification',array(
	'as' => 'seen-notification',
	'uses' => 'StudentController@seenNotification'
));


//EmployerController 

Route::group(['prefix' => 'employer','middleware' => 'redirectsession'], function () {
	Route::get('/home','EmployerController@home');
Route::get('/create-posting','EmployerController@getCreatePosting');

Route::get('/profile/{id}','EmployerController@getProfile');


});

Route::get('/employer-confirmation',function(){
	return view('confirmations.employer-confirmation');
});
Route::get('/employer-register','EmployerController@getRegister');
Route::post('/employer-register/register','EmployerController@postRegister');
Route::post('/employer-login/login','EmployerController@verifyLogin');
Route::post('/create-posting',array(
	'as' => 'create-posting',
	'uses' => 'PostingController@createJob'		
));

Route::post('/mark-filled',array(
	'as' => 'mark-filled',
	'uses' => 'PostingController@markFilled'		
));
Route::post('/update-company-profile',array(
	'as' => 'update-company-profile',
	'uses' => 'EmployerController@postProfile'		
));

Route::post('/job/delete',array(
	'as' => 'delete-job',
	'uses' => 'PostingController@deleteJob'		
));




//ResumeController
Route::get('/resume-builder/profile/{id}',array(
	'as' => 'resume-builder',
	'uses' => 'ResumeController@resumeBuilder'		
));

Route::get('/resume-builder/preview/{id}',array(
	'as' => 'builder-preview',
	'uses' => 'ResumeController@previewResume'		
));

Route::post('/post-resume-template',array(
	'as' => 'post-resume-template',
	'uses' => 'ResumeController@postResumeTemplate'		
));
Route::post('/resume-uploaded',array(
	'as' => 'resume-uploaded',
	'uses' => 'ResumeController@resumeUploaded'		
));

Route::post('/process-resume',array(
	'as' => 'process-resume',
	'uses' => 'ResumeController@processResume'		
));


//EmailController
Route::get('/viewemail','EmailController@view');
// Route::get('/send','EmailController@send');

//HomeController function for retreiving hash
Route::get('/verify/{id}',array(
	'as' => 'verify-student',
	'uses' => 'HomeController@verifyAccount'
));


Route::group(['prefix' => 'admin','middleware' => 'redirectsession'], function () {

	Route::get('/',array(
	'as' => 'admin-index',
	'uses' => 'AdminController@index'
));

Route::post('/login',array(
	'as' => 'admin-login',
	'uses' => 'AdminController@login'
));

Route::get('/logout',array(
	'as' => 'admin-logout',
	'uses' => 'AdminController@logout'
));

Route::get('/home',array(
	'as' => 'admin-home',
	'uses' => 'AdminController@home'
));

Route::post('/users/manage',array(
	'as' => 'manage-users',
	'uses' => 'AdminController@manageUsers'
));

Route::post('/users/generate-password',array(
	'as' => 'generate-password',
	'uses' => 'AdminController@generatePassword'
));

Route::post('/users/create',array(
	'as' => 'add-new-admin-user',
	'uses' => 'AdminController@create'
));

Route::post('/users/show',array(
	'as' => 'show-admin-user',
	'uses' => 'AdminController@edit'
));

Route::post('/users/update',array(
	'as' => 'update-admin-user',
	'uses' => 'AdminController@update'
));

// Manage Applicant routes


Route::post('/applicants/manage',array(
	'as' => 'manage-applicants',
	'uses' => 'AdminController@manageApplicants'
));

Route::post('/applicants/show',array(
	'as' => 'show-applicant-user',
	'uses' => 'AdminController@editApplicant'
));

Route::post('/applicants/resetPassword',array(
	'as' => 'reset-applicant-password',
	'uses' => 'AdminController@resetPassword'
));

Route::post('/applicants/deleteApplicant',array(
	'as' => 'delete-applicant',
	'uses' => 'AdminController@deleteApplicant'
));

Route::post('/applicants/update',array(
	'as' => 'update-applicant-user',
	'uses' => 'AdminController@updateApplicant'
));

// Manage Companies

Route::post('/companies/manage',array(
	'as' => 'manage-companies',
	'uses' => 'AdminController@manageCompanies'
));

Route::post('/companies/show',array(
	'as' => 'show-company',
	'uses' => 'AdminController@editCompany'
));

Route::post('/companies/sendCompanyPassword',array(
	'as' => 'send-company-password',
	'uses' => 'AdminController@sendCompanyPassword'
));

Route::post('/companies/deleteCompany',array(
	'as' => 'delete-company',
	'uses' => 'AdminController@deleteCompany'
));

Route::post('/companies/selectedPricing',array(
	'as' => 'selected-pricing',
	'uses' => 'AdminController@selectedPricing'
));

Route::post('/companies/update',array(
	'as' => 'update-company',
	'uses' => 'AdminController@updateCompany'
));

// Route::post('/applicants/resetPassword',array(
// 	'as' => 'reset-applicant-password',
// 	'uses' => 'AdminController@resetPassword'
// ));

//Manage Resources

Route::post('/resources/manage',array(
	'as' => 'manage-resources',
	'uses' => 'AdminController@manageResources'
));

Route::post('/resources/create',array(
	'as' => 'create-resource',
	'uses' => 'AdminController@createResource'
));

Route::post('/resources/edit',array(
	'as' => 'edit-resource',
	'uses' => 'AdminController@editResource'
));

Route::post('/resources/delete',array(
	'as' => 'delete-resource',
	'uses' => 'AdminController@deleteResource'
));

Route::post('/resoureces/update',array(
	'as' => 'update-resource',
	'uses' => 'AdminController@updateResource'
));


});//End of Group

// ParseController

Route::get('/parse',array(
	'as' => 'parse',
	'uses' => 'ParseController@fetch'
));













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

Route::get('/resources/{id}',array(
	'as' => 'get-resource',
	'uses' => 'HomeController@getResource'
));







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


//CompanyController
Route::get('/company/{id}',array(
	'as' => 'company-get',
	'uses' => 'CompanyController@index'		
));

//PostingController
Route::get('/posting/{title}/{id}',array(
	'as' => 'posting-get',
	'uses' => 'PostingController@index'		
));

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
Route::post('/resume-uploaded',array(
	'as' => 'resume-uploaded',
	'uses' => 'ResumeController@resumeUploaded'		
));

Route::post('/process-resume',array(
	'as' => 'process-resume',
	'uses' => 'ResumeController@processResume'		
));


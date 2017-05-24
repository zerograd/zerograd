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


//Zerograd page
Route::get('/','HomeController@index');
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
Route::get('/about','HomeController@about');

//StudentController
Route::get('/student-login','StudentController@index');
Route::post('/student-login/login','StudentController@verifyLogin');
Route::get('/student-register','StudentController@getRegister');
Route::post('/student-register/register','StudentController@postRegister');
Route::get('/student/home','StudentController@home');
Route::get('/student/profile/{id}',array(
	'as' => 'student-profile',
	'uses' => 'StudentController@profile'		
));
Route::get('/student/search-tool','StudentController@searchTool');


Route::get('/student/resume/{id}',array(
	'as' => 'preview-resume',
	'uses' => 'StudentController@previewResume'		
));
Route::post('/student/skills-save',array(
	'as' => 'skills-save',
	'uses' => 'StudentController@saveSkills'		
));
Route::post('/student/profile-project-update',array(
	'as' => 'profile-project-update',
	'uses' => 'StudentController@updateProfileProject'		
));
Route::post('/student/profile-project-delete',array(
	'as' => 'profile-project-delete',
	'uses' => 'StudentController@deleteProfileProject'		
));

Route::post('/student/submit-summary',array(
	'as' => 'submit-summary',
	'uses' => 'StudentController@submitSummary'		
));

Route::post('/student/update-school',array(
	'as' => 'update-school',
	'uses' => 'StudentController@updateSchool'	
));
Route::post('/student/education-delete',array(
	'as' => 'education-delete',
	'uses' => 'StudentController@deleteSchool'	
));

Route::post('/student/update-work',array(
	'as' => 'update-work',
	'uses' => 'StudentController@updateWork'	
));
Route::post('/student/update-volunteer',array(
	'as' => 'update-volunteer',
	'uses' => 'StudentController@updateVolunteer'	
));

Route::post('/student/save-top-resume',array(
	'as' => 'save-top-resume',
	'uses' => 'StudentController@saveTopResume'	
));

Route::post('/student/experience-delete',array(
	'as' => 'experience-delete',
	'uses' => 'StudentController@deleteExperience'	
));

Route::post('/student/volunteer-delete',array(
	'as' => 'volunteer-delete',
	'uses' => 'StudentController@deleteVolunteer'	
));


//CompanyController
Route::get('/company/{id}',array(
	'as' => 'company-get',
	'uses' => 'CompanyController@index'		
));

//PostingController
Route::post('/posting',array(
	'as' => 'posting-get',
	'uses' => 'PostingController@index'		
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

Route::get('/employer/home','EmployerController@home');
Route::get('/employer-register','EmployerController@getRegister');
Route::get('/employer-confirmation',function(){
	return view('confirmations.employer-confirmation');
});
Route::post('/employer-register/register','EmployerController@postRegister');
Route::post('/employer-login/login','EmployerController@verifyLogin');

//ResumeController
Route::get('/resume-builder/profile/{id}',array(
	'as' => 'resume-builder',
	'uses' => 'ResumeController@resumeBuilder'		
));

Route::post('/process-resume',array(
	'as' => 'process-resume',
	'uses' => 'ResumeController@processResume'		
));


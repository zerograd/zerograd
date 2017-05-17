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
Route::get('/student/home','StudentController@home');
Route::get('/student/profile/{id}','StudentController@profile');

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
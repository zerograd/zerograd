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
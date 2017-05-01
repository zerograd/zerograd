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

//StudentController
Route::get('/student-login','StudentController@index');
Route::post('/student-login/login','StudentController@verifyLogin');
Route::get('/student/home','StudentController@home');
Route::get('/student/profile/{id}','StudentController@profile');

Route::get('/student/search-tool','StudentController@searchTool');


//CompanyController
Route::get('/company/{id}',array(
	'as' => 'company-get',
	'uses' => 'CompanyController@index'		
));

//PostingController
Route::get('/posting/{id}',array(
	'as' => 'posting-get',
	'uses' => 'PostingController@index'		
));
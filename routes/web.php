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

//StudentController
Route::get('/student-login','StudentController@index');
Route::post('/student-login/login','StudentController@verifyLogin');
Route::get('/student/home','StudentController@home');
Route::get('/student/profile/{id}','StudentController@profile');

Route::get('/student/search-tool','StudentController@searchTool');

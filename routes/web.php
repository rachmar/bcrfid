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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


Route::group([
	'prefix' => 'osa', 
	'middleware' => ['auth','checkrole'], 
	'roles' => ['OSA','Admin'] ], function () {
	Route::resource('student', 'StudentController');
});

Route::group([
	'prefix' => 'principal', 
	'middleware' => ['auth','checkrole'], 
	'roles' => ['Principal','Admin'] ], function () {
	Route::resource('announcement', 'AnnouncementController');
	Route::resource('setting', 'SettingController');

});

Route::group([
	'prefix' => 'report', 
	'middleware' => ['auth','checkrole'], 
	'roles' => ['Principal','Teacher','Admin'] ], function () {
	Route::resource('report', 'ReportController');
});



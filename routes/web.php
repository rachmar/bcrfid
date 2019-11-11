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
	'prefix' => 'admin', 
	'namespace' => 'Admin', 
	'middleware' => ['auth','checkrole'], 
	'roles' => ['Admin'] ], function () {

	Route::resource('student', 'StudentController');
	Route::resource('announcement', 'AnnouncementController');
	Route::resource('report', 'ReportController');
	Route::resource('setting', 'SettingController');

});

Route::group([
	'prefix' => 'teacher', 
	'namespace' => 'Teacher', 
	'middleware' => ['auth','checkrole'], 
	'roles' => ['Teacher'] ], function () {
	Route::resource('student', 'AttendanceController');
});

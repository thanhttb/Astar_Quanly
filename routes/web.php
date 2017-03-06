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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/general',function(){
	return view('layouts/general');
});
Route::get('/enroll',function(){
	return view('enroll/addNew');
});
Route::get('/ktdv',function(){
	return view('enroll/ktdv');
});
Route::get('/test',function(){
	return view('enroll/test');
});
Route::post('/editDateTime',['as' => 'editDateTime', 'uses' => 'EnrollController@saveDate']);
Route::post('/editTestInform',['as' => 'editTestInform', 'uses' => 'EnrollController@saveTestInform']);
Route::post('/editShowUp',['as' => 'editShowUp', 'uses' => 'EnrollController@saveShowUp']);
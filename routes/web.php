<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


//user admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'],function() {
	Route::get('/', 'AdminController@index');

	//check
	Route::post('util/check/{model}', 'UtilController@check');
	Route::post('util/batch-delete/{model}', 'UtilController@batch_delete');
});

//admin admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth','can:admin']],function() {

	//info
	Route::post('info/batch-delete', 'InfoController@batch_delete');
	//Route::post('info/check', 'InfoController@check');
	Route::resource('info', 'InfoController');

	//user
	//Route::post('user/batch-delete', 'UserController@batch_delete');
	Route::put('user/{id}/settings', 'UserController@settings');
	
	Route::resource('user', 'UserController');

	//alog
	Route::get('alog', 'AlogController@index');

	//category
	Route::resource('category', 'CategoryController');
});
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('register', 'UserController@getRegister');

Route::post('register', 'UserController@postRegister');

Route::get('login', 'UserController@getLogin');

Route::post('login', 'UserController@postLogin');

Route::get('logout', 'UserController@getLogout');

Route::get('dashboard', 'UserController@getDashboard');

Route::get('reset/{uid?}', 'UserController@getReset');

Route::post('reset', 'UserController@postReset');

Route::get('verify/{uid?}', 'UserController@verify');





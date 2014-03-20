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
	return View::make('index');
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

Route::get('page/{slug?}', 'PageController@page');

Route::get('admin', array('before' => 'admin', 'uses' => 'AdminController@dashboard'));

Route::get('admin/pages', array('before' => 'admin', 'uses' => 'PageController@pages'));

Route::filter('admin', function () {
	if (Auth::user()->role != 'admin') {
		Session::flash('message', '<div class="alert alert-danger alert-dismissable center"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h3>Ilegal operation detected!</h3></div>');
		return Redirect::to('/');
	}
});






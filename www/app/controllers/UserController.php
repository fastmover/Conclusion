<?php

	class UserController extends BaseController {

	/**
	* The layout that should be used for responses.
	*/
	protected $layout = 'layouts.master';

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('getDashboard')));
	}

	public function getRegister() {
		$this->layout->content = View::make('user.register');
	}

	public function postRegister() {

		$validator = Validator::make(Input::all(), User::$rules);

		if ($validator->passes()) {

			// validation has passed, save user in DB
			$user = new User;

			$user->username = 	Input::get('username');
			$user->email = 		Input::get('email');
			$user->password = 	Hash::make(Input::get('password'));

			$user->save();

			return Redirect::to('login')->with('message', 'Thanks for registering!');

		} else {
			// validation has failed, display error messages
			return Redirect::to('register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}

	}

	public function getLogin() {
		$this->layout->content = View::make('user.login');
	}

	public function postLogin() {
		if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
			return Redirect::to('dashboard')->with('message', 'You are now logged in!');
		} else {
			if (Auth::attempt(array('username'=>Input::get('email'), 'password'=>Input::get('password')))) {
				return Redirect::to('dashboard')->with('message', 'You are now logged in!');
			} else {
				return Redirect::to('login')
					->with('message', 'Your username/password combination was incorrect')
					->withInput();
			}
		}
	}

	public function getDashboard() {
		$this->layout->content = View::make('user.dashboard');
	}

	public function getLogout() {
		Auth::logout();
		return Redirect::to('login')->with('message', 'Your are now logged out!');
	}

}
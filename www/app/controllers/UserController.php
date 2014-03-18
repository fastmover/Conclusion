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

			$data = array('username' => $user->username);

			Mail::send('emails.auth.newpassword', $data, function($message) use ($user)
			{

				$message->to($user->email);

			});

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

	public function getReset($uid) {

		if($uid !== null) {
			return $this->getNewPassword($uid);
		}

		$this->layout->content = View::make('user.reset');
	}

	public function postReset() {

		$user = User::where('email', Input::get('email'))->first();



		if($user == null) {
			$user = User::where('username', Input::get('email'))->first();
		}

		if($user == null) {
			return Redirect::to('reset')->with('message', 'Your username/email combination was incorrect');
		}

		$reset = Reset::where('user_id', $user->id)->first();

		if($reset != null) {

			// Test if there's already been 2 resets, based on created date and updated date, if they differ, don't do this again.
			if($reset->created_at != $reset->updated_at) {

				// There has been 2 password resets already, do not allow a third.
				$message = "You're password has already been reset twice, if you're not receiving these emails, or having further issues, please contact an Administrator.";

				return Redirect::to('reset')->with('message', $message);

			} else {

				// Already sent 1 reset request without clicking link
				$message = "Password reset link sent a 2nd time.  There won't be a third.";

			}

		} else {
			$message = "A link has been sent to your email.";

			$reset = new Reset;

			$reset->user_id = $user->id;

		}

		$reset->uuid = $this->generateUUID();

		$reset->save();

		$data = array('uuid' => $reset->uuid);


		Mail::send('emails.auth.reset', $data, function($message) use ($user)
		{

			$message->to($user->email);

		});

		$this->layout->content = View::make('user.reset')->with('message', $message);
	}

	public function getNewPassword($uid = null) {

		$reset = Reset::where('uuid', $uid)->first();

		if($reset == null) {
			return Redirect::to('login')->with('message', 'This is an invalid link.');
		}

		$user = User::where('id', $reset->user_id)->first();

		$newPassword = $this->generateNewPassword();

		$user->password = Hash::make($newPassword);

		$user->save();

		$data = array('password' => $newPassword);

		Mail::send('emails.auth.newpassword', $data, function($message) use ($user)
		{

			$message->to($user->email);

		});

		$reset->delete();

		$this->layout->content = View::make('user.login')->with('message', "A new password has been sent to your E-Mail.");

	}

	private function generateUUID() {
		$uuid = uniqid('', true);

		$test = Reset::where('uuid', $uuid);

		if($test != null) {
			return $uuid;
		} else {
			return $this->generateUUID();
		}
	}

	private function generateNewPassword() {

		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return str_shuffle(implode($pass));

	}

}
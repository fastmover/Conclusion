<?php

class PageController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	protected $layout = 'layouts.master';

	public function page($slug = null);
	{
		$page = Page::where('slug', $slug);

		if($page == null) {
			$this->redirectTop();
		}

		if($page->published == 0) {
			$this->redirectTop();
		}

		$thisPage = array(
			'content' 	=> $page->content,
			'title'		=> $page->title
		);

		return View::make('hello')->with('page' => $thisPage);
	}

	public function edit($id = null) {
		if($id == null) {
			$this->redirectTop();
		}
		$page = Page::where('id', $id);

		if($page == null) {
			$this->redirectTop();
		}



	}

	private function redirectTop() {
		return Redirect::to('/');
	}

}
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

	public function pages()
	{
		$pages = Page::all();
		return View::make('pages.pages')->with('pages', $pages);
	}

	public function page($slug = null)
	{

		$page = Page::where('slug', $slug)->first();

//		var_dump($page); exit;

		if($page == null) {
			$this->redirectTop();
		}

		if($page->published == 0) {
			$this->redirectTop();
		}

		return View::make('pages.page')->with('page', $page);
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
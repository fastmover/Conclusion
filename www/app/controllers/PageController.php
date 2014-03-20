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

	public function edit($slug)
	{
		if($slug == null) {
			$this->redirectTop();
		}
		$page = Page::where('slug', $slug)->first();

		if($page == null) {
			$this->redirectTop();
		}

		return View::make('pages.edit')->with('page', $page);

	}

	public function add() {
		return View::make('pages.edit');
	}

	public function savePage()
	{

		$id = Input::get('id');
		$author = Input::get('author_id');


		if(
			($author !== '') and
			($id !== '')
		) {
			$page = Page::where('id', $id)->first();
		} else {
			$page = new Page;
			$page->author_id	= Auth::user()->id;
			$page->slug 		= $this->uniqueSlug(Str::slug($page->title));
		}

		$page->title 		= Input::get('title');
		$page->content 		= Input::get('content');
		$page->user_id		= Auth::user()->id;
		$page->published 	= 1;
		$page->save();

		return Redirect::to('/page/' . $page->slug);

	}

	private function slugInUse($slug)
	{

		$page = Page::where('slug', $slug)->first();
		if($page != null) {
			return true;
		}
		return false;

	}

	private function uniqueSlug($slug)
	{

		if($this->slugInUse($slug))
		{
			$unique = false;
			$increment = 1;
			while(!$unique) {
				if(!$this->slugInUse($slug . '-' . $increment)) {
					$slug .= '-' . $increment;
						$unique = true;
				}
				$increment++;
			}
		}
		return $slug;

	}

	private function redirectTop()
	{
		return Redirect::to('/');
	}

}
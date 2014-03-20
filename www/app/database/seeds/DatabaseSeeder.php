<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
	}

}


class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		User::create(array(
			'email' 	=> 'test@gmail.com',
			'username'	=> 'asdf',
			'password'	=> Hash::make('asdfasdf'),
			'role'		=> 'admin'
		));

		DB::table('pages')->delete();

		Page::create(array(
			'author_id' => 0,
			'user_id'	=> 0,
			'slug'		=> 'page1',
			'title'		=> 'Page 1',
			'content'	=> '<h1>This is Page 1</h1><p>Lorem Ipsum Dollar Amet.</p>',
			'published'	=> 1
		));
		Page::create(array(
			'author_id' => 0,
			'user_id'	=> 0,
			'slug'		=> 'page2',
			'title'		=> 'Page 2',
			'content'	=> '<h1>This is Page 2</h1><p>Lorem Ipsum Dollar Amet.</p>',
			'published'	=> 1
		));
	}

}
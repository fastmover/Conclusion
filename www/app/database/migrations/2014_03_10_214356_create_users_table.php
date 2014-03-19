<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        Schema::dropIfExists('users');

        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->boolean('verified');
            $table->boolean('locked');
            $table->string('role');
            $table->string('password');
            $table->dateTime('last_login');
            $table->timestamps();
        });

        Schema::dropIfExists('pages');

		Schema::dropIfExists('reset');

		Schema::dropIfExists('verify');

//        if (Schema::hasTable('users'))

		Schema::create('pages', function($table)
		{
			$table->increments('id');
			$table->integer('parent_id')->default('0');
			$table->integer('author_id')->references('id')->on('users');
			$table->integer('user_id')->references('id')->on('users');
			$table->string('slug', 255);
			$table->string('title', 255);
			$table->string('meta_keywords', 255)->nullable();
			$table->string('meta_description', 255)->nullable();
			$table->text('content')->nullable();
			$table->integer('order_id')->default('50');
			$table->string('permission')->default('public');
			$table->string('group')->default('public');
			$table->string('password')->nullable();
			$table->boolean('published')->default('0');
			$table->timestamps();
		});

		Schema::create('reset', function($table) {
			$table->increments('id');
			$table->integer('user_id')->references('id')->on('users');
			$table->string('uuid', 25);
			$table->timestamps();
		});

		Schema::create('verify', function($table) {
			$table->increments('id');
			$table->integer('user_id')->references('id')->on('users');
			$table->string('uuid', 25);
			$table->timestamps();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('users');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('reset');
		//
	}

}

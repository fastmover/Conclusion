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

        if (Schema::hasTable('users'))
        {
            Schema::create('pages', function($table)
            {
                $table->increments('id');
                $table->integer('user_id')->references('id')->on('users');
                $table->text('content');
                $table->string('permission')->default('public');
                $table->string('group')->default('public');
                $table->timestamps();
            });
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('users');
        Schema::drop('pages');
		//
	}

}

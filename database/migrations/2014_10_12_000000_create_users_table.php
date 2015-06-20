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
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
			$table->string('email')->unique();
			$table->string('password', 60);
            $table->string('activation_code')->nullable()->unique();
            $table->dateTime('activation_date')->nullable();
            $table->tinyInteger('status')->default(0)->index();
			$table->rememberToken();
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
	}

}

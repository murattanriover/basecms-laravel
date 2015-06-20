<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('user_group', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('group_id')->unsigned()->index();
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
        Schema::dropIfExists('user_group');
	}

}

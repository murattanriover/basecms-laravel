<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPerms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('group_perms', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->index();
            $table->string('controller')->nullable()->index();
            $table->string('action')->nullable()->index();
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
        Schema::dropIfExists('group_perms');
	}

}

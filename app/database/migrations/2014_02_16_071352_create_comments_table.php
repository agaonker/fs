<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('comments', function($table)
	    {
	    	$table->engine = 'InnoDB';
	    	$table->increments('id');
	    	$table->integer('user_id')->unsigned();
	    	$table->integer('message_id')->unsigned();
	        $table->foreign('user_id')->references('id')->on('users')->on_delete('cascade');
	        $table->foreign('message_id')->references('id')->on('messages')->on_delete('cascade');
    		$table->string('data', 200);
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
		Schema::drop('comments');
	}

}

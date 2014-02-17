<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('messages', function($table)
	    {
	    	$table->engine = 'InnoDB';
	    	$table->integer('user_id')->unsigned();
	    	
	        $table->increments('id');
	        $table->foreign('user_id')->references('id')->on('users')->on_delete('cascade');
	        $table->string('data', 200);
	        $table->boolean('highlight');
	        $table->integer('upvote');
			$table->integer('downvote');
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
		Schema::drop('messages');
	}

}

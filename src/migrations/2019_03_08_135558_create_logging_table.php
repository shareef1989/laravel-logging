<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoggingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logging', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('table', 100);
			$table->integer('row_id')->nullable();
			$table->text('before', 65535)->nullable();
			$table->text('after', 65535)->nullable();
			$table->integer('user_id')->nullable();
			$table->timestamps();
			$table->string('action', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('logging');
	}

}

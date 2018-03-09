<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCusineTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cusine_translations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cusine_id')->unsigned();
			$table->string('name', 191);
			$table->string('locale', 191)->index();
			$table->unique(['cusine_id','locale']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cusine_translations');
	}

}

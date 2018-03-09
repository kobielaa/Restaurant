<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpecializationTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('specialization_translations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('specialization_id')->unsigned();
			$table->string('name', 191);
			$table->string('locale', 191)->index();
			$table->unique(['specialization_id','locale']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('specialization_translations');
	}

}

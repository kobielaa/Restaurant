<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertTypeTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advert_type_translations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('advert_type_id')->unsigned();
			$table->string('name', 191);
			$table->string('locale', 191)->index();
			$table->unique(['advert_type_id','locale']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('advert_type_translations');
	}

}

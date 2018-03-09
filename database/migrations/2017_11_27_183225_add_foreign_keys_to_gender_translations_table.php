<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGenderTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gender_translations', function(Blueprint $table)
		{
			$table->foreign('gender_id')->references('id')->on('genders')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gender_translations', function(Blueprint $table)
		{
			$table->dropForeign('gender_translations_gender_id_foreign');
		});
	}

}

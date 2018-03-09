<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLanguageTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('language_translations', function(Blueprint $table)
		{
			$table->foreign('language_id')->references('id')->on('languages')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('language_translations', function(Blueprint $table)
		{
			$table->dropForeign('language_translations_language_id_foreign');
		});
	}

}

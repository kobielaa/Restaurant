<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSpecializationTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('specialization_translations', function(Blueprint $table)
		{
			$table->foreign('specialization_id')->references('id')->on('specializations')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('specialization_translations', function(Blueprint $table)
		{
			$table->dropForeign('specialization_translations_specialization_id_foreign');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAdvertTypeTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('advert_type_translations', function(Blueprint $table)
		{
			$table->foreign('advert_type_id')->references('id')->on('advert_types')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('advert_type_translations', function(Blueprint $table)
		{
			$table->dropForeign('advert_type_translations_advert_type_id_foreign');
		});
	}

}

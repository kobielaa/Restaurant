<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAdvertCategoryTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('advert_category_translations', function(Blueprint $table)
		{
			$table->foreign('advert_category_id')->references('id')->on('advert_categories')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('advert_category_translations', function(Blueprint $table)
		{
			$table->dropForeign('advert_category_translations_advert_category_id_foreign');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserTypeTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_type_translations', function(Blueprint $table)
		{
			$table->foreign('user_type_id')->references('id')->on('user_types')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_type_translations', function(Blueprint $table)
		{
			$table->dropForeign('user_type_translations_user_type_id_foreign');
		});
	}

}

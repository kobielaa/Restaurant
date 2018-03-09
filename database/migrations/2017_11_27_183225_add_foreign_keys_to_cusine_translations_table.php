<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCusineTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cusine_translations', function(Blueprint $table)
		{
			$table->foreign('cusine_id')->references('id')->on('cusines')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cusine_translations', function(Blueprint $table)
		{
			$table->dropForeign('cusine_translations_cusine_id_foreign');
		});
	}

}

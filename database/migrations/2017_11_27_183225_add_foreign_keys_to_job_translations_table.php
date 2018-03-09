<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJobTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('job_translations', function(Blueprint $table)
		{
			$table->foreign('job_id')->references('id')->on('jobs')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('job_translations', function(Blueprint $table)
		{
			$table->dropForeign('job_translations_job_id_foreign');
		});
	}

}

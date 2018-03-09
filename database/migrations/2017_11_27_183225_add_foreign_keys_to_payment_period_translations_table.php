<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaymentPeriodTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('payment_period_translations', function(Blueprint $table)
		{
			$table->foreign('payment_period_id')->references('id')->on('payment_periods')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('payment_period_translations', function(Blueprint $table)
		{
			$table->dropForeign('payment_period_translations_payment_period_id_foreign');
		});
	}

}

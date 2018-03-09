<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentPeriodTranslationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment_period_translations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('payment_period_id')->unsigned();
			$table->string('name', 191);
			$table->string('locale', 191)->index();
			$table->unique(['payment_period_id','locale']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payment_period_translations');
	}

}

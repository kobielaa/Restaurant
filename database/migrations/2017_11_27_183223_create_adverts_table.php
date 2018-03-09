<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adverts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('advert_type_id')->unsigned()->nullable();
			$table->integer('advert_category_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->date('add_date')->nullable()->default('2017-11-15');
			$table->date('validity_date')->nullable()->default('0000-00-00');
			$table->string('first_name', 191)->nullable();
			$table->string('last_name', 191)->nullable();
			$table->string('company', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('phone', 191)->nullable();
			$table->string('mobile', 191)->nullable();
			$table->string('fax', 191)->nullable();
			$table->string('website', 191)->nullable();
			$table->integer('language_id')->unsigned()->nullable();
			$table->integer('country_id')->unsigned()->nullable();
			$table->integer('city_id')->unsigned()->nullable();
			$table->string('zip', 191)->nullable();
			$table->string('street', 191)->nullable();
			$table->string('home_no', 191)->nullable();
			$table->integer('cusine_id')->unsigned()->nullable();
			$table->string('wifi', 191)->nullable();
			$table->string('smoking', 191)->nullable();
			$table->string('text', 191)->nullable();
			$table->string('promotion', 191)->nullable();
			$table->integer('discount')->nullable();
			$table->integer('payment_period_id')->unsigned()->nullable();
			$table->string('image_1', 191)->nullable();
			$table->string('image_2', 191)->nullable();
			$table->string('image_3', 191)->nullable();
			$table->string('image_4', 191)->nullable();
			$table->string('image_5', 191)->nullable();
			$table->string('image_6', 191)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('adverts');
	}

}

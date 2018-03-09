<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email', 191)->unique();
			$table->integer('language_id')->unsigned();
			$table->integer('user_type_id')->unsigned();
			$table->string('firstname', 191);
			$table->string('lastname', 191);
			$table->integer('gender_id')->unsigned();
			$table->date('birth_date');
			$table->string('phone', 191)->nullable();
			$table->string('mobile', 191);
			$table->string('fax', 191)->nullable();
			$table->string('website', 191)->nullable();
			$table->string('company', 191);
			$table->string('nip', 191);
			$table->integer('specialization_id')->unsigned()->nullable();
			$table->integer('cusine_id')->unsigned()->nullable();
			$table->integer('country_id');
			$table->integer('city_id')->nullable();
			$table->string('other_city', 191)->nullable();
			$table->string('zip', 191)->nullable();
			$table->string('street', 191);
			$table->string('home_no', 191)->nullable();
			$table->string('description', 191)->nullable();
			$table->integer('job_id')->unsigned()->nullable();
			$table->string('job_desc', 191)->nullable();
			$table->string('password', 191);
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('payment_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
        });
        
		Schema::create('payment_type_translations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('payment_type_id')->unsigned();
			$table->string('name', 191);
			$table->string('locale', 191)->index();
			$table->unique(['payment_type_id','locale']);
        });
        
        Schema::table('payment_type_translations', function(Blueprint $table)
		{
			$table->foreign('payment_type_id')->references('id')->on('payment_types')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('payment_types');
        Schema::drop('payment_type_translations');
        Schema::table('payment_type_translations', function(Blueprint $table)
		{
			$table->dropForeign('payment_type_translations_payment_type_id_foreign');
		});
	}
}

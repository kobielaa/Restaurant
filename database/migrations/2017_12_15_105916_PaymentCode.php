<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'payment_codes', 
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('code');
                $table->integer('agent_id')->unsigned()->nullable();
                $table->integer('country_id')->unsigned()->nullable();
                $table->boolean('enabled')->default(true);
                $table->date('usage_date')->nullable();
                $table->integer('payment_type_id')->unsigned();
                $table->integer('payment_period_id')->unsigned();
                $table->integer('user_id')->unsigned()->nullable();
                $table->integer('advert_id')->unsigned()->nullable();
                $table->integer('batch');
                $table->boolean('multicode')->default(false);
                $table->date('from_date')->nullable();
                $table->date('to_date')->nullable();
                $table->integer('counter')->default(0);
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payment_codes');
    }
}

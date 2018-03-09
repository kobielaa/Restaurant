<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'payment_prices', 
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('payment_type_id')->unsigned();
                $table->integer('payment_period_id')->unsigned();
                $table->decimal('price', 8, 2)->default(0);
                $table->timestamps();
                $table->softDeletes();
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
        Schema::drop('payment_prices');
    }
}

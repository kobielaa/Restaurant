<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentPeriodRemovePrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_periods', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'price'
                ]
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_periods', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->default(0);
        });
        
    }
}

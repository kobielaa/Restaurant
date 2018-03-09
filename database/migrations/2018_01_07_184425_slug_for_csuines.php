<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SlugForCsuines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cusines', function(Blueprint $table)
		{
			$table->text('slug')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cusines', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'slug'
                ]
            );
        });
    }
}

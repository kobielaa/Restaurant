<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SlugForCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('country_translations', function(Blueprint $table)
		{
			$table->text('slug')->after('name')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('country_translations', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'slug'
                ]
            );
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SlugForCountriesMain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function(Blueprint $table)
		{
			$table->text('slug')->after('continent')->nullable();
        });
        Schema::table('country_translations', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'slug'
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
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'slug'
                ]
            );
        });
        Schema::table('country_translations', function(Blueprint $table)
		{
			$table->text('slug')->after('name')->nullable();
		});
    }
}

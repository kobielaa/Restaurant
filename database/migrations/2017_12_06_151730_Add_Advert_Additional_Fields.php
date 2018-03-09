<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdvertAdditionalFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adverts', function(Blueprint $table)
		{
            $table->integer('vote_positive')->after('image_6')->nullable();
            $table->integer('vote_negative')->after('vote_positive')->nullable();
            $table->boolean('enabled')->after('vote_negative')->default(true);
            $table->boolean('show')->after('enabled')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adverts', function (Blueprint $table) {
            $table->dropColumn(
                [
                    'vote_positive', 
                    'vote_negative', 
                    'enabled', 
                    'show'
                ]
            );
        });
    }
}

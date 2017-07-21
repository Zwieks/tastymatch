<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubentertainertypeIdsToEntertainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entertainers', function (Blueprint $table) {
            $table->string('subentertainertype_ids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entertainers', function (Blueprint $table) {
            $table->dropColumn('subentertainertype_ids'); 
        });
    }
}

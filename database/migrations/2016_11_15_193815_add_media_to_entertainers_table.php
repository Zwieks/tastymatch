<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMediaToEntertainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entertainers', function (Blueprint $table) {
            $table->integer('images_id');
            $table->integer('videos_id');
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
            $table->dropColumn('images_id');
            $table->dropColumn('videos_id');
        });
    }
}

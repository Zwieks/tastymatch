<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViewsStatePublicToDetailpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detailpages', function (Blueprint $table) {
            $table->integer('views');
            $table->string('state');
            $table->integer('public');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detailpages', function (Blueprint $table) {
            $table->dropColumn('views');
            $table->dropColumn('state');
            $table->dropColumn('public');
        });
    }
}

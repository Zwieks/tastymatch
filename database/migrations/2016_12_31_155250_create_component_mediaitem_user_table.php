<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentMediaitemUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_mediaitem_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('component_mediaitem_id');
            $table->integer('detailpage_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('component_mediaitem_user');
    }
}

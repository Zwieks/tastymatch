<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntertainersUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entertainer_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('entertainer_id');
            $table->integer('entertainertype_id');
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
        Schema::drop('entertainer_user');
    }
}

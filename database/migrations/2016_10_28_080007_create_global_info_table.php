<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->string('facebook');
            $table->string('email');
            $table->string('phone');
            $table->string('adress');
            $table->string('postcode');
            $table->string('city');
            $table->string('country');
            $table->string('kvk');
            $table->string('url_nl');
            $table->string('url_en');
            $table->string('logo');
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
        Schema::dropIfExists('global_info');
    }
}

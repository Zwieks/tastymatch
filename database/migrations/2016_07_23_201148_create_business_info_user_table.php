<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessInfoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->string('tradename');
            $table->string('streetnumber');
            $table->string('zip');
            $table->string('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn('tradename');
            $table->dropColumn('streetnumber');
            $table->dropColumn('zip');
            $table->dropColumn('city');
        });
    }
}

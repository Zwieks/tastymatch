<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveAgendaInfoToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('location');
            $table->decimal('long', 10, 7);
            $table->decimal('lat', 10, 7);
            $table->dateTime('time_start')->nullable();
            $table->dateTime('time_end')->nullable();
            $table->string('keywords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('long');
            $table->dropColumn('lat');
            $table->dropColumn('time_start');
            $table->dropColumn('time_end');
            $table->dropColumn('keywords');
        });
    }
}

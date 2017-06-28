<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraEventColumnsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('facility_gas');
            $table->string('facility_water');
            $table->string('facility_elektricity');
            $table->dateTime('construct_datestart');
            $table->dateTime('construct_dateend');
            $table->dateTime('deconstruct_datestart');
            $table->dateTime('deconstruct_dateend');           
            $table->integer('amountstart');   
            $table->integer('amountend');        
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
            $table->dropColumn('facility_gas');
            $table->dropColumn('facility_water');
            $table->dropColumn('facility_elektricity');
            $table->dropColumn('construct_datestart');
            $table->dropColumn('construct_dateend');            
            $table->dropColumn('deconstruct_datestart');      
            $table->dropColumn('deconstruct_dateend');            
            $table->dropColumn('amountstart');     
            $table->dropColumn('amountend');              
        });
    }
}

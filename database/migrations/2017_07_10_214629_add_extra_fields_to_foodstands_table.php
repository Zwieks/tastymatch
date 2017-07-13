<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraFieldsToFoodstandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foodstands', function (Blueprint $table) {
            $table->integer('dimension_x');
            $table->integer('dimension_y');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foodstands', function (Blueprint $table) {
            $table->dropColumn('dimension_x');  
            $table->dropColumn('dimension_y');
        });
    }
}

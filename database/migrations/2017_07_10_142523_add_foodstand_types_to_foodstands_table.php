<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFoodstandTypesToFoodstandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('foodstands', function (Blueprint $table) {
            $table->string('foodstandtype_ids');
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
            $table->dropColumn('foodstandtype_ids');   
        });
    }
}

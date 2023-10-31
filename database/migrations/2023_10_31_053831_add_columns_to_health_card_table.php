<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToHealthCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_card', function (Blueprint $table) {
            //
            $table->string('odsp')->nullable();
            $table->string('ohip')->nullable();
            $table->string('trillium_program')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_card', function (Blueprint $table) {
            //
            $table->dropcolumn('odsp');
            $table->dropcolumn('ohip');
            $table->dropcolumn('trillium_program');
        });
    }
}

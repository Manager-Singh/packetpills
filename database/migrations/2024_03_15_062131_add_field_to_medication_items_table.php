<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToMedicationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medication_items', function (Blueprint $table) {
            //
            $table->string('status')->nullable()->default('active')->comment('active,cancelled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medication_items', function (Blueprint $table) {
            //
            $table->dropcolumn('message');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsColumnToPrescriptionRefillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescription_refills', function (Blueprint $table) {
            //
            $table->bigInteger('medication_id')->unsigned()->nullable();
            $table->string('message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescription_refills', function (Blueprint $table) {
            //
            $table->dropcolumn('medication_id');
            $table->dropcolumn('message');
        });
    }
}

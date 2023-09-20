<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCodeInPrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            //
            $table->renameColumn('prescription_id', 'prescription_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            //
            $table->renameColumn('prescription_number', 'prescription_id');
        });
    }
}

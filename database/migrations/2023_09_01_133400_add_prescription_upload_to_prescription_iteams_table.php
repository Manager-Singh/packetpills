<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrescriptionUploadToPrescriptionIteamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescription_iteams', function (Blueprint $table) {
            //
            $table->longText('prescription_upload')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescription_iteams', function (Blueprint $table) {
            //
            $table->dropcolumn('prescription_upload');
        });
    }
}

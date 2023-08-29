<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PrescriptionIteamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_iteams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('page_no');
            $table->string('prescription');
            $table->bigInteger('user_id');
            $table->bigInteger('prescripiton_id');
            $table->bigInteger('drug_id')->nullable();
            $table->integer('drug_qty_filled')->nullable();
            $table->integer('drug_qty_left')->nullable();
            $table->timestamps();
            $table->string('status')->default('active')->comment('active,inactive');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescription_iteams');
    }
}

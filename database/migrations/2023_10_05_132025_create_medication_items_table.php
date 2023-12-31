<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medication_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('prescription_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->string('drug_name')->nullable();
            $table->string('prescribing_doctor')->nullable();
            $table->integer('price')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('medication_items');
    }
}

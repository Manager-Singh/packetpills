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
            $table->bigInteger('medication_id')->unsigned()->nullable();
            $table->bigInteger('drug_id')->unsigned()->nullable();
            $table->boolean('automatic_refil')->default(0);
            $table->string('prescribing_doctor')->nullable();
            $table->integer('qty_left')->nullable();
            $table->integer('qty_filled')->nullable();
            $table->string('pharmacy')->nullable();
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

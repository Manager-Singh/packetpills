<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('brand_name')->nullable();
            $table->string('generic_name')->nullable();
            $table->string('main_therapeutic_use')->nullable();
            $table->string('strength')->nullable();
            $table->string('strength_unit')->nullable();
            $table->string('format')->nullable();
            $table->text('manufacturer')->nullable();
            $table->string('pack_size')->nullable();
            $table->string('pack_unit')->nullable();
            $table->bigInteger('din')->nullable();
          //  $table->string('presciption_required')->nullable();
            $table->bigInteger('upc')->nullable();
            $table->float('pharmacy_purchase_price', 8, 2)->nullable();
            $table->bigInteger('percent_markup')->nullable();
          //  $table->float('drug_cost', 8, 3)->nullable();
            $table->float('dispensing_fee', 8, 2)->nullable();
            $table->integer('insurance_coverage_in_percent')->nullable();
            $table->float('insurance_coverage_calculation_in_percent', 8, 2)->nullable();
            $table->integer('delivery_cost')->nullable();
            //$table->float('patient_pays', 8, 3)->nullable();
            $table->longtext('drug_indication')->nullable();
            $table->longtext('standard_dosage')->nullable();
            $table->longtext('side_effect')->nullable();
            $table->longtext('contraindications_precautions_warnings')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('preciption_types_id')->unsigned()->index();
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
        Schema::dropIfExists('drugs');
    }
}

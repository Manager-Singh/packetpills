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
            $table->string('name')->nullable();
            $table->string('available_form')->nullable();
            $table->string('manufacturer_name')->nullable();
            $table->string('generic_name')->nullable();
            // $table->string('strength')->nullable();
            $table->text('description')->nullable();
            $table->longtext('faq')->nullable();
            $table->longtext('how_to_take')->nullable();
            $table->longtext('dosage')->nullable();
            $table->longtext('side_effect')->nullable();
            $table->longtext('available_form_description')->nullable();
            $table->longtext('contraindications')->nullable();
            $table->longtext('precautions')->nullable();
            $table->longtext('warnings')->nullable();
            $table->string('status')->default('active')->comment('active,inactive');
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

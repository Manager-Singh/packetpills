<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('call')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('thanks_regards')->nullable();
            $table->string('desciption')->nullable();
            $table->string('logo_path')->nullable();
            $table->text('address')->nullable();
            $table->text('copyright_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('mark_as')->default('default')->commemnt('default,secondary');
            $table->string('address_type')->nullable();
            $table->string('status')->default('active')->commemnt('active,inactive');
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
        Schema::dropIfExists('address');
    }
}

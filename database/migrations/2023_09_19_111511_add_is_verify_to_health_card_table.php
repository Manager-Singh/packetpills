<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsVerifyToHealthCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('health_card', function (Blueprint $table) {
            //
            $table->boolean('is_verify')->nullable()->default(0)->commemnt('1:verify,0:not verfiy');
            $table->date('expiry_date')->nullable();
            $table->string('card_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('health_card', function (Blueprint $table) {
            //
            $table->dropcolumn('is_verify');
        });
    }
}

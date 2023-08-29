<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drugs', function (Blueprint $table) {
            //
            $table->longtext('strength')->nullable();
            $table->longtext('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drugs', function (Blueprint $table) {
            // 
            $table->dropColumn('strength');
            $table->dropColumn('price');
        });
    }
}

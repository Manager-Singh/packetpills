<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderNumberToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_number')->nullable();
            $table->string('order_status')->default('pending')->comment('pending, approved, cancelled, declined, processing, ready_to_pick, picked_up, in_transit, delivered');
            $table->string('payment_status')->default('pending')->comment('pending, approved');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropcolumn('order_number');
            $table->dropcolumn('order_status');
        });
    }
}

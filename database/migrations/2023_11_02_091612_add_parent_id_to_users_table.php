<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
           $table->bigInteger('parent_id')->unsigned()->nullable();
           $table->string('relationship')->nullable();
           $table->string('relationship_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropcolumn('parent_id');
            $table->dropcolumn('relationship');
            $table->dropcolumn('relationship_type');
        });
    }
}

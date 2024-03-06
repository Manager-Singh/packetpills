<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSelfColumnToUsersTable extends Migration
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
            $table->string('pronouns')->nullable();
            $table->string('custom_pronouns')->nullable();
            $table->string('gender_identity')->nullable();
            $table->text('self_described')->nullable();
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
            $table->dropcolumn('pronouns');
            $table->dropcolumn('custom_pronouns');
            $table->dropcolumn('gender_identity');
            $table->dropcolumn('self_described');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsReferredUpdatedToUsersTable extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('is_referred_updated', ['yes', 'no'])->default('no')->after('email');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_referred_updated');
        });
    }
};
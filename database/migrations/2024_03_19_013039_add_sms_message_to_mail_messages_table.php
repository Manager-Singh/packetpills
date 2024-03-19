<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSmsMessageToMailMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mail_messages', function (Blueprint $table) {
            //
            $table->text('sms_message')->nullable();
            $table->string('sms_status')->nullable()->default('active')->comment('active,inactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mail_messages', function (Blueprint $table) {
            //
            $table->dropcolumn('sms_message');
            $table->dropcolumn('sms_status');
        });
    }
}

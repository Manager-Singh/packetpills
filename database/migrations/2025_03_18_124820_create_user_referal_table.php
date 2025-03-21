<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReferalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_referal', function (Blueprint $table) {
            $table->bigIncrements('id');// Auto-increment primary key
            $table->unsignedBigInteger('user_id'); // Foreign key reference to users table
            $table->string('from_you_found')->nullable();
            $table->string('refred_by')->nullable();
            $table->text('other_message')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->unsignedBigInteger('refreal_user_id')->nullable();
            $table->string('status')->default('new');
            $table->timestamps(); // Adds created_at & updated_at

            // Foreign Key Constraint (if user_id references users table)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_referal');
    }
}

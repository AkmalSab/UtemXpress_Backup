<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('user_phone')->unique();
            $table->string('user_picture')->nullable();
            $table->string('user_nric_picture_front')->nullable();
            $table->string('user_nric_picture_back')->nullable();
            $table->string('user_status')->default('AVAILABLE');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

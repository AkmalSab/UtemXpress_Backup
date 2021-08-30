<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runner', function (Blueprint $table) {
            $table->integer('runner_id')->autoIncrement();
            $table->integer('user_id');
            $table->string('runner_license_picture_front', 255)->nullable();
            $table->string('runner_license_picture_back', 255)->nullable();
            $table->timestamps();
        });

        Schema::table('runner', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('runner');
    }
}

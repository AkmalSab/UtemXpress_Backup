<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_service', function (Blueprint $table) {
            $table->integer('order_service_id')->autoIncrement();
            $table->integer('order_id')->nullable();
            $table->integer('service_id')->nullable();
        });

        Schema::table('order_service', function (Blueprint $table) {
            $table->foreign('order_id')->references('order_id')->on('order');
            $table->foreign('service_id')->references('service_id')->on('additional_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_service');
    }
}

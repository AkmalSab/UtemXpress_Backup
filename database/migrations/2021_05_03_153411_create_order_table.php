<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->integer('order_id')->autoIncrement();
            $table->integer('vehicle_id')->nullable();
            $table->integer('id');
            $table->integer('runner_id')->nullable();
            $table->string('order_pickup_location');
            $table->string('order_dropoff_location');
            $table->string('pickup_location_latitude');
            $table->string('pickup_location_longitude');
            $table->string('dropoff_location_latitude');
            $table->string('dropoff_location_longitude');
            $table->string('receiver_name')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('user_review')->nullable();
            $table->integer('user_rating')->nullable();
            $table->integer('runner_rating')->nullable();
            $table->decimal('order_fee', 7,2);
            $table->integer('favourite')->nullable();
            $table->string('order_remarks')->nullable();
            $table->string('order_status')->default('waiting');
            $table->date('order_date');
            $table->time('order_time');
            $table->string('order_type');
        });

        Schema::table('order', function (Blueprint $table) {
            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle');
            $table->foreign('id')->references('id')->on('users');
            $table->foreign('runner_id')->references('runner_id')->on('runner');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}

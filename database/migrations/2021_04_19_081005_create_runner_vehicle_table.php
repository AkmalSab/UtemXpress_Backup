<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunnerVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runner_vehicle', function (Blueprint $table) {
            $table->integer('vehicle_id')->autoIncrement();
            $table->integer('runner_id');
            $table->string('vehicle_type', 255);
            $table->string('vehicle_picture', 255)->nullable();
            $table->string('vehicle_number_plate_picture', 255)->nullable();
            $table->string('vehicle_roadtax_picture', 255)->nullable();
            $table->timestamps();
        });

        Schema::table('runner_vehicle', function (Blueprint $table) {
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
        Schema::dropIfExists('runner_vehicle');
    }
}

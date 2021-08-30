<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_services', function (Blueprint $table) {
            $table->integer('service_id')->autoIncrement();
            $table->string('service_name');
            //$table->decimal('service_fee', 7, 2);
        });

//        Schema::table('additional_services', function (Blueprint $table) {
//            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_services');
    }
}

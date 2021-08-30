<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->primary('staff_email');
            $table->string('staff_email');
            $table->string('staff_nric')->unique();
            $table->string('staff_name');
            $table->string('staff_designation');
            $table->string('staff_faculty');
            $table->string('staff_division');
            $table->string('staff_status')->default('AVAILABLE');
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
        Schema::dropIfExists('staffs');
    }
}

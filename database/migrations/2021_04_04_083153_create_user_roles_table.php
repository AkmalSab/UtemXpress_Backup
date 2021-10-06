<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->primary(['role_id', 'user_id']);

            $table->integer('role_id');
            $table->integer('user_id');
            $table->string('staff_email')->nullable();
            $table->string('student_email')->nullable();
            $table->string('admin_email')->nullable();
            $table->timestamps();
        });

        Schema::table('user_roles', function (Blueprint $table) {

            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('student_email')->references('student_email')->on('students');
            $table->foreign('staff_email')->references('staff_email')->on('staffs');
            $table->foreign('admin_email')->references('admin_email')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}

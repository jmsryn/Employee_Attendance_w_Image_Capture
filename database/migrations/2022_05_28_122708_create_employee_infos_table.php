<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_infos', function (Blueprint $table) {
            $table->id('emp_info_id');
            $table->unsignedBigInteger('user_id')->constrained()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('emp_id')->constrained()->nullable();
            $table->foreign('emp_id')->references('emp_id')->on('employees');
            $table->unsignedBigInteger('dept_id')->constrained()->nullable();
            $table->foreign('dept_id')->references('dept_id')->on('departments');
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
        Schema::dropIfExists('employee_infos');
    }
}

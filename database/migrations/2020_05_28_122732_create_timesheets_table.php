<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id('time_sheet_id');
            $table->unsignedBigInteger('emp_id')->constrained()->nullable();
            $table->foreign('emp_id')->references('emp_id')->on('employees');
            $table->string('date');
            $table->string('time');
            $table->string('proof');
            $table->string('log_type');
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
        Schema::dropIfExists('timesheets');
    }
}

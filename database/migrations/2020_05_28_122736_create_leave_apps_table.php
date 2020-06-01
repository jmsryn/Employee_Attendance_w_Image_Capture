<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_apps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id')->constrained()->nullable();
            $table->foreign('emp_id')->references('emp_id')->on('employees');
            $table->string('leave_type');
            $table->string('type');
            $table->string('date_from');
            $table->string('date_to');
            $table->string('reason');
            $table->string('status');
            $table->string('notif_status');
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
        Schema::dropIfExists('leave_apps');
    }
}

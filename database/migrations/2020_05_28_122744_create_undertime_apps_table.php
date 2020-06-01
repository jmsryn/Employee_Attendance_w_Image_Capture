<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUndertimeAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('undertime_apps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id')->constrained()->nullable();
            $table->foreign('emp_id')->references('emp_id')->on('employees');
            $table->string('type');
            $table->string('date');
            $table->integer('hours');
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
        Schema::dropIfExists('undertime_apps');
    }
}

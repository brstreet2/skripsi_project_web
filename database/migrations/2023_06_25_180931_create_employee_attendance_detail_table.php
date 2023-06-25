<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_attendance_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendance_id')->nullable();
            $table->foreign('attendance_id')->references('id')->on('users');
            $table->date('date')->nullable();
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->integer('status')->nullable();
            $table->string('status_string')->default('');
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
        Schema::dropIfExists('employee_attendance_detail');
    }
};

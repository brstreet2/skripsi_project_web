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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('transaction_code')->default('');
            $table->string('transaction_id')->default('');
            $table->date('date')->nullable();
            $table->double('nominal')->nullable();
            $table->integer('status')->nullable();
            $table->string('status_string')->default('');
            $table->string('notes')->default('');
            $table->string('created_by')->default('');
            $table->string('updated_by')->default('');
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
        Schema::dropIfExists('transaction');
    }
};

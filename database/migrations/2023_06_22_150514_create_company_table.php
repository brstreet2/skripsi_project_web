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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('phone')->default('');
            $table->string('pic_email')->default('');
            $table->text('address')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->string('province_string')->default('');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('city_string')->default('');
            $table->unsignedBigInteger('industry')->nullable();
            $table->string('industry_string')->default('');
            $table->string('company_size')->default('');
            $table->unsignedBigInteger('pic_id')->nullable();
            $table->foreign('pic_id')->references('id')->on('users');
            $table->string('created_by')->default('');
            $table->string('updated_by')->default('');
            $table->string('deleted_by')->default('');
            $table->softDeletes();
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
        Schema::dropIfExists('company');
    }
};

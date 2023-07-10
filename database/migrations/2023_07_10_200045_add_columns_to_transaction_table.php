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
        Schema::table('transaction', function (Blueprint $table) {
            $table->string('virtual_account_bank')->default('');
            $table->string('virtual_account_number')->default('');
            $table->date('expired_date')->nullable();
            $table->datetime('paid_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction', function (Blueprint $table) {
            $table->dropColumn('virtual_account_bank');
            $table->dropColumn('virtual_account_number');
            $table->dropColumn('expired_date');
            $table->dropColumn('paid_at');
        });
    }
};

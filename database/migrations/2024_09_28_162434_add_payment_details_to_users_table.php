<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('payment_method_id')->nullable(); // Payment method ID store karne ke liye
            $table->string('transaction_id')->nullable(); // Transaction ID store karne ke liye
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['payment_method_id', 'transaction_id']);
        });
    }
};

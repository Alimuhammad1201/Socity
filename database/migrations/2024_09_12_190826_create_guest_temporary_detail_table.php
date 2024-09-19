<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guest_temporary_detail', function (Blueprint $table) {
            $table->id();
            $table->string('card_no');
            $table->integer('block_id');
            $table->integer('flat_id');
            $table->string('guest_name');
            $table->string('contact_no')->nullable();
            $table->string('email');
            $table->time('check_in_time');
            $table->time('check_out_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_temporary_detail');
    }
};

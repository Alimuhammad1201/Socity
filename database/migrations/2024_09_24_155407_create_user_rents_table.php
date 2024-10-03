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
        Schema::create('user_rents', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('block_id'); // Foreign key for blocks table
            $table->unsignedBigInteger('flat_id'); // Foreign key for flats table
            $table->text('request'); // Request details
            $table->string('owner_name'); // Owner's name
            $table->string('owner_contact'); // Owner's contact
            $table->string('nic_front')->nullable(); // Path to NIC front image
            $table->string('nic_back')->nullable(); // Path to NIC back image
            $table->string('status')->default('pending'); // Status of the request
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_rents');
    }
};

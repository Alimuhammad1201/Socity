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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->integer('community_hall_id');// Relation to Community Hall
            $table->integer('allotment_id');            // Relation to User (who booked the hall)
            $table->date('booking_date');                          // Booking date
            $table->time('start_time');                            // Start time for booking
            $table->time('end_time');                              // End time for booking
            $table->decimal('amount', 8, 2);                       // Total amount for booking
            $table->enum('status', ['pending', 'confirmed', 'cancelled']); // Booking status

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};

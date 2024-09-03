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
        Schema::create('inv_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inv_master_id');
            $table->unsignedBigInteger('Invoice_type'); // Ensure this is unsignedBigInteger
            $table->decimal('amount', 8, 2);
            $table->timestamps();

            $table->foreign('inv_master_id')->references('id')->on('inv_master')->onDelete('cascade');
            $table->foreign('Invoice_type')->references('id')->on('inv_type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_detail');
    }
};

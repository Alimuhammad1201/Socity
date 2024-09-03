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
        Schema::create('additional_invoice_detail', function (Blueprint $table) {
            $table->id();
            $table->string('addi_invoice_master_id');
            $table->string('Invoice_type'); // Ensure this is unsignedBigInteger
            $table->decimal('amount', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_invoice_detail');
    }
};

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
        Schema::create('additional_invoice_master', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->string('block_id');
            $table->string('flat_id');
            $table->string('owner_name');
            $table->string('contact_no');
            $table->string('due_date');
            $table->string('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_invoice_master');
    }
};

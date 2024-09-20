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
        Schema::create('tenancy_agreements', function (Blueprint $table) {
            $table->id();
            $table->integer('allotment_id');
            $table->date('monthly_rent');
            $table->date('agreement_start');
            $table->date('agreement_end');
            $table->date('payment_status');
            $table->string('agreement_pdf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenancy_agreements');
    }
};

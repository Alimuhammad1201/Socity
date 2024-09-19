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
        Schema::create('noc', function (Blueprint $table) {
            $table->id();
            $table->string('noc_number');
            $table->string('name');
            $table->integer('block_id');
            $table->integer('flat_id');
            $table->date('issue_date'); 
            $table->date('valid_until')->nullable(); 
            $table->string('purpose');
            $table->string('status')->default('active'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noc');
    }
};

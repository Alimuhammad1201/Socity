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
        Schema::create('flat_area', function (Blueprint $table) {
            $table->id();
            $table->string('flat_no');
            $table->string('block');
            $table->string('flat_type');
            $table->string('flat_area');
            $table->decimal('maintenance_rate', 8, 2);
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flat_area');
    }
};

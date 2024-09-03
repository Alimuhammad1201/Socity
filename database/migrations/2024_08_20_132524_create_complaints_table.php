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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('block'); 
            $table->string('flat_no');
            $table->string('owner_name');
            $table->string('owner_contact');
            $table->string('complaint_type');
            $table->text('description')->nullable();
            $table->string('status')->default('Unresolved');
            $table->string('admin_remarks')->nullable();
            $table->string('after_img')->nullable();
            $table->string('before_img')->nullable();
            $table->timestamps();

            // Foreign key constraint
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');

    }
};

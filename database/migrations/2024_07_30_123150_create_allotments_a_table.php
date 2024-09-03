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
        Schema::create('allotments_a', function (Blueprint $table) {
            $table->id();
            $table->integer('FlatNumber')->default(0); 
            $table->string('BlockNumber', 255)->default(''); 
            $table->string('OwnerName', 255)->default(''); 
            $table->string('OwnerEmail', 255)->default(''); 
            $table->string('nic', 255)->default(''); 
            $table->bigInteger('OwnerContactNumber')->default(0); 
            $table->bigInteger('OwnerAlternateContactNumber')->default(0); 
            $table->bigInteger('OwnerMemberCount')->default(0); 
            $table->string('status', 255)->default(''); 
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP')); 
            $table->timestamps();
            $table->string('password', 255); 
            $table->string('confirm_password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allotments_a');
    }
};

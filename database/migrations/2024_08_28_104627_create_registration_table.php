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
        Schema::create('registration', function (Blueprint $table) {
            $table->id();
            $table->string('block');
            $table->string('flat_no');
            $table->string('owner_name');
            $table->string('owner_contact_no');
            $table->string('type');
            $table->string('name');
            $table->string('contact_no');
            $table->string('location');
            $table->string('nic_no');
            $table->string('nic_front');
            $table->string('nic_back');
            $table->string('profile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration');
    }
};

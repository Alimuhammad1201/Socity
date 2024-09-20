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
        Schema::create('car_stickers', function (Blueprint $table) {
            $table->id();
            $table->integer('allotment_id');
            $table->string('car_number');
            $table->string('sticker_id');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->enum('status',['Active','Duplicate','Inactive'])->default('Active');
            $table->decimal('charges',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_stickers');
    }
};

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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number')->unique();   // e.g. "0601"
            $table->string('room_type');               // Standard, Deluxe, dll
            $table->integer('floor')->nullable();
            $table->integer('capacity')->default(2);
            $table->decimal('price_per_night', 10, 2)->nullable();
            $table->enum('status', ['available', 'occupied', 'maintenance'])->default('available');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

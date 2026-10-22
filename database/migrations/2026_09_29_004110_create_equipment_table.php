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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('serial_number')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->string('rental_rate')->nullable();
            $table->string('rental_unit')->nullable();
            $table->boolean('is_active')->default(true);
            $table->uuid('user_uuid');
            $table->uuid('manufacturer_model_uuid');
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};

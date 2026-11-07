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
        Schema::create('rental_equipment', function (Blueprint $table) {
            $table->id();
            $table->uuid('rental_uuid');
            $table->uuid('equipment_uuid');
            $table->integer('quantity')->default(1);
            $table->string('unit')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->default(0.00);
            $table->text('note')->nullable();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_equipment');
    }
};

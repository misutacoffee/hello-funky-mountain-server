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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('equipment_uuid')->constrained('equipment', 'uuid')->onDelete('cascade');
            $table->foreignUuid('customer_uuid')->constrained('customers', 'uuid')->onDelete('cascade');
            $table->date('rental_date');
            $table->date('return_date')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('rentals');
    }
};

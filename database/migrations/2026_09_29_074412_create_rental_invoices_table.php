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
        Schema::create('rental_invoices', function (Blueprint $table) {
            $table->id();
            $table->uuid('rental_uuid')->nullable();
            $table->string('purchase_order_number')->nullable();
            $table->date('invoice_date')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('tax', 10, 2)->nullable();
            $table->string('status')->nullable();
            $table->date('due_date')->nullable();
            $table->date('paid_date')->nullable();
            $table->foreignUuid('user_uuid')->constrained('users', 'uuid')->onDelete('cascade');
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_invoices');
    }
};

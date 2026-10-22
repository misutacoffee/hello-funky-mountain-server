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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('message')->nullable();
            $table->string('sent_date')->nullable();
            $table->string('read_date')->nullable();
            $table->string('archived_date')->nullable();
            $table->string('deleted_date')->nullable();
            $table->boolean('marked_as_read')->nullable();
            $table->uuid('sent_by_uuid');
            $table->uuid('sent_to_uuid')->nullable();
            $table->uuid('uuid')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};

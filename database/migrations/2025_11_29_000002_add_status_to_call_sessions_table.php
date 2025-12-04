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
        // Drop existing table if it exists (works on both MySQL and SQLite)
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('call_sessions');
        Schema::enableForeignKeyConstraints();
        
        // Create new table with correct structure
        Schema::create('call_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->foreignId('caller_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['voice', 'video']);
            $table->enum('status', ['ringing', 'ongoing', 'ended', 'missed', 'declined'])->default('ringing');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->integer('duration_seconds')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_sessions');
    }
};

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
        if (!Schema::hasTable('call_sessions')) {
            Schema::create('call_sessions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
                $table->foreignId('caller_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
                $table->enum('type', ['voice', 'video']);
                $table->enum('status', ['ringing', 'ongoing', 'ended', 'missed', 'declined']);
                $table->timestamp('started_at')->nullable();
                $table->timestamp('ended_at')->nullable();
                $table->integer('duration_seconds')->nullable();
                $table->timestamps();
            });
        } elseif (!Schema::hasColumn('call_sessions', 'status')) {
            // If table exists but missing status column, add it
            Schema::table('call_sessions', function (Blueprint $table) {
                $table->enum('status', ['ringing', 'ongoing', 'ended', 'missed', 'declined'])->after('type');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_sessions');
    }
};

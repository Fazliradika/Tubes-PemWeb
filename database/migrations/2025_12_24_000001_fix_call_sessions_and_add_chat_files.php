<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix call_sessions table status column
        Schema::table('call_sessions', function (Blueprint $table) {
            // Drop the old enum column via raw SQL to avoid DBAL requirement for enum modification
            // Or simpler: MODIFY column if supported. But safest is to just use string modification logic if DB supports it.
            // On SQLite/MySQL without DBAL, changing type is hard.
            // Best approach: Drop and recreate or Raw statement.
        });

        // Use raw statement to modify column type to string/varchar to support any status
        // DB::statement("ALTER TABLE call_sessions MODIFY COLUMN status VARCHAR(50) DEFAULT 'ringing'");
        // Since we want to be safe across drivers, let's try standard Schema if possible, but separate from creation.

        // Actually, easiest way given limitations: 
        // Just Use RAW SQL for MySQL which is the target environment
        \DB::statement("ALTER TABLE call_sessions MODIFY COLUMN status VARCHAR(50) NOT NULL DEFAULT 'ringing'");

        // Create chat_files table
        Schema::create('chat_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('filename');
            $table->string('mime_type');
            $table->longText('data'); // Base64 encoded content
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_files');
        // Reverting enum is complex, usually we just leave it as varchar or ignore
    }
};

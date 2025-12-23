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
        // Fix call_sessions table status column - only if table exists
        if (Schema::hasTable('call_sessions') && Schema::hasColumn('call_sessions', 'status')) {
            try {
                \DB::statement("ALTER TABLE call_sessions MODIFY COLUMN status VARCHAR(50) NOT NULL DEFAULT 'ringing'");
            } catch (\Exception $e) {
                // Column might already be varchar, ignore error
            }
        }

        // Create chat_files table only if it doesn't exist
        if (!Schema::hasTable('chat_files')) {
            Schema::create('chat_files', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('filename');
                $table->string('mime_type');
                $table->longText('data'); // Base64 encoded content
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_files');
    }
};

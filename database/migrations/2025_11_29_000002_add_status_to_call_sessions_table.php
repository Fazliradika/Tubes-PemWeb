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
        if (Schema::hasTable('call_sessions') && !Schema::hasColumn('call_sessions', 'status')) {
            Schema::table('call_sessions', function (Blueprint $table) {
                $table->enum('status', ['ringing', 'ongoing', 'ended', 'missed', 'declined'])
                    ->default('ringing')
                    ->after('type');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('call_sessions', 'status')) {
            Schema::table('call_sessions', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations - Clean up duplicate articles by slug
     */
    public function up(): void
    {
        // Get all duplicate slugs
        $duplicates = DB::table('articles')
            ->select('slug', DB::raw('MIN(id) as keep_id'))
            ->groupBy('slug')
            ->having(DB::raw('COUNT(*)'), '>', 1)
            ->get();

        foreach ($duplicates as $duplicate) {
            // Delete all duplicates except the one with the lowest ID
            DB::table('articles')
                ->where('slug', $duplicate->slug)
                ->where('id', '!=', $duplicate->keep_id)
                ->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot restore deleted duplicates
    }
};

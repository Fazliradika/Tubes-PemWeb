<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     * Update Masker Medis image with user-provided URL
     */
    public function up(): void
    {
        DB::table('products')
            ->where('slug', 'masker-medis-3-ply')
            ->update(['image' => 'https://grahamultisarana.com/data/uploads/2018/01/Devall-Masker-3ply-Premium-Earloop.png']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse
    }
};

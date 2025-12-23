<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     * Update Madu Murni image with user-provided URL
     */
    public function up(): void
    {
        DB::table('products')
            ->where('slug', 'madu-murni-500ml')
            ->update(['image' => 'https://d2qjkwm11akmwu.cloudfront.net/products/527335_25-8-2021_16-41-45-1665791116.webp']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse
    }
};

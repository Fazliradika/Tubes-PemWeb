<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $products = [
            // Curcuma Plus (Supplement for Kids)
            [
                'slug' => 'curcuma-plus',
                'image' => 'https://images.unsplash.com/photo-1625723348842-be00122e26c6?w=500&h=500&fit=crop' // Generic vitamin syrup
            ],
            // Habbatussauda Oil (Black Seed Oil)
            [
                'slug' => 'habbatussauda-oil',
                'image' => 'https://images.unsplash.com/photo-1601362779013-146313364731?w=500&h=500&fit=crop' // Generic oil bottle
            ],
            // Madu Murni
            [
                'slug' => 'madu-murni-500ml',
                'image' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=500&h=500&fit=crop' // Honey with dipper
            ],
            // Sunscreen SPF 50
            [
                'slug' => 'sunscreen-spf-50',
                'image' => 'https://images.unsplash.com/photo-1526947425960-945c6e72858f?w=500&h=500&fit=crop' // Sunscreen bottle
            ],
            // Lotion Pelembab
            [
                'slug' => 'lotion-pelembab',
                'image' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfbc8?w=500&h=500&fit=crop' // Lotion bottle
            ]
        ];

        foreach ($products as $product) {
            DB::table('products')
                ->where('slug', $product['slug'])
                ->update(['image' => $product['image']]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update product images to match their names
        $productUpdates = [
            // Vitamin & Supplements - use pill/vitamin images
            ['name' => 'Vitamin C 1000mg', 'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=500&h=500&fit=crop'],
            ['name' => 'Multivitamin Complete', 'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=500&h=500&fit=crop'],
            ['name' => 'Omega 3 Fish Oil', 'image' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=500&h=500&fit=crop'],
            ['name' => 'Vitamin D3 2000 IU', 'image' => 'https://images.unsplash.com/photo-1550572017-4814c2ea04fc?w=500&h=500&fit=crop'],

            // Medicines - use medicine/pill images
            ['name' => 'Paracetamol 500mg', 'image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=500&h=500&fit=crop'],
            ['name' => 'Obat Batuk Sirup', 'image' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=500&h=500&fit=crop'],
            ['name' => 'Antasida Tablet', 'image' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=500&h=500&fit=crop'],

            // Medical Equipment - use medical device images
            ['name' => 'Termometer Digital', 'image' => 'https://images.unsplash.com/photo-1615486511484-92e172cc4fe0?w=500&h=500&fit=crop'],
            ['name' => 'Tensimeter Digital', 'image' => 'https://images.unsplash.com/photo-1615486511484-92e172cc4fe0?w=500&h=500&fit=crop'],
            ['name' => 'Masker Medis 3 Ply (50 pcs)', 'image' => 'https://images.unsplash.com/photo-1603791440384-56cd371ee9a7?w=500&h=500&fit=crop'],
            ['name' => 'Hand Sanitizer 100ml', 'image' => 'https://images.unsplash.com/photo-1584744982491-665216d95f8b?w=500&h=500&fit=crop'],

            // Body Care - use skincare/cosmetic images
            ['name' => 'Sabun Antiseptik', 'image' => 'https://images.unsplash.com/photo-1585421514738-01798e348b17?w=500&h=500&fit=crop'],
            ['name' => 'Lotion Pelembab', 'image' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=500&h=500&fit=crop'],
            ['name' => 'Sunscreen SPF 50', 'image' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=500&h=500&fit=crop'],

            // Herbal & Traditional - use natural/herbal images
            ['name' => 'Madu Murni 500ml', 'image' => 'https://images.unsplash.com/photo-1587049352846-4a222e784210?w=500&h=500&fit=crop'],
            ['name' => 'Jahe Merah Instan', 'image' => 'https://images.unsplash.com/photo-1599894439780-33f56ce5c26a?w=500&h=500&fit=crop'],
            ['name' => 'Habbatussauda Oil', 'image' => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=500&h=500&fit=crop'],
            ['name' => 'Curcuma Plus', 'image' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=500&h=500&fit=crop'],
        ];

        foreach ($productUpdates as $update) {
            DB::table('products')
                ->where('name', 'LIKE', '%' . $update['name'] . '%')
                ->update(['image' => $update['image']]);
        }

        // Delete any products with weird names that don't match medical products
        $weirdNames = ['Cetafarin', 'Monitor Medis', 'Citrofena', 'Jaha Merah'];
        foreach ($weirdNames as $name) {
            DB::table('products')->where('name', 'LIKE', '%' . $name . '%')->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reverse image updates
    }
};

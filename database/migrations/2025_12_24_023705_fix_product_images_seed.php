<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     * Fix product images to match their names accurately
     */
    public function up(): void
    {
        $productImageUpdates = [
            // Vitamin & Suplemen
            [
                'slug' => 'vitamin-c-1000mg',
                'image' => 'https://images.unsplash.com/photo-1584017911766-d451b3d0e843?w=500&h=500&fit=crop' // Vitamin C / Orange visuals
            ],
            [
                'slug' => 'multivitamin-complete',
                'image' => 'https://images.unsplash.com/photo-1550572017-4814c2ea04fc?w=500&h=500&fit=crop' // Assorted vitamins
            ],
            [
                'slug' => 'omega-3-fish-oil',
                'image' => 'https://images.unsplash.com/photo-1551355734-754d24c03b22?w=500&h=500&fit=crop' // Fish oil capsules
            ],
            [
                'slug' => 'vitamin-d3-2000-iu',
                'image' => 'https://images.unsplash.com/photo-1626106677051-9257bec7b102?w=500&h=500&fit=crop' // Vitamin bottle
            ],

            // Obat-obatan
            [
                'slug' => 'paracetamol-500mg',
                'image' => 'https://images.unsplash.com/photo-1585805900222-79015bea2457?w=500&h=500&fit=crop' // Pills blister pack
            ],
            [
                'slug' => 'obat-batuk-sirup',
                'image' => 'https://images.unsplash.com/photo-1605256428741-2b083c0f4f9e?w=500&h=500&fit=crop' // Medicine syrup bottle
            ],
            [
                'slug' => 'antasida-tablet',
                'image' => 'https://images.unsplash.com/photo-1584362917165-526a968579e8?w=500&h=500&fit=crop' // White tablets
            ],

            // Alat Kesehatan
            [
                'slug' => 'termometer-digital',
                'image' => 'https://images.unsplash.com/photo-1584634731339-252c581abfc5?w=500&h=500&fit=crop' // Digital thermometer
            ],
            [
                'slug' => 'tensimeter-digital',
                'image' => 'https://images.unsplash.com/photo-1630651138618-f09b55502c46?w=500&h=500&fit=crop' // Blood pressure monitor
            ],
            [
                'slug' => 'masker-medis-3-ply',
                'image' => 'https://images.unsplash.com/photo-1586942593568-29361efcd571?w=500&h=500&fit=crop' // Medical mask
            ],
            [
                'slug' => 'hand-sanitizer-100ml',
                'image' => 'https://images.unsplash.com/photo-1584744982491-665216d95f8b?w=500&h=500&fit=crop' // Hand sanitizer bottle
            ],

            // Perawatan Tubuh
            [
                'slug' => 'sabun-antiseptik',
                'image' => 'https://images.unsplash.com/photo-1585421514738-01798e348b17?w=500&h=500&fit=crop' // Liquid soap
            ],
            [
                'slug' => 'lotion-pelembab',
                'image' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfbc8?w=500&h=500&fit=crop' // Lotion bottle
            ],
            [
                'slug' => 'sunscreen-spf-50',
                'image' => 'https://images.unsplash.com/photo-1557205465-f38f970d487c?w=500&h=500&fit=crop' // Sunscreen tube
            ],

            // Herbal & Tradisional
            [
                'slug' => 'madu-murni-500ml',
                'image' => 'https://images.unsplash.com/photo-1587049352846-4a222e784210?w=500&h=500&fit=crop' // Honey jar
            ],
            [
                'slug' => 'jahe-merah-instan',
                'image' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=500&h=500&fit=crop' // Ginger powder/drink
            ],
            [
                'slug' => 'habbatussauda-oil',
                'image' => 'https://images.unsplash.com/photo-1611078731056-4c3e80c88cd2?w=500&h=500&fit=crop' // Oil dropper/bottle
            ],
            [
                'slug' => 'curcuma-plus',
                'image' => 'https://images.unsplash.com/photo-1615485500704-8e99099928b3?w=500&h=500&fit=crop' // Turmeric
            ],
        ];

        foreach ($productImageUpdates as $update) {
            DB::table('products')
                ->where('slug', $update['slug'])
                ->update(['image' => $update['image']]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse image updates
    }
};

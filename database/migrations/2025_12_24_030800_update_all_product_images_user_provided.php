<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     * Update ALL product images with user-provided URLs
     */
    public function up(): void
    {
        $productImageUpdates = [
            // Vitamin & Suplemen
            [
                'slug' => 'vitamin-c-1000mg',
                'image' => 'https://blackmores-bucket.s3.ap-southeast-1.amazonaws.com/blackmores/product/images615ee9c853050.png'
            ],
            [
                'slug' => 'multivitamin-complete',
                'image' => 'https://pyfahealth.com/wp-content/uploads/2021/12/PDP-Nutrimax-Complete-Multivitamin-_-Minerals-30-tab.jpg'
            ],
            [
                'slug' => 'omega-3-fish-oil',
                'image' => 'https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/now/now01652/l/68.jpg'
            ],
            [
                'slug' => 'vitamin-d3-2000-iu',
                'image' => 'https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/now/now00367/l/57.jpg'
            ],

            // Obat-obatan
            [
                'slug' => 'paracetamol-500mg',
                'image' => 'https://www.mandjur.co.id/cdn/shop/files/ParacetamolNewVECTORSHOPEMALL_512x512.png?v=1735963229'
            ],
            [
                'slug' => 'obat-batuk-sirup',
                'image' => 'https://res.cloudinary.com/dk0z4ums3/image/upload/v1745806354/attached_image/obat-batuk-dewasa-paling-ampuh-3-alodokter.jpg'
            ],
            [
                'slug' => 'antasida-tablet',
                'image' => 'https://res.cloudinary.com/dk0z4ums3/image/upload/v1710426204/attached_image/antasida-doen.jpg'
            ],

            // Alat Kesehatan
            [
                'slug' => 'termometer-digital',
                'image' => 'https://img.lazcdn.com/g/p/437966cabc63ea467a1bb1e8189eb11c.jpg_720x720q80.jpg'
            ],
            [
                'slug' => 'tensimeter-digital',
                'image' => 'https://img.lazcdn.com/g/p/8beccddc20fb2bd0951275b7f1e55f01.jpg_720x720q80.jpg'
            ],
            [
                'slug' => 'masker-medis-3-ply',
                'image' => 'https://grahamultisarana.com/data/uploads/2018/01/Devall-Masker-3ply-Premium-Earloop.png'
            ],
            [
                'slug' => 'hand-sanitizer-100ml',
                'image' => 'https://down-id.img.susercontent.com/file/1a10241ce7c0cc6d18e7c0f3a51f438f'
            ],

            // Perawatan Tubuh
            [
                'slug' => 'sabun-antiseptik',
                'image' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/catalog-image/MTA-14088830/dettol_dettol_antiseptic_liquid_245_ml_-_sabun_full01_fv7wtiij.jpg'
            ],
            [
                'slug' => 'lotion-pelembab',
                'image' => 'https://images.soco.id/57c995c2-4743-452c-b86b-d5f04f3fd903-.jpg'
            ],
            [
                'slug' => 'sunscreen-spf-50',
                'image' => 'https://s3-ap-southeast-1.amazonaws.com/img-sociolla/img/p/2/6/0/9/9/26099-large_default.jpg'
            ],

            // Herbal & Tradisional
            [
                'slug' => 'jahe-merah-instan',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuGqIkfP5w6RQDZttbwfb-waHU5G8WD3QbMw&s'
            ],
            [
                'slug' => 'habbatussauda-oil',
                'image' => 'https://res.cloudinary.com/dk0z4ums3/image/upload/v1759710631/attached_image/blackmores-ultra-refined-habbatussauda-oil.jpg'
            ],
            [
                'slug' => 'curcuma-plus',
                'image' => 'https://curcumaplus.co.id/files/media/2024/06/product-appetite.png'
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

<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            [
                'name' => 'Vitamin & Suplemen',
                'slug' => 'vitamin-suplemen',
                'description' => 'Vitamin dan suplemen untuk kesehatan tubuh',
            ],
            [
                'name' => 'Obat-obatan',
                'slug' => 'obat-obatan',
                'description' => 'Obat-obatan untuk berbagai penyakit',
            ],
            [
                'name' => 'Alat Kesehatan',
                'slug' => 'alat-kesehatan',
                'description' => 'Alat kesehatan dan medis',
            ],
            [
                'name' => 'Perawatan Tubuh',
                'slug' => 'perawatan-tubuh',
                'description' => 'Produk perawatan tubuh dan kecantikan',
            ],
            [
                'name' => 'Herbal & Tradisional',
                'slug' => 'herbal-tradisional',
                'description' => 'Obat herbal dan tradisional',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Products
        $products = [
            // Vitamin & Suplemen
            [
                'category_id' => 1,
                'name' => 'Vitamin C 1000mg',
                'slug' => 'vitamin-c-1000mg',
                'description' => 'Vitamin C dosis tinggi untuk meningkatkan daya tahan tubuh dan mencegah sariawan. Mengandung 1000mg vitamin C per tablet.',
                'price' => 85000,
                'stock' => 100,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Multivitamin Complete',
                'slug' => 'multivitamin-complete',
                'description' => 'Multivitamin lengkap dengan berbagai mineral untuk kesehatan tubuh secara menyeluruh. Cocok untuk aktivitas harian.',
                'price' => 120000,
                'stock' => 75,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Omega 3 Fish Oil',
                'slug' => 'omega-3-fish-oil',
                'description' => 'Suplemen omega 3 dari minyak ikan untuk kesehatan jantung dan otak. Mengandung EPA dan DHA.',
                'price' => 150000,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Vitamin D3 2000 IU',
                'slug' => 'vitamin-d3-2000-iu',
                'description' => 'Vitamin D3 untuk kesehatan tulang dan sistem imun. Penting untuk penyerapan kalsium.',
                'price' => 95000,
                'stock' => 60,
                'is_active' => true,
            ],

            // Obat-obatan
            [
                'category_id' => 2,
                'name' => 'Paracetamol 500mg',
                'slug' => 'paracetamol-500mg',
                'description' => 'Obat penurun panas dan pereda nyeri. Efektif untuk demam, sakit kepala, dan sakit gigi.',
                'price' => 15000,
                'stock' => 200,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Obat Batuk Sirup',
                'slug' => 'obat-batuk-sirup',
                'description' => 'Sirup obat batuk untuk meredakan batuk berdahak dan tidak berdahak. Rasa jeruk yang enak.',
                'price' => 35000,
                'stock' => 80,
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Antasida Tablet',
                'slug' => 'antasida-tablet',
                'description' => 'Obat untuk meredakan sakit maag, kembung, dan gangguan pencernaan lainnya.',
                'price' => 25000,
                'stock' => 100,
                'is_active' => true,
            ],

            // Alat Kesehatan
            [
                'category_id' => 3,
                'name' => 'Termometer Digital',
                'slug' => 'termometer-digital',
                'description' => 'Termometer digital dengan hasil akurat dalam 10 detik. Dilengkapi dengan alarm dan memori.',
                'price' => 75000,
                'stock' => 40,
                'is_active' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Tensimeter Digital',
                'slug' => 'tensimeter-digital',
                'description' => 'Alat pengukur tekanan darah digital otomatis. Mudah digunakan di rumah.',
                'price' => 250000,
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Masker Medis 3 Ply (50 pcs)',
                'slug' => 'masker-medis-3-ply',
                'description' => 'Masker medis 3 lapis untuk perlindungan dari kuman dan virus. Isi 50 pcs per box.',
                'price' => 45000,
                'stock' => 150,
                'is_active' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Hand Sanitizer 100ml',
                'slug' => 'hand-sanitizer-100ml',
                'description' => 'Pembersih tangan berbasis alkohol 70% untuk membunuh kuman dan bakteri.',
                'price' => 20000,
                'stock' => 200,
                'is_active' => true,
            ],

            // Perawatan Tubuh
            [
                'category_id' => 4,
                'name' => 'Sabun Antiseptik',
                'slug' => 'sabun-antiseptik',
                'description' => 'Sabun antiseptik untuk membunuh kuman dan bakteri. Melindungi kulit dari infeksi.',
                'price' => 30000,
                'stock' => 120,
                'is_active' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Lotion Pelembab',
                'slug' => 'lotion-pelembab',
                'description' => 'Lotion pelembab untuk kulit kering dan sensitif. Mengandung vitamin E dan aloe vera.',
                'price' => 55000,
                'stock' => 80,
                'is_active' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Sunscreen SPF 50',
                'slug' => 'sunscreen-spf-50',
                'description' => 'Tabir surya dengan SPF 50 untuk melindungi kulit dari sinar UV. Cocok untuk kulit sensitif.',
                'price' => 85000,
                'stock' => 60,
                'is_active' => true,
            ],

            // Herbal & Tradisional
            [
                'category_id' => 5,
                'name' => 'Madu Murni 500ml',
                'slug' => 'madu-murni-500ml',
                'description' => 'Madu murni 100% tanpa campuran. Baik untuk kesehatan dan daya tahan tubuh.',
                'price' => 75000,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Jahe Merah Instan',
                'slug' => 'jahe-merah-instan',
                'description' => 'Minuman jahe merah instan untuk menghangatkan tubuh dan meningkatkan stamina.',
                'price' => 35000,
                'stock' => 90,
                'is_active' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Habbatussauda Oil',
                'slug' => 'habbatussauda-oil',
                'description' => 'Minyak habbatussauda untuk meningkatkan daya tahan tubuh dan kesehatan.',
                'price' => 65000,
                'stock' => 70,
                'is_active' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Curcuma Plus',
                'slug' => 'curcuma-plus',
                'description' => 'Suplemen ekstrak kunyit untuk kesehatan liver dan pencernaan.',
                'price' => 45000,
                'stock' => 85,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

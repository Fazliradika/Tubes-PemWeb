<?php
// Script to update products with unique image URLs
// Run this on Railway after deployment

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$products = [
    'vitamin-c-1000mg' => 'https://images.unsplash.com/photo-1550572017-4814c2ea04fc?w=400&h=400&fit=crop',
    'multivitamin-complete' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400&h=400&fit=crop',
    'omega-3-fish-oil' => 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?w=400&h=400&fit=crop',
    'vitamin-d3-2000-iu' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=400&h=400&fit=crop',
    'paracetamol-500mg' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&h=400&fit=crop',
    'obat-batuk-sirup' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400&h=400&fit=crop',
    'antasida-tablet' => 'https://images.unsplash.com/photo-1585435557343-3b092031a831?w=400&h=400&fit=crop',
    'termometer-digital' => 'https://images.unsplash.com/photo-1584515933487-779824d29309?w=400&h=400&fit=crop',
    'tensimeter-digital' => 'https://images.unsplash.com/photo-1615486511484-92e172cc4fe0?w=400&h=400&fit=crop',
    'masker-medis-3-ply' => 'https://images.unsplash.com/photo-1603791440384-56cd371ee9a7?w=400&h=400&fit=crop',
    'hand-sanitizer-100ml' => 'https://images.unsplash.com/photo-1584744982491-665216d95f8b?w=400&h=400&fit=crop',
    'sabun-antiseptik' => 'https://images.unsplash.com/photo-1585421514738-01798e348b17?w=400&h=400&fit=crop',
    'lotion-pelembab' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=400&h=400&fit=crop',
    'sunscreen-spf-50' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=400&h=400&fit=crop',
    'madu-murni-500ml' => 'https://images.unsplash.com/photo-1587049352846-4a222e784210?w=400&h=400&fit=crop',
    'jahe-merah-instan' => 'https://images.unsplash.com/photo-1599894439780-33f56ce5c26a?w=400&h=400&fit=crop',
    'habbatussauda-oil' => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=400&h=400&fit=crop',
    'curcuma-plus' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=400&h=400&fit=crop',
];

$updated = 0;
foreach ($products as $slug => $imageUrl) {
    $product = Product::where('slug', $slug)->first();
    if ($product) {
        $product->image = $imageUrl;
        $product->save();
        echo "Updated: {$product->name}\n";
        $updated++;
    }
}

echo "\nTotal products updated: {$updated}\n";

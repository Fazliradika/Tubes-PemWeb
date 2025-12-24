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
            'Curcuma Plus' => 'https://curcumaplus.co.id/files/media/2024/06/product-appetite.png',
            'Habbatussauda Oil' => 'https://res.cloudinary.com/dk0z4ums3/image/upload/v1759710631/attached_image/blackmores-ultra-refined-habbatussauda-oil.jpg',
            'Jahe Merah Instan' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuGqIkfP5w6RQDZttbwfb-waHU5G8WD3QbMw&s',
            'Sunscreen SPF 50' => 'https://s3-ap-southeast-1.amazonaws.com/img-sociolla/img/p/2/6/0/9/9/26099-large_default.jpg',
            'Lotion Pelembab' => 'https://images.soco.id/57c995c2-4743-452c-b86b-d5f04f3fd903-.jpg',
            'Sabun Antiseptik' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/catalog-image/MTA-14088830/dettol_dettol_antiseptic_liquid_245_ml_-_sabun_full01_fv7wtiij.jpg',
            'Hand Sanitizer 100ml' => 'https://down-id.img.susercontent.com/file/1a10241ce7c0cc6d18e7c0f3a51f438f',
            'Vitamin C 1000mg' => 'https://blackmores-bucket.s3.ap-southeast-1.amazonaws.com/blackmores/product/images615ee9c853050.png',
            'Tensimeter Digital' => 'https://img.lazcdn.com/g/p/8beccddc20fb2bd0951275b7f1e55f01.jpg_720x720q80.jpg',
            'Termometer Digital' => 'https://img.lazcdn.com/g/p/437966cabc63ea467a1bb1e8189eb11c.jpg_720x720q80.jpg',
            'Antasida' => 'https://res.cloudinary.com/dk0z4ums3/image/upload/v1710426204/attached_image/antasida-doen.jpg',
            'Obat Batuk Sirup' => 'https://res.cloudinary.com/dk0z4ums3/image/upload/v1745806354/attached_image/obat-batuk-dewasa-paling-ampuh-3-alodokter.jpg',
            'Paracetamol 500mg' => 'https://www.mandjur.co.id/cdn/shop/files/ParacetamolNewVECTORSHOPEMALL_512x512.png?v=1735963229',
            'Vitamin D3' => 'https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/now/now00367/l/57.jpg',
            'Omega 3 Fish Oil' => 'https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/now/now01652/l/68.jpg',
            'Multivitamin' => 'https://pyfahealth.com/wp-content/uploads/2021/12/PDP-Nutrimax-Complete-Multivitamin-_-Minerals-30-tab.jpg',
        ];

        foreach ($products as $name => $imageUrl) {
            DB::table('products')
                ->where('name', 'LIKE', '%' . $name . '%')
                ->update(['image' => $imageUrl]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse - images can stay
    }
};

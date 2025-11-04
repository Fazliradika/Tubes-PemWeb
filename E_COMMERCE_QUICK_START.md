# 🚀 Quick Start Guide - E-Commerce System

## Langkah-langkah Setup

### 1. Jalankan Migrasi Database
Buka terminal dan jalankan:
```bash
php artisan migrate
```

### 2. Jalankan Seeder untuk Data Dummy
```bash
php artisan db:seed
```

Atau jika hanya ingin menjalankan ProductSeeder:
```bash
php artisan db:seed --class=ProductSeeder
```

### 3. Setup Storage Link (untuk upload gambar)
```bash
php artisan storage:link
```

### 4. Jalankan Server
```bash
php artisan serve
```

Aplikasi akan berjalan di: http://localhost:8000

## 📍 URL Penting

### Untuk Customer:
- **Katalog Produk**: http://localhost:8000/shop/products
- **Keranjang Belanja**: http://localhost:8000/shop/cart
- **Riwayat Pesanan**: http://localhost:8000/orders

### Untuk Admin:
- **Dashboard Admin**: http://localhost:8000/admin/dashboard
- **Manajemen Pesanan**: http://localhost:8000/admin/orders

## 👤 Akun Default

Setelah menjalankan seeder, akun berikut akan tersedia:

### Admin
- Email: admin@healthcare.com
- Password: password123

### Doctor
- Email: doctor@healthcare.com
- Password: password123

### Patient
- Email: patient@healthcare.com
- Password: password123

## 🧪 Testing Flow

### Test sebagai Customer:

1. **Register/Login** sebagai patient atau buat akun baru
2. **Browse Products**: Kunjungi `/shop/products`
3. **Add to Cart**: Tambahkan beberapa produk ke keranjang
4. **View Cart**: Lihat keranjang di `/shop/cart`
5. **Checkout**: Klik "Lanjut ke Pembayaran"
6. **Fill Shipping Info**: Isi alamat pengiriman
7. **Select Payment Method**: Pilih metode pembayaran
8. **Place Order**: Klik "Proses Pembayaran"
9. **Confirm Payment**: Klik tombol simulasi pembayaran
10. **View Order**: Lihat detail pesanan di "Pesanan Saya"

### Test sebagai Admin:

1. **Login** sebagai admin
2. **View Orders**: Kunjungi `/admin/orders`
3. **Update Status**: Ubah status pesanan melalui dropdown
4. **Filter Orders**: Filter pesanan berdasarkan status

## 🎨 Kustomisasi

### Menambah Produk Manual via Tinker:
```bash
php artisan tinker
```

Kemudian jalankan:
```php
$category = \App\Models\Category::first();

\App\Models\Product::create([
    'category_id' => $category->id,
    'name' => 'Nama Produk',
    'slug' => 'nama-produk',
    'description' => 'Deskripsi produk...',
    'price' => 100000,
    'stock' => 50,
    'is_active' => true,
]);
```

### Upload Gambar Produk:
1. Simpan gambar di folder: `storage/app/public/`
2. Update produk dengan nama file gambar
3. Gambar akan otomatis accessible via Storage link

## 🔧 Troubleshooting

### Error: SQLSTATE Connection Refused
- Pastikan MySQL/MariaDB sudah running
- Check file `.env` untuk DB credentials

### Error: Class 'Product' not found
- Jalankan: `composer dump-autoload`

### Error: Storage link tidak bekerja
- Jalankan: `php artisan storage:link`
- Pastikan folder `storage/app/public` ada

### Cart tidak tersimpan setelah login
- Ini normal, cart untuk guest dan user terpisah
- Setelah login, cart akan fresh

## 📦 Struktur File Penting

```
app/
├── Http/Controllers/
│   ├── ProductController.php      # Katalog produk
│   ├── CartController.php         # Shopping cart
│   ├── CheckoutController.php     # Checkout & payment
│   └── OrderController.php        # Order management
├── Models/
│   ├── Product.php
│   ├── Category.php
│   ├── Cart.php
│   ├── CartItem.php
│   ├── Order.php
│   ├── OrderItem.php
│   └── Payment.php
database/
├── migrations/
│   ├── xxxx_create_categories_table.php
│   ├── xxxx_create_products_table.php
│   ├── xxxx_create_carts_table.php
│   ├── xxxx_create_cart_items_table.php
│   ├── xxxx_create_orders_table.php
│   ├── xxxx_create_order_items_table.php
│   └── xxxx_create_payments_table.php
└── seeders/
    └── ProductSeeder.php           # Data dummy produk
resources/views/
├── shop/
│   ├── index.blade.php            # List produk
│   ├── show.blade.php             # Detail produk
│   ├── cart.blade.php             # Keranjang
│   ├── checkout.blade.php         # Checkout
│   ├── success.blade.php          # Success page
│   └── orders/
│       ├── index.blade.php        # Riwayat pesanan
│       └── show.blade.php         # Detail pesanan
└── admin/orders/
    └── index.blade.php            # Admin order management
```

## ✅ Checklist Feature

- [x] Katalog Produk (List & Detail)
- [x] Shopping Cart (Add, Update, Remove, Clear)
- [x] Checkout Process
- [x] Order Management (User & Admin)
- [x] Payment Integration (Simulasi)
- [x] Search & Filter Produk
- [x] Status Tracking
- [x] Responsive Design
- [x] Data Dummy (18 produk kesehatan)

## 🎯 Apa Selanjutnya?

1. **Tambah Gambar Produk**: Upload gambar untuk setiap produk
2. **Test Semua Flow**: Coba semua fitur dari awal sampai akhir
3. **Kustomisasi Design**: Sesuaikan warna dan layout
4. **Integrasi Real Payment**: Implementasi payment gateway
5. **Email Notification**: Setup email untuk order confirmation
6. **Production Deployment**: Deploy ke server production

## 📞 Need Help?

Jika ada pertanyaan atau issues:
1. Check dokumentasi lengkap di `E_COMMERCE_DOCUMENTATION.md`
2. Review kode di controllers dan models
3. Check Laravel logs di `storage/logs/laravel.log`

Happy Coding! 🚀

# 🛒 Fitur E-Commerce - Produk Kesehatan

## 📋 Deskripsi
Sistem E-Commerce lengkap untuk penjualan produk kesehatan dengan fitur katalog produk, shopping cart, checkout, dan manajemen pesanan.

## ✨ Fitur Utama

### 1. 📦 Katalog Produk
- **List Produk**: Menampilkan semua produk kesehatan dengan pagination
- **Detail Produk**: Informasi lengkap produk dengan produk terkait
- **Pencarian**: Cari produk berdasarkan nama
- **Filter**: Filter produk berdasarkan kategori
- **Sorting**: Urutkan berdasarkan harga (terendah/tertinggi), nama, atau terbaru
- **Kategori**: 
  - Vitamin & Suplemen
  - Obat-obatan
  - Alat Kesehatan
  - Perawatan Tubuh
  - Herbal & Tradisional

### 2. 🛒 Shopping Cart
- **Tambah ke Keranjang**: Tambahkan produk dengan jumlah yang diinginkan
- **Update Quantity**: Ubah jumlah produk di keranjang
- **Hapus Item**: Hapus produk dari keranjang
- **Kosongkan Keranjang**: Hapus semua produk sekaligus
- **Ringkasan Pesanan**: Total harga dan jumlah item
- **Persistent Cart**: Keranjang tersimpan untuk user login dan session untuk guest

### 3. 💳 Checkout Process
- **Formulir Pengiriman**: Input alamat lengkap, kota, kode pos, dan nomor telepon
- **Metode Pembayaran**:
  - Transfer Bank (BCA, BNI, Mandiri, BRI)
  - Kartu Kredit/Debit (Visa, Mastercard, JCB)
  - E-Wallet (GoPay, OVO, Dana, ShopeePay)
- **Catatan Pesanan**: Tambahkan catatan untuk penjual/kurir
- **Validasi Stock**: Pengecekan ketersediaan produk saat checkout
- **Otomatis Update Stock**: Stock produk berkurang setelah order berhasil

### 4. 📦 Order Management

#### User Features:
- **Riwayat Pesanan**: Lihat semua pesanan yang pernah dibuat
- **Detail Pesanan**: Informasi lengkap pesanan (produk, alamat, status, pembayaran)
- **Status Tracking**: Timeline status pesanan
  - Menunggu Pembayaran
  - Diproses
  - Dikirim
  - Selesai
  - Dibatalkan
- **Konfirmasi Pembayaran**: Simulasi konfirmasi pembayaran

#### Admin Features:
- **Dashboard Pesanan**: Lihat semua pesanan dari semua customer
- **Filter Status**: Filter pesanan berdasarkan status
- **Update Status**: Ubah status pesanan secara langsung
- **Informasi Customer**: Lihat data pembeli

### 5. 💰 Payment Integration (Simulasi)
- **Simulasi Pembayaran**: Tombol untuk mensimulasikan pembayaran berhasil
- **Instruksi Pembayaran**: Informasi rekening bank dan nominal transfer
- **Status Pembayaran**: Pending, Paid, Failed, Refunded
- **Transaction ID**: ID transaksi unik untuk setiap pembayaran

## 🗄️ Database Schema

### Tables:
1. **categories**: Kategori produk
2. **products**: Produk kesehatan
3. **carts**: Keranjang belanja user
4. **cart_items**: Item dalam keranjang
5. **orders**: Pesanan customer
6. **order_items**: Item dalam pesanan
7. **payments**: Informasi pembayaran

## 🚀 Setup dan Instalasi

### 1. Jalankan Migrasi
```bash
php artisan migrate
```

### 2. Jalankan Seeder
```bash
php artisan db:seed --class=ProductSeeder
```
Atau jalankan semua seeder:
```bash
php artisan db:seed
```

### 3. Setup Storage (untuk gambar produk)
```bash
php artisan storage:link
```

## 📍 Routes

### Public Routes:
- `GET /shop/products` - List produk
- `GET /shop/products/{slug}` - Detail produk
- `GET /shop/cart` - Keranjang (guest & user)
- `POST /shop/cart/add/{product}` - Tambah ke keranjang
- `PATCH /shop/cart/update/{cartItem}` - Update keranjang
- `DELETE /shop/cart/remove/{cartItem}` - Hapus dari keranjang
- `DELETE /shop/cart/clear` - Kosongkan keranjang

### Authenticated Routes:
- `GET /shop/checkout` - Halaman checkout
- `POST /shop/checkout/process` - Proses checkout
- `GET /shop/checkout/success/{order}` - Halaman sukses
- `POST /shop/checkout/confirm-payment/{order}` - Konfirmasi pembayaran
- `GET /orders` - Riwayat pesanan
- `GET /orders/{order}` - Detail pesanan

### Admin Routes:
- `GET /admin/orders` - Dashboard pesanan (admin)
- `PATCH /admin/orders/{order}/status` - Update status pesanan

## 📦 Produk Dummy

Seeder akan membuat 18 produk kesehatan dalam 5 kategori:

### Vitamin & Suplemen (4 produk)
- Vitamin C 1000mg - Rp 85.000
- Multivitamin Complete - Rp 120.000
- Omega 3 Fish Oil - Rp 150.000
- Vitamin D3 2000 IU - Rp 95.000

### Obat-obatan (3 produk)
- Paracetamol 500mg - Rp 15.000
- Obat Batuk Sirup - Rp 35.000
- Antasida Tablet - Rp 25.000

### Alat Kesehatan (4 produk)
- Termometer Digital - Rp 75.000
- Tensimeter Digital - Rp 250.000
- Masker Medis 3 Ply (50 pcs) - Rp 45.000
- Hand Sanitizer 100ml - Rp 20.000

### Perawatan Tubuh (3 produk)
- Sabun Antiseptik - Rp 30.000
- Lotion Pelembab - Rp 55.000
- Sunscreen SPF 50 - Rp 85.000

### Herbal & Tradisional (4 produk)
- Madu Murni 500ml - Rp 75.000
- Jahe Merah Instan - Rp 35.000
- Habbatussauda Oil - Rp 65.000
- Curcuma Plus - Rp 45.000

## 🎨 UI/UX Features

### Responsive Design
- Mobile-friendly layout
- Adaptive grid system
- Touch-friendly buttons

### User Experience
- Toast notifications untuk feedback
- Loading states
- Form validation
- Error handling
- Empty states

### Visual Elements
- Product images support
- Status badges dengan color coding
- Icons dari Font Awesome
- Tailwind CSS untuk styling

## 🔐 Security Features

- Authentication required untuk checkout
- User hanya bisa lihat pesanan sendiri
- Admin role checking
- CSRF protection
- SQL injection prevention (Eloquent ORM)
- Stock validation

## 📱 Cara Penggunaan

### Sebagai Customer:

1. **Browse Produk**
   - Buka `/shop/products`
   - Gunakan filter dan pencarian
   - Klik produk untuk melihat detail

2. **Tambah ke Keranjang**
   - Pilih jumlah yang diinginkan
   - Klik "Tambah ke Keranjang"
   - Lihat keranjang di `/shop/cart`

3. **Checkout**
   - Login atau register
   - Klik "Lanjut ke Pembayaran"
   - Isi alamat pengiriman
   - Pilih metode pembayaran
   - Klik "Proses Pembayaran"

4. **Pembayaran**
   - Lihat instruksi pembayaran
   - Untuk simulasi, klik "Simulasi: Konfirmasi Pembayaran"
   - Lihat detail pesanan di "Pesanan Saya"

5. **Tracking Pesanan**
   - Buka `/orders` untuk riwayat pesanan
   - Klik pesanan untuk melihat detail dan status

### Sebagai Admin:

1. **Lihat Semua Pesanan**
   - Buka `/admin/orders`
   - Filter berdasarkan status jika perlu

2. **Update Status Pesanan**
   - Pilih status baru dari dropdown
   - Status otomatis tersimpan

## 🔄 Status Pesanan Flow

```
Pending (Menunggu Pembayaran)
    ↓
Processing (Diproses) - setelah pembayaran dikonfirmasi
    ↓
Shipped (Dikirim) - pesanan dikirim ke customer
    ↓
Delivered (Selesai) - pesanan diterima customer
```

Atau bisa langsung:
```
Pending → Cancelled (Dibatalkan)
```

## 🎯 Fitur Tambahan

- **Gratis Ongkir**: Semua pesanan gratis ongkos kirim
- **Produk Terkait**: Rekomendasi produk sejenis
- **Search & Filter**: Pencarian dan filter advanced
- **Product Availability**: Indikator stok tersedia/habis
- **Order History**: Riwayat lengkap dengan pagination
- **Transaction ID**: ID unik untuk setiap transaksi
- **Order Number**: Nomor pesanan dengan format ORD-YYYYMMDD-XXXXXX

## 📞 Support

Untuk pertanyaan atau bantuan:
- WhatsApp: 081234567890
- Email: support@healthcare.com

## 🚀 Next Steps

Untuk development lebih lanjut:
1. Upload gambar produk ke `storage/app/public/`
2. Integrasi payment gateway real (Midtrans, Xendit, dll)
3. Email notification untuk order confirmation
4. Review & rating produk
5. Wishlist functionality
6. Promo & discount codes
7. Stock alert notifications
8. Export order reports

## 📝 Notes

- Ini adalah implementasi lengkap sistem e-commerce
- Payment adalah simulasi untuk keperluan demo
- Semua fitur CRUD sudah terintegrasi
- Database relationships sudah optimal
- Ready untuk production dengan beberapa enhancement

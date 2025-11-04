# ✅ E-Commerce Testing Checklist

## 🎯 Pre-Testing Setup

- [ ] Database sudah dimigrate (`php artisan migrate`)
- [ ] Seeder sudah dijalankan (`php artisan db:seed`)
- [ ] Storage link sudah dibuat (`php artisan storage:link`)
- [ ] Server sudah running (`php artisan serve`)

## 📦 1. Katalog Produk Testing

### List Produk (`/shop/products`)
- [ ] Halaman produk bisa diakses
- [ ] Menampilkan 18 produk (atau sesuai pagination)
- [ ] Pagination berfungsi
- [ ] Search produk by name berfungsi
- [ ] Filter by category berfungsi
- [ ] Sort by price (low/high) berfungsi
- [ ] Sort by name berfungsi
- [ ] Sort by latest berfungsi
- [ ] Tombol "Tambah ke Keranjang" muncul
- [ ] Stok produk ditampilkan
- [ ] Harga produk ditampilkan dengan format Rupiah

### Detail Produk (`/shop/products/{slug}`)
- [ ] Halaman detail bisa diakses
- [ ] Nama produk ditampilkan
- [ ] Kategori produk ditampilkan
- [ ] Harga ditampilkan
- [ ] Deskripsi lengkap ditampilkan
- [ ] Stok availability ditampilkan
- [ ] Quantity input berfungsi
- [ ] Tombol "Tambah ke Keranjang" berfungsi
- [ ] Related products ditampilkan (jika ada)
- [ ] Link kembali ke katalog berfungsi

## 🛒 2. Shopping Cart Testing

### Guest User (Tanpa Login)
- [ ] Bisa akses halaman cart (`/shop/cart`)
- [ ] Bisa tambah produk ke cart
- [ ] Cart items ditampilkan dengan benar
- [ ] Quantity bisa diupdate
- [ ] Subtotal dihitung dengan benar
- [ ] Total price dihitung dengan benar
- [ ] Bisa hapus item dari cart
- [ ] Bisa kosongkan cart
- [ ] Tombol "Lanjut Belanja" berfungsi
- [ ] Muncul notifikasi "Login untuk checkout"

### Logged In User
- [ ] Cart tersimpan setelah login
- [ ] Semua fitur guest user berfungsi
- [ ] Tombol "Lanjut ke Pembayaran" muncul
- [ ] Bisa akses checkout page

### Cart Operations
- [ ] Add to cart berhasil (toast notification muncul)
- [ ] Update quantity berhasil
- [ ] Remove item berhasil
- [ ] Clear cart berhasil
- [ ] Cart counter update real-time
- [ ] Validation max stock berfungsi
- [ ] Empty cart state ditampilkan dengan benar

## 💳 3. Checkout Process Testing

### Akses Checkout (`/shop/checkout`)
- [ ] Redirect ke login jika belum login
- [ ] Redirect ke cart jika cart kosong
- [ ] Form shipping information ditampilkan
- [ ] Form payment method ditampilkan
- [ ] Order summary ditampilkan
- [ ] Product list ditampilkan
- [ ] Total price benar

### Form Validation
- [ ] Alamat wajib diisi
- [ ] Kota wajib diisi
- [ ] Kode pos wajib diisi
- [ ] Nomor telepon wajib diisi
- [ ] Payment method wajib dipilih
- [ ] Error messages ditampilkan
- [ ] Form auto-fill data user (jika ada)

### Submit Order
- [ ] Tombol "Proses Pembayaran" berfungsi
- [ ] Loading state ditampilkan
- [ ] Stock validation berfungsi
- [ ] Order berhasil dibuat
- [ ] Order number ter-generate
- [ ] Stock produk berkurang
- [ ] Cart dikosongkan setelah order
- [ ] Redirect ke success page

## ✅ 4. Success Page Testing (`/shop/checkout/success/{order}`)

- [ ] Halaman success ditampilkan
- [ ] Success icon/message muncul
- [ ] Order number ditampilkan
- [ ] Tanggal order ditampilkan
- [ ] Instruksi pembayaran sesuai metode
- [ ] Detail produk ditampilkan
- [ ] Total pembayaran benar
- [ ] Alamat pengiriman ditampilkan
- [ ] Tombol "Simulasi Pembayaran" muncul (jika pending)
- [ ] Tombol "Lihat Detail Pesanan" berfungsi
- [ ] Tombol "Lanjut Belanja" berfungsi

### Payment Instructions
#### Bank Transfer
- [ ] Nomor rekening ditampilkan
- [ ] Nama penerima ditampilkan
- [ ] Jumlah transfer ditampilkan

#### Credit Card
- [ ] Instruksi kartu kredit ditampilkan

#### E-Wallet
- [ ] QR Code placeholder ditampilkan

## 📋 5. Order Management - Customer Testing

### Order History (`/orders`)
- [ ] Require authentication
- [ ] List semua order user ditampilkan
- [ ] Order number ditampilkan
- [ ] Tanggal order ditampilkan
- [ ] Status order dengan color coding
- [ ] Total amount ditampilkan
- [ ] Payment status ditampilkan
- [ ] Product preview ditampilkan (2 items)
- [ ] Tombol "Lihat Detail" berfungsi
- [ ] Pagination berfungsi
- [ ] Empty state untuk no orders

### Order Detail (`/orders/{order}`)
- [ ] Hanya pemilik order yang bisa akses
- [ ] Order number ditampilkan
- [ ] Status current ditampilkan
- [ ] Timeline status ditampilkan dengan benar
- [ ] Semua products dalam order ditampilkan
- [ ] Quantity dan price per item benar
- [ ] Subtotal dan total benar
- [ ] Alamat pengiriman lengkap
- [ ] Nomor telepon ditampilkan
- [ ] Catatan ditampilkan (jika ada)
- [ ] Payment method ditampilkan
- [ ] Payment status ditampilkan
- [ ] Transaction ID ditampilkan (jika paid)
- [ ] Tombol konfirmasi pembayaran (jika pending)
- [ ] Link WhatsApp & Email support berfungsi
- [ ] Tombol kembali berfungsi

### Payment Confirmation Simulation
- [ ] Tombol "Simulasi: Konfirmasi Pembayaran" muncul
- [ ] Klik tombol berhasil
- [ ] Payment status berubah jadi "Paid"
- [ ] Order status berubah jadi "Processing"
- [ ] Transaction ID ter-generate
- [ ] Paid_at timestamp tersimpan
- [ ] Success notification muncul

## 👨‍💼 6. Order Management - Admin Testing

### Admin Dashboard (`/admin/orders`)
- [ ] Require admin role
- [ ] User non-admin tidak bisa akses
- [ ] List semua order ditampilkan
- [ ] Filter by status berfungsi
- [ ] Reset filter berfungsi
- [ ] Table menampilkan:
  - [ ] Order number
  - [ ] Customer name & email
  - [ ] Order date
  - [ ] Total amount
  - [ ] Payment status
  - [ ] Order status
- [ ] Status dropdown ditampilkan
- [ ] Pagination berfungsi

### Update Order Status
- [ ] Dropdown status berfungsi
- [ ] Select status baru
- [ ] Auto-submit on change
- [ ] Status berhasil diupdate
- [ ] Success notification muncul
- [ ] Status badge color berubah
- [ ] Perubahan tersimpan di database

### Status Options
- [ ] Pending option tersedia
- [ ] Processing option tersedia
- [ ] Shipped option tersedia
- [ ] Delivered option tersedia
- [ ] Cancelled option tersedia
- [ ] Current status selected by default

## 🔄 7. Status Flow Testing

### Complete Order Flow
1. [ ] Create order → Status: Pending
2. [ ] Confirm payment → Status: Processing
3. [ ] Admin update → Status: Shipped
4. [ ] Admin update → Status: Delivered
5. [ ] Timeline tracking benar di setiap step

### Cancel Flow
1. [ ] Create order → Status: Pending
2. [ ] Admin update → Status: Cancelled
3. [ ] Status berubah dengan benar

## 🔍 8. Data Integrity Testing

### Stock Management
- [ ] Stock berkurang saat order dibuat
- [ ] Stock validation saat checkout
- [ ] Tidak bisa order melebihi stock
- [ ] Stock update reflected di product list

### Cart Data
- [ ] Price tersimpan saat add to cart
- [ ] Price tidak berubah jika product price berubah
- [ ] Quantity validation dengan stock
- [ ] Cart items terhapus setelah checkout

### Order Data
- [ ] Order number unique
- [ ] Total amount calculated correctly
- [ ] Product name tersimpan (tidak referensi)
- [ ] Price tersimpan (snapshot saat order)
- [ ] Timestamps recorded correctly

## 🎨 9. UI/UX Testing

### Responsive Design
- [ ] Desktop view (1920px)
- [ ] Laptop view (1366px)
- [ ] Tablet view (768px)
- [ ] Mobile view (375px)
- [ ] Navigation responsive
- [ ] Tables responsive
- [ ] Forms responsive

### Visual Elements
- [ ] Colors consistent
- [ ] Icons displayed correctly
- [ ] Images load properly
- [ ] Buttons hover states
- [ ] Links hover states
- [ ] Loading states shown
- [ ] Toast notifications styled

### User Feedback
- [ ] Success messages clear
- [ ] Error messages helpful
- [ ] Empty states informative
- [ ] Loading indicators present
- [ ] Form validation messages clear

## 🔐 10. Security Testing

### Authentication
- [ ] Checkout requires login
- [ ] Order history requires login
- [ ] User only sees own orders
- [ ] Admin routes require admin role
- [ ] Logout works properly

### Authorization
- [ ] User can't access other user's orders
- [ ] Non-admin can't access admin dashboard
- [ ] Direct URL access protected
- [ ] API endpoints protected (if any)

### Data Validation
- [ ] SQL injection prevented (Eloquent ORM)
- [ ] XSS attacks prevented (Blade escaping)
- [ ] CSRF tokens present
- [ ] Input sanitization works
- [ ] Stock validation enforced

## 📊 11. Performance Testing

### Page Load
- [ ] Catalog loads < 2 seconds
- [ ] Cart loads instantly
- [ ] Checkout loads < 1 second
- [ ] Order pages load < 1 second

### Database Queries
- [ ] Eager loading used (no N+1 queries)
- [ ] Pagination efficient
- [ ] Indexes used properly

### Assets
- [ ] CSS minified (production)
- [ ] JS minified (production)
- [ ] Images optimized

## 🐛 12. Error Handling Testing

### Common Errors
- [ ] 404 for non-existent products
- [ ] 404 for non-existent orders
- [ ] 403 for unauthorized access
- [ ] Validation errors displayed
- [ ] Database errors caught
- [ ] Network errors handled

### Edge Cases
- [ ] Empty cart checkout prevented
- [ ] Out of stock product handling
- [ ] Concurrent order attempts
- [ ] Payment already confirmed handling
- [ ] Invalid order status updates prevented

## 📱 13. Navigation Testing

### Header Navigation
- [ ] Logo link works
- [ ] Dashboard link works
- [ ] Belanja link works
- [ ] Keranjang link works
- [ ] Pesanan link works (auth)
- [ ] Kelola Pesanan link works (admin)
- [ ] Profile dropdown works
- [ ] Logout works

### Footer Navigation (if exists)
- [ ] All footer links work
- [ ] Social media links work
- [ ] Contact information correct

### Breadcrumbs (if exists)
- [ ] Breadcrumbs accurate
- [ ] All breadcrumb links work

## 📝 14. Final Checklist

### Documentation
- [ ] README.md updated
- [ ] E_COMMERCE_DOCUMENTATION.md complete
- [ ] E_COMMERCE_QUICK_START.md clear
- [ ] Code comments adequate
- [ ] Database schema documented

### Code Quality
- [ ] Controllers clean & organized
- [ ] Models have relationships
- [ ] Views follow Blade conventions
- [ ] Routes organized logically
- [ ] No hardcoded values
- [ ] Naming conventions consistent

### Production Ready
- [ ] .env.example updated
- [ ] Migrations rollback successfully
- [ ] Seeders work properly
- [ ] No debug code left
- [ ] Error logging configured
- [ ] Queue configured (if needed)

## 🎉 Summary

Total Test Cases: **~200 items**

### Priority Testing:
1. **High Priority** (Core functionality):
   - Add to cart
   - Checkout process
   - Order creation
   - Payment confirmation
   - Order viewing

2. **Medium Priority** (Important features):
   - Search & filter
   - Status updates
   - Admin dashboard
   - Cart operations

3. **Low Priority** (Polish):
   - UI/UX details
   - Responsive design
   - Error messages
   - Edge cases

---

**Testing Status**: [ ] Not Started | [ ] In Progress | [ ] Completed

**Tester**: _______________

**Date**: _______________

**Notes**:
_________________________________
_________________________________
_________________________________

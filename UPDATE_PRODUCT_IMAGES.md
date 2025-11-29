# Cara Update Gambar Produk di Railway

Setelah deployment berhasil, jalankan script ini untuk mengupdate gambar produk:

## Via Railway CLI

```bash
railway run php update-products.php
```

## Via Railway Dashboard

1. Buka Railway Dashboard
2. Pilih project Anda
3. Klik tab "Settings"
4. Scroll ke "Custom Start Command"
5. Jalankan command berikut di Railway Shell:

```bash
php update-products.php
```

## Via Endpoint HTTP (Alternatif)

Buat file `routes/web.php` tambahkan route temporary:

```php
Route::get('/update-products', function() {
    require base_path('update-products.php');
    return 'Products updated!';
})->middleware('auth');
```

Kemudian akses: `https://your-app.up.railway.app/update-products`

**PENTING:** Hapus route ini setelah update selesai untuk keamanan!

## Verifikasi

Setelah menjalankan script, cek halaman shop untuk memastikan setiap produk memiliki gambar yang berbeda-beda.

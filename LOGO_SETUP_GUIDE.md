# Panduan Upload Logo Hospital

## 📍 Lokasi File Logo

Upload file **LogoRs.png** Anda ke folder:
```
public/images/LogoRs.png
```

**Path lengkap:**
```
/Users/crescendo/Documents/GitHub/Tubes-PemWebCrs/public/images/LogoRs.png
```

## ✅ Yang Sudah Diubah

### 1. **Komponen Logo** (`resources/views/components/application-logo.blade.php`)
   - Diganti dari SVG Laravel menjadi gambar + teks
   - Menampilkan logo + tulisan "Health Care"

### 2. **Navigation Bar** (`resources/views/layouts/navigation.blade.php`)
   - Logo di navbar sekarang menampilkan gambar + "Health Care"
   - Ukuran: tinggi 40px (h-10)
   - Warna teks: putih (untuk navbar gelap)

### 3. **Guest Layout** (`resources/views/layouts/guest.blade.php`)
   - Logo di halaman login/register
   - Layout vertikal (logo di atas, text di bawah)
   - Ukuran: 80px x 80px (w-20 h-20)
   - Warna teks: abu gelap (text-gray-800)

## 📋 Cara Upload Logo

### Opsi 1: Via Finder (macOS)
1. Buka Finder
2. Navigate ke: `/Users/crescendo/Documents/GitHub/Tubes-PemWebCrs/public/images/`
3. Copy paste file **LogoRs.png** ke folder ini

### Opsi 2: Via Terminal
```bash
cd /Users/crescendo/Documents/GitHub/Tubes-PemWebCrs/public/images/
# Lalu drag-drop file LogoRs.png ke sini
```

### Opsi 3: Via VS Code
1. Buka folder project di VS Code
2. Buka folder `public/images/`
3. Drag & drop file **LogoRs.png** ke folder ini

## 🎨 Spesifikasi Logo yang Direkomendasikan

### Untuk Navbar (Horizontal):
- **Format:** PNG dengan background transparan
- **Ukuran optimal:** 200px x 200px (akan di-resize otomatis ke 40px tinggi)
- **Rasio:** Square atau sedikit landscape
- **Background:** Transparan lebih bagus

### Untuk Login Page (Vertikal):
- **Ukuran display:** 80px x 80px
- **Sama seperti navbar, akan auto-resize**

## 🔄 Testing Setelah Upload

Setelah upload logo, test di:

1. **Navbar** - Lihat logo di kiri atas dengan text "Health Care" di sampingnya
2. **Login Page** - `/login` - Logo di atas dengan text di bawah
3. **Register Page** - `/register` - Same as login

## 🚀 Deploy ke Railway

Setelah upload logo dan test lokal, commit dan push:

```bash
# Add logo file
git add public/images/LogoRs.png

# Add semua perubahan
git add -A

# Commit
git commit -m "Add hospital logo and Health Care branding"

# Push ke GitHub
git push origin main
```

Railway akan auto-deploy dan logo akan muncul di production.

## 🎯 Preview Tampilan

### Navigation Bar (Horizontal):
```
[🏥 Logo] Health Care | Dashboard | Belanja | ...
```

### Login/Register Page (Vertikal):
```
    🏥
  [Logo]
  
Health Care

┌──────────────┐
│ Login Form   │
└──────────────┘
```

## ⚠️ Troubleshooting

### Logo tidak muncul:
1. Pastikan nama file **persis** `LogoRs.png` (case-sensitive)
2. Pastikan file ada di `public/images/LogoRs.png`
3. Clear browser cache (Cmd+Shift+R di macOS)
4. Pastikan file tidak corrupt

### Logo terlalu besar/kecil:
Edit ukuran di file:
- **Navbar:** `navigation.blade.php` line 10 → ubah `h-10` (40px, 48px, 56px, dst)
- **Login:** `guest.blade.php` line 21 → ubah `w-20 h-20` (w-16 h-16, w-24 h-24, dst)

### Logo pecah/blur:
- Upload logo dengan resolusi lebih tinggi
- Minimal 200x200px untuk hasil terbaik

## 📝 Files yang Dimodifikasi

1. ✅ `resources/views/components/application-logo.blade.php` - Component logo
2. ✅ `resources/views/layouts/navigation.blade.php` - Navbar logo
3. ✅ `resources/views/layouts/guest.blade.php` - Login/register logo
4. ✅ `public/images/` - Folder untuk logo (sudah dibuat)

---

**Status:** ✅ Ready untuk upload logo
**Next Step:** Upload file LogoRs.png ke folder `public/images/`

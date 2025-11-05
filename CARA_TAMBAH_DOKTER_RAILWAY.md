# 🚀 CARA MENAMBAHKAN DOKTER KE DATABASE RAILWAY

## Masalah
Website production tidak menampilkan dokter karena database masih kosong.

## ✅ Solusi - 3 Cara (Pilih Salah Satu)

---

## 📱 CARA 1: Via Railway Console (PALING MUDAH)

### Langkah-langkah:

1. **Buka Railway Dashboard**
   - Go to: https://railway.app
   - Login
   - Pilih project Anda

2. **Buka Console/Terminal**
   - Klik service yang running
   - Klik tab "Deployments"
   - Klik deployment yang "Active" (hijau)
   - Klik tombol ">_" (Console) di pojok kanan atas

3. **Jalankan Command Ini (SATU PER SATU)**

```bash
# Cek koneksi database
php artisan tinker
DB::connection()->getPdo();
exit

# Jalankan migrations
php artisan migrate --force

# PENTING: Tambahkan data dokter
php artisan db:seed --class=DoctorSeeder --force

# Tambahkan test patient
php artisan db:seed --class=PatientTestSeeder --force

# Cache untuk production
php artisan config:cache
php artisan route:cache

# Verifikasi - cek jumlah dokter
php artisan tinker
\App\Models\Doctor::count()
# Harus return: 8
exit
```

4. **Refresh website production Anda**
   - Sekarang akan muncul 8 dokter!

---

## 💻 CARA 2: Via Railway CLI (untuk advanced users)

### Install Railway CLI:
```bash
npm install -g @railway/cli
```

### Login & Setup:
```bash
railway login
railway link
```

### Seed Database:
```bash
railway run php artisan migrate --force
railway run php artisan db:seed --class=DoctorSeeder --force
railway run php artisan db:seed --class=PatientTestSeeder --force
railway run php artisan config:cache
```

### Verify:
```bash
railway run php artisan tinker --execute="\App\Models\Doctor::count()"
```

---

## 🔄 CARA 3: Auto Seed Saat Deploy (Set Once, Forget Forever)

Sudah diatur! Setiap kali Anda push code baru, Railway akan otomatis:
1. Pull dari GitHub
2. Run migrations
3. **Run seeders (termasuk DoctorSeeder)**
4. Deploy

**Yang perlu Anda lakukan SEKARANG:**

Railway sudah mulai auto-deploy karena Anda baru saja push. Tunggu 3-5 menit, kemudian refresh website production!

---

## 🎯 Setelah Seeder Berhasil

Anda akan melihat **8 Dokter**:

### 1. **Dr. Ahmad Fadli** - Kardiologi
- Email: ahmad.fadli@hospital.com
- Password: password123
- Harga: Rp 350,000/sesi
- Hari: Monday, Wednesday, Friday
- Jam: 09:00 - 17:00

### 2. **Dr. Citra Dewi** - Dermatologi
- Email: citra.dewi@hospital.com
- Password: password123
- Harga: Rp 300,000/sesi
- Hari: Tuesday, Thursday, Saturday
- Jam: 10:00 - 18:00

### 3. **Dr. Budi Santoso** - Dokter Umum
- Email: budi.santoso@hospital.com
- Password: password123
- Harga: Rp 150,000/sesi
- Hari: Monday-Friday
- Jam: 08:00 - 20:00

### 4. **Dr. Sarah Wijaya** - Pediatri
- Email: sarah.wijaya@hospital.com
- Password: password123
- Harga: Rp 250,000/sesi
- Hari: Monday, Wednesday, Friday, Saturday
- Jam: 09:00 - 16:00

### 5. **Dr. Rudi Hermawan** - Orthopedi
- Email: rudi.hermawan@hospital.com
- Password: password123
- Harga: Rp 400,000/sesi
- Hari: Tuesday, Thursday
- Jam: 10:00 - 15:00

### 6. **Dr. Linda Kusuma** - Dokter Gigi
- Email: linda.kusuma@hospital.com
- Password: password123
- Harga: Rp 200,000/sesi
- Hari: Monday-Saturday
- Jam: 09:00 - 17:00

### 7. **Dr. Andri Pratama** - Psikiater
- Email: andri.pratama@hospital.com
- Password: password123
- Harga: Rp 350,000/sesi
- Hari: Monday, Wednesday, Friday
- Jam: 13:00 - 20:00

### 8. **Dr. Maya Sari** - Obstetri & Ginekologi
- Email: maya.sari@hospital.com
- Password: password123
- Harga: Rp 300,000/sesi
- Hari: Tuesday, Thursday, Saturday
- Jam: 08:00 - 16:00

---

## 🧪 Test Account

**Patient Login:**
- Email: patient@test.com
- Password: password123

**Doctor Login (contoh):**
- Email: ahmad.fadli@hospital.com
- Password: password123

---

## ❓ Troubleshooting

### Error: "Class 'DoctorSeeder' not found"
```bash
railway run composer dump-autoload
railway run php artisan db:seed --class=DoctorSeeder --force
```

### Error: "Duplicate entry"
Seeder sudah pernah dijalankan. Skip atau reset:
```bash
# HATI-HATI: Ini akan hapus semua data!
railway run php artisan migrate:fresh --force --seed
```

### Cek apakah dokter sudah ada:
```bash
railway run php artisan tinker
\App\Models\Doctor::count()
\App\Models\Doctor::with('user')->get()
exit
```

---

## 📝 Checklist

- [ ] Jalankan salah satu cara di atas
- [ ] Tunggu Railway deployment selesai (jika auto-deploy)
- [ ] Refresh website production
- [ ] Login dengan patient@test.com / password123
- [ ] Klik "Book Appointment"
- [ ] Lihat 8 dokter muncul!

---

**Terakhir Diupdate**: 5 November 2025
**Status**: ✅ Ready - Code sudah di-push ke GitHub

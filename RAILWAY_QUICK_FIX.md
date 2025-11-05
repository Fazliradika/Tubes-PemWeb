# QUICK FIX - Setup Database Railway

## Langkah 1: Akses Railway Console

1. Buka https://railway.app
2. Login ke akun Anda
3. Pilih project "Tubes-PemWeb" (atau nama project Anda)
4. Klik pada service yang running (biasanya ada icon web)
5. Klik tab **"Deployments"**
6. Klik pada deployment yang **"Active"** (hijau)
7. Klik tombol **"View Logs"**
8. Di pojok kanan atas, klik icon **">_"** (Console/Terminal)

## Langkah 2: Jalankan Commands Berikut

Copy paste satu per satu ke console Railway:

```bash
# 1. Cek koneksi database
php artisan tinker
DB::connection()->getPdo();
exit

# 2. Jalankan migration (buat tabel)
php artisan migrate --force

# 3. Seed data dokter (8 dokter)
php artisan db:seed --class=DoctorSeeder --force

# 4. Seed test patient account
php artisan db:seed --class=PatientTestSeeder --force

# 5. Clear dan cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Verifikasi - cek jumlah dokter
php artisan tinker
\App\Models\Doctor::count()
exit
```

## Langkah 3: Refresh Website

Setelah semua command berhasil:
1. Tutup console Railway
2. Refresh website production Anda
3. Login dengan: patient@test.com / password123
4. Klik "Book Appointment"
5. Anda akan melihat 8 dokter!

---

## Troubleshooting

### Jika Error "Class DoctorSeeder not found":
```bash
composer dump-autoload
php artisan db:seed --class=DoctorSeeder --force
```

### Jika Error "Table doesn't exist":
```bash
php artisan migrate:fresh --force
php artisan db:seed --class=DoctorSeeder --force
```

### Jika Console tidak muncul:
Gunakan Railway CLI:
```bash
railway login
railway link
railway run php artisan migrate --force
railway run php artisan db:seed --class=DoctorSeeder --force
```

---

## Data yang Akan Muncul:

✅ Dr. Ahmad Fadli - Kardiologi
✅ Dr. Citra Dewi - Dermatologi  
✅ Dr. Budi Santoso - Dokter Umum
✅ Dr. Sarah Wijaya - Pediatri
✅ Dr. Rudi Hermawan - Orthopedi
✅ Dr. Linda Kusuma - Dokter Gigi
✅ Dr. Andri Pratama - Psikiater
✅ Dr. Maya Sari - Obstetri & Ginekologi

**Login**: patient@test.com / password123

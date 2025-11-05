# 🚨 URGENT: Database Railway Tidak Ada Dokter

## Masalah Anda

**Production URL**: https://tubes-pemweb-production.up.railway.app/appointments
- Status: ❌ "Tidak ada dokter tersedia"

**Localhost**: http://127.0.0.1:9000/appointments
- Status: ✅ Menampilkan 8 dokter

## Penyebab

Database Railway dan localhost adalah **BERBEDA**:
- **Localhost**: SQLite (sudah di-seed ✅)
- **Railway**: MySQL/PostgreSQL (masih kosong ❌)

---

## ✅ SOLUSI - 2 Cara (Pilih salah satu)

### 🚀 CARA 1: Railway Console (5 menit)

#### Step 1: Buka Console
1. Go to https://railway.app
2. Login dan pilih project "tubes-pemweb-production"
3. Klik service yang running
4. Tab **"Deployments"** → Klik yang **"Active"** (hijau)
5. Klik icon **">_"** (Console) pojok kanan atas

#### Step 2: Jalankan Commands (Copy-Paste Satu Per Satu)

```bash
# Check database
php artisan tinker
DB::connection()->getPdo();
exit

# Run migrations
php artisan migrate --force

# SEED DOKTER (PENTING!)
php artisan db:seed --class=DoctorSeeder --force

# Seed test patient
php artisan db:seed --class=PatientTestSeeder --force

# Clear cache
php artisan config:clear
php artisan cache:clear

# Verify
php artisan tinker
\App\Models\Doctor::count()
# Expected: 8
exit
```

#### Step 3: Refresh Website
Buka lagi https://tubes-pemweb-production.up.railway.app/appointments

✅ **8 dokter akan muncul!**

---

### 💻 CARA 2: Railway CLI

```bash
# Install Railway CLI
npm install -g @railway/cli

# Login
railway login

# Link project
railway link

# Seed database
railway run php artisan migrate --force
railway run php artisan db:seed --class=DoctorSeeder --force
railway run php artisan db:seed --class=PatientTestSeeder --force
railway run php artisan config:cache
```

---

## 📊 8 Dokter yang Akan Muncul

Setelah seeder berhasil:

1. **Dr. Ahmad Fadli** - Kardiologi (Rp 350,000/sesi)
   - Hari: Monday, Wednesday, Friday
   - Jam: 09:00 - 17:00

2. **Dr. Citra Dewi** - Dermatologi (Rp 300,000/sesi)
   - Hari: Tuesday, Thursday, Saturday
   - Jam: 10:00 - 18:00

3. **Dr. Budi Santoso** - Dokter Umum (Rp 150,000/sesi)
   - Hari: Monday - Friday
   - Jam: 08:00 - 20:00

4. **Dr. Sarah Wijaya** - Pediatri (Rp 250,000/sesi)
   - Hari: Monday, Wednesday, Friday, Saturday
   - Jam: 09:00 - 16:00

5. **Dr. Rudi Hermawan** - Orthopedi (Rp 400,000/sesi)
   - Hari: Tuesday, Thursday
   - Jam: 10:00 - 15:00

6. **Dr. Linda Kusuma** - Dokter Gigi (Rp 200,000/sesi)
   - Hari: Monday - Saturday
   - Jam: 09:00 - 17:00

7. **Dr. Andri Pratama** - Psikiater (Rp 350,000/sesi)
   - Hari: Monday, Wednesday, Friday
   - Jam: 13:00 - 20:00

8. **Dr. Maya Sari** - Obstetri & Ginekologi (Rp 300,000/sesi)
   - Hari: Tuesday, Thursday, Saturday
   - Jam: 08:00 - 16:00

---

## 🧪 Test Credentials

**Patient Login**:
- Email: patient@test.com
- Password: password123

**Doctor Login** (contoh):
- Email: ahmad.fadli@hospital.com
- Password: password123

---

## ❓ Troubleshooting

### Error: "Class 'DoctorSeeder' not found"
```bash
composer dump-autoload
php artisan db:seed --class=DoctorSeeder --force
```

### Error: "Duplicate entry"
Seeder sudah pernah dijalankan, skip saja.

### Cek apakah dokter sudah masuk:
```bash
php artisan tinker
\App\Models\Doctor::all()
exit
```

---

## 🎯 Checklist

- [ ] Buka Railway Console
- [ ] Jalankan `php artisan db:seed --class=DoctorSeeder --force`
- [ ] Tunggu "Doctor seeder completed successfully!"
- [ ] Refresh website production
- [ ] Login dengan patient@test.com / password123
- [ ] Klik "Book Appointment"
- [ ] ✅ Lihat 8 dokter muncul!

---

**Dibuat**: 5 November 2025, 15:40 WIB
**Status**: Database Railway perlu di-seed sekarang
**Estimasi Waktu**: 5 menit

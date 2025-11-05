# Setup Appointment Feature di Production (Railway)

## Masalah
Database di production masih kosong, tidak ada data dokter untuk booking appointment.

## Solusi

### Opsi 1: Menggunakan Railway CLI (Recommended)

1. **Install Railway CLI** (jika belum):
```bash
npm i -g @railway/cli
```

2. **Login ke Railway**:
```bash
railway login
```

3. **Link ke project Anda**:
```bash
railway link
```

4. **Jalankan migrations dan seeders**:
```bash
railway run php artisan migrate --force
railway run php artisan db:seed --class=DoctorSeeder --force
railway run php artisan db:seed --class=PatientTestSeeder --force
```

5. **Clear caches**:
```bash
railway run php artisan config:cache
railway run php artisan route:cache
railway run php artisan view:cache
```

### Opsi 2: Menggunakan Script Otomatis

1. **Deploy file `setup-production.sh` ke Railway**

2. **Di Railway Dashboard**:
   - Buka project Anda
   - Pergi ke tab "Settings" > "Deploy"
   - Tambahkan custom start command atau run di terminal Railway:
```bash
bash setup-production.sh
```

### Opsi 3: Menambahkan di Procfile

Edit file `Procfile` dan tambahkan:
```
release: php artisan migrate --force && php artisan db:seed --class=DoctorSeeder --force && php artisan db:seed --class=PatientTestSeeder --force && php artisan config:cache
web: vendor/bin/heroku-php-apache2 public/
```

### Opsi 4: Manual via Railway Console

1. Buka Railway Dashboard
2. Pilih service Anda
3. Klik tab "Deployments"
4. Klik pada deployment terbaru
5. Klik "View Logs"
6. Klik icon "Console" (terminal icon)
7. Jalankan commands:

```bash
php artisan migrate --force
php artisan db:seed --class=DoctorSeeder --force
php artisan db:seed --class=PatientTestSeeder --force
php artisan config:cache
php artisan route:cache
```

## Verifikasi

Setelah menjalankan seeder, cek apakah data masuk:

```bash
railway run php artisan tinker
```

Kemudian di tinker:
```php
\App\Models\Doctor::count()  // Harus return 8
\App\Models\User::where('role', 'doctor')->count()  // Harus return 8
```

## Data yang Akan Di-seed

### 8 Dokter dengan Spesialisasi:
1. **Dr. Ahmad Fadli** - Kardiologi (Rp 350,000/sesi)
2. **Dr. Citra Dewi** - Dermatologi (Rp 300,000/sesi)
3. **Dr. Budi Santoso** - Dokter Umum (Rp 150,000/sesi)
4. **Dr. Sarah Wijaya** - Pediatri (Rp 250,000/sesi)
5. **Dr. Rudi Hermawan** - Orthopedi (Rp 400,000/sesi)
6. **Dr. Linda Kusuma** - Dokter Gigi (Rp 200,000/sesi)
7. **Dr. Andri Pratama** - Psikiater (Rp 350,000/sesi)
8. **Dr. Maya Sari** - Obstetri & Ginekologi (Rp 300,000/sesi)

**Credentials Dokter**: `[nama.dokter]@hospital.com` / `password123`

### 1 Test Patient Account:
- Email: `patient@test.com`
- Password: `password123`

## Environment Variables

Pastikan di Railway sudah ada:
```
APP_KEY=base64:... (sudah di-generate)
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql (atau sesuai database Railway)
```

## Troubleshooting

### Error: "Class DoctorSeeder not found"
```bash
railway run composer dump-autoload
railway run php artisan db:seed --class=DoctorSeeder --force
```

### Error: "SQLSTATE[42S02]: Base table or field not found"
Jalankan migration dulu:
```bash
railway run php artisan migrate --force
```

### Error: "Integrity constraint violation: Duplicate entry"
Seeder sudah pernah dijalankan. Skip atau reset database:
```bash
railway run php artisan migrate:fresh --force
railway run php artisan db:seed --class=DoctorSeeder --force
```

## Setelah Setup Berhasil

1. Buka website production Anda
2. Login dengan `patient@test.com` / `password123`
3. Klik "Book Appointment" di dashboard
4. Anda akan melihat 8 dokter tersedia
5. Pilih dokter dan buat appointment

## Note Penting

⚠️ **JANGAN** run `migrate:fresh` di production jika sudah ada data penting!
⚠️ Backup database sebelum menjalankan migration/seeder di production
⚠️ Test di local environment dulu sebelum deploy

## Quick Commands Reference

```bash
# Check database connection
railway run php artisan tinker
>>> DB::connection()->getPdo();

# Count doctors
railway run php artisan tinker
>>> \App\Models\Doctor::count();

# List all doctors
railway run php artisan tinker
>>> \App\Models\Doctor::with('user')->get();

# Clear all caches
railway run php artisan optimize:clear

# Optimize for production
railway run php artisan optimize
```

## Alternative: Tambahkan ke build script

Edit `package.json` atau buat file `railway.json`:

```json
{
  "build": {
    "builder": "NIXPACKS"
  },
  "deploy": {
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  }
}
```

Dan di Railway Settings > Deploy:
- Build Command: `composer install --no-dev --optimize-autoloader`
- Start Command: `bash setup-production.sh && php artisan serve --host=0.0.0.0 --port=$PORT`

---

**Last Updated**: November 5, 2025
**Status**: ✅ Ready for Production

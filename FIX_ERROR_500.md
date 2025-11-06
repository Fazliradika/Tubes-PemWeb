# Fix untuk Error 500 - Patient Dashboard

## Masalah yang Diperbaiki:

### 1. **Missing Relationship**
User model tidak memiliki relasi `appointments()`, menyebabkan error saat PatientDashboardController mencoba mengakses `$patient->appointments()`.

**Solusi:** Menambahkan method di `app/Models/User.php`:
```php
public function appointments()
{
    return $this->hasMany(Appointment::class, 'patient_id');
}
```

### 2. **Error Handling**
PatientDashboardController tidak memiliki error handling, sehingga crash jika ada masalah dengan database atau data belum ada.

**Solusi:** Menambahkan try-catch blocks untuk semua query:
```php
try {
    $upcomingAppointments = $patient->appointments()...
} catch (\Exception $e) {
    $upcomingAppointments = collect();
}
```

## Cara Deploy ke Railway:

### Option 1: Push dan Auto-Deploy
```bash
git add .
git commit -m "fix: Patient dashboard error"
git push origin main
```
Railway akan otomatis deploy.

### Option 2: Manual Migration di Railway
Jika Railway sudah deploy tapi masih error, run migration manual:

1. Buka Railway Dashboard
2. Pilih service Anda
3. Buka tab "Deployments"
4. Klik deployment terakhir
5. Klik "View Logs"
6. Atau gunakan Railway CLI:

```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Link project
railway link

# Run migration
railway run php artisan migrate --force

# Clear cache
railway run php artisan config:clear
railway run php artisan cache:clear
```

### Option 3: Gunakan Script Deploy
File `railway-deploy.sh` sudah dibuat untuk memudahkan:

Di Railway, tambahkan di build command:
```
chmod +x railway-deploy.sh && ./railway-deploy.sh
```

## Verification:

Setelah deploy, cek:
1. ✅ Bisa login tanpa error 500
2. ✅ Dashboard patient muncul normal
3. ✅ Tidak ada error di Railway logs
4. ✅ Tabel baru sudah dibuat (prescriptions, conversations, messages, call_sessions)

## Troubleshooting:

Jika masih error 500:

1. **Cek Railway Logs:**
   - Buka Railway Dashboard → Service → Deployments → View Logs
   - Lihat error message spesifik

2. **Cek Database Connection:**
   ```bash
   railway run php artisan tinker
   >>> DB::connection()->getPdo();
   ```

3. **Cek Migration Status:**
   ```bash
   railway run php artisan migrate:status
   ```

4. **Force Run Migration:**
   ```bash
   railway run php artisan migrate --force
   ```

5. **Clear All Caches:**
   ```bash
   railway run php artisan optimize:clear
   ```

## Files Changed:
- ✅ `app/Models/User.php` - Added appointments() relationship
- ✅ `app/Http/Controllers/PatientDashboardController.php` - Added error handling
- ✅ `railway-deploy.sh` - Deployment script

Semua perubahan sudah di-push ke repository!

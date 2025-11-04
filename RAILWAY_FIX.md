# 🚂 Railway Deployment - Quick Fix Guide

## ❌ Problem: "Error saat registrasi"

### 🔍 Penyebab Umum:
1. Database migrations belum dijalankan
2. Environment variables tidak terset dengan benar
3. APP_KEY tidak di-generate
4. Permission storage folder

---

## ✅ Solusi Cepat

### 1️⃣ Pastikan Railway MySQL Sudah Running

Di Railway Dashboard:
- Service MySQL harus status **"Active"** (hijau)
- Cek tab "Variables" ada: MYSQLHOST, MYSQLPORT, MYSQLDATABASE, MYSQLUSER, MYSQLPASSWORD

### 2️⃣ Set Environment Variables di Railway

Di Railway Dashboard → Service "Tubes-PemWeb" → Variables:

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:your-generated-key-here
APP_URL=https://tubes-pemweb-production.up.railway.app

# Database - Railway akan auto-inject ini dari MySQL service
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Locale
APP_TIMEZONE=Asia/Jakarta
APP_LOCALE=id
```

**PENTING:** Generate APP_KEY dulu di local:
```bash
php artisan key:generate --show
```
Copy hasilnya (contoh: `base64:xxxxxxxxxxxxx`) dan paste ke Railway variables.

### 3️⃣ Jalankan Migrations di Railway

**Cara 1: Via Railway Shell (Recommended)**

1. Buka Railway Dashboard → Service → Settings
2. Scroll ke "Custom Start Command"
3. Masukkan command:
   ```bash
   php artisan config:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
   ```
4. Save dan Redeploy

**IMPORTANT:** Seeder TIDAK dijalankan otomatis untuk menghindari duplicate data!

**Cara Manual Run Seeder (ONLY ONCE):**

Jika database kosong dan perlu data dummy, run seeder manual:

**Option A: Via Railway One-time Command**
1. Railway Dashboard → Service → Settings
2. Temporary change start command to:
   ```bash
   php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
   ```
3. Deploy sekali
4. Kembalikan start command ke normal (tanpa db:seed)

**Option B: Via Local ke Railway MySQL**

```bash
# Set Railway MySQL credentials di .env
DB_HOST=containers-us-west-xxx.railway.app
DB_PORT=6789
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=your-railway-password

# Run seeder from local (ONLY ONCE!)
php artisan db:seed --force
```

**NOTE:** Seeder sekarang menggunakan `updateOrCreate` jadi aman untuk dijalankan berulang kali tanpa error duplicate!

### 4️⃣ Verify Database

Akses Railway Shell atau run local script:

```bash
php check-db.php
```

Pastikan semua table ada:
- ✅ users
- ✅ categories
- ✅ products
- ✅ carts
- ✅ cart_items
- ✅ orders
- ✅ order_items
- ✅ payments

---

## 🔧 Railway Configuration Files

### File: `nixpacks.toml` (Auto build config)

```toml
[phases.setup]
nixPkgs = ['php82', 'php82Packages.composer']

[phases.install]
cmds = [
    'composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist'
]

[phases.build]
cmds = [
    'php artisan config:clear',
    'php artisan cache:clear',
]

[start]
cmd = 'php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}'
```

### File: `Procfile` (Fallback)

```
web: php artisan config:clear && php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

---

## 🐛 Common Errors & Solutions

### Error: "SQLSTATE[HY000] [2002] Connection refused"

**Penyebab:** Railway MySQL belum terhubung atau credentials salah

**Solusi:**
1. Cek Railway Dashboard → MySQL service aktif (hijau)
2. Verify environment variables di service
3. Pastikan format: `DB_HOST=${MYSQLHOST}` bukan hardcoded
4. Redeploy service

### Error: "Base table or view not found: 1146 Table 'railway.users' doesn't exist"

**Penyebab:** Migration belum dijalankan

**Solusi:**
```bash
php artisan migrate --force
```

Atau tambahkan di start command:
```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

### Error: "No application encryption key has been specified"

**Penyebab:** APP_KEY tidak ada

**Solusi:**
```bash
# Generate key locally
php artisan key:generate --show

# Copy hasil ke Railway Variables
# Variable: APP_KEY
# Value: base64:xxxxxxxxxxxxxxxxxxxxxxxxxx
```

### Error: "419 Page Expired" saat submit form

**Penyebab:** Session tidak tersimpan karena storage permission atau session driver

**Solusi:**
```env
# Di Railway Variables
SESSION_DRIVER=database
CACHE_STORE=database
```

Lalu:
```bash
php artisan migrate  # Pastikan sessions table ada
```

### Error: "500 Internal Server Error"

**Penyebab:** Multiple reasons

**Solusi:**
1. Set `APP_DEBUG=true` sementara untuk lihat error detail
2. Check Railway Logs:
   - Railway Dashboard → Service → Deployments → View Logs
3. Run:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   ```

---

## 📊 Check Railway Logs

Untuk debug error:

1. Railway Dashboard
2. Click service "Tubes-PemWeb"
3. Tab "Deployments"
4. Click latest deployment
5. Tab "Deploy Logs" atau "View Logs"

Cari error message seperti:
- `SQLSTATE` = Database error
- `Class not found` = Autoload error
- `Permission denied` = File permission error

---

## ✅ Registration Testing Checklist

Setelah fix, test registrasi:

1. ✅ Buka: https://tubes-pemweb-production.up.railway.app/register
2. ✅ Isi form:
   - Name: Test User
   - Email: test@example.com
   - Phone: 081234567890
   - Role: Pasien
   - Password: password
   - Confirm Password: password
3. ✅ Click Register
4. ✅ Harus redirect ke dashboard (tidak error)
5. ✅ Login dengan account yang baru dibuat

---

## 🚀 Quick Deploy Checklist

Sebelum deploy, pastikan:

- [ ] Railway MySQL service running (green)
- [ ] Environment variables set (APP_KEY, DB_*, SESSION_DRIVER)
- [ ] nixpacks.toml atau Procfile exists
- [ ] Start command includes migrations
- [ ] composer.json has all dependencies
- [ ] No syntax errors in code
- [ ] Test locally first with Railway MySQL credentials

---

## 📞 Still Having Issues?

### Debug Commands:

```bash
# Check database connection
php artisan tinker
>>> DB::connection()->getPdo();
>>> DB::table('users')->count();

# Check tables
php check-db.php

# Clear everything
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Re-run migrations
php artisan migrate:fresh --force --seed
```

### Railway Support:
- Discord: https://discord.gg/railway
- Docs: https://docs.railway.app/

---

## 🎯 Expected Result

Setelah semua fix:

✅ Registration form accessible
✅ Can register new user (patient/doctor)
✅ Redirect to appropriate dashboard after registration
✅ Can login with registered account
✅ No 500/419 errors

---

<p align="center">
  <strong>🎉 Registration Should Work Now!</strong><br>
  <em>Happy Deploying! 🚀</em>
</p>

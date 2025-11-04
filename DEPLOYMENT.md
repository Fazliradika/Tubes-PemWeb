# 🚀 Deployment Guide - Railway & Cloud Hosting

Panduan lengkap untuk deploy Healthcare E-Commerce ke Railway (MySQL) dan Cloud Hosting (PHP).

---

## 📋 Prasyarat

1. **Akun Railway** - https://railway.app
2. **Cloud Hosting** dengan PHP 8.2+ (Hostinger, Niagahoster, dll)
3. **Git** installed di local
4. **Composer** installed di local

---

## 🗄️ Step 1: Setup Railway MySQL

### 1.1 Create Railway Project

1. Login ke https://railway.app
2. Click **"New Project"**
3. Select **"Provision MySQL"**
4. Tunggu hingga MySQL instance ready

### 1.2 Copy Database Credentials

Click pada MySQL service, lalu tab **"Variables"**, copy:

```
MYSQLHOST=containers-us-west-xxx.railway.app
MYSQLPORT=6789
MYSQLDATABASE=railway
MYSQLUSER=root
MYSQLPASSWORD=xxxxxxxxxxxxxxxx
```

### 1.3 Test Connection (Optional)

Gunakan MySQL Workbench atau DBeaver untuk test connection dengan credentials di atas.

---

## ☁️ Step 2: Prepare Project for Production

### 2.1 Update .env untuk Production

Buat file `.env` baru di cloud hosting dengan config:

```env
# Application
APP_NAME="Healthcare E-Commerce"
APP_ENV=production
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=false
APP_TIMEZONE=Asia/Jakarta
APP_URL=https://your-domain.com

APP_LOCALE=id
APP_FALLBACK_LOCALE=en

# Database - Railway MySQL
DB_CONNECTION=mysql
DB_HOST=containers-us-west-xxx.railway.app
DB_PORT=6789
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=your_railway_password

# Session & Cache (Use database for production)
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail (Optional - setup later)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@healthcare.com"
MAIL_FROM_NAME="${APP_NAME}"

# Filesystem
FILESYSTEM_DISK=local

# Vite
VITE_APP_NAME="${APP_NAME}"
```

### 2.2 Generate APP_KEY (di local)

```bash
php artisan key:generate --show
```

Copy hasilnya ke `.env` production di bagian `APP_KEY=`

---

## 📦 Step 3: Upload ke Cloud Hosting

### 3.1 File yang Perlu Diupload

Upload **SEMUA FILE** kecuali:
- ❌ `node_modules/`
- ❌ `vendor/` (akan diinstall di server)
- ❌ `.env` (buat manual di server)
- ❌ `.git/` (optional, bisa di-upload)
- ❌ `storage/logs/*.log`

### 3.2 Upload Methods

**Option A: FTP/SFTP** (Recommended)
- Gunakan FileZilla atau WinSCP
- Upload ke folder `public_html` atau sesuai hosting

**Option B: File Manager Hosting**
- Login ke cPanel/hPanel
- Upload via File Manager
- Extract jika upload .zip

**Option C: Git Deploy** (Advanced)
- Setup Git di hosting
- Clone repository
- Setup automatic deployment

---

## 🔧 Step 4: Setup di Cloud Hosting

### 4.1 Via SSH (Jika Tersedia)

```bash
# 1. Masuk ke project directory
cd /home/username/public_html

# 2. Install dependencies
composer install --optimize-autoloader --no-dev

# 3. Create .env file
nano .env
# (Paste config dari Step 2.1, lalu save)

# 4. Run migrations
php artisan migrate --force

# 5. Seed database
php artisan db:seed --force

# 6. Create storage link
php artisan storage:link

# 7. Clear & cache config
php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 8. Set permissions
chmod -R 755 storage bootstrap/cache
```

### 4.2 Via File Manager (Jika Tidak Ada SSH)

1. **Upload semua file** via FTP/File Manager

2. **Buat file `.env`** manual:
   - Klik "New File" → nama: `.env`
   - Edit dan paste config dari Step 2.1

3. **Install dependencies** via Terminal cPanel (jika ada):
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

4. **Set permissions** (File Manager):
   - Klik kanan folder `storage` → Change Permissions → 755
   - Klik kanan folder `bootstrap/cache` → Change Permissions → 755

---

## 🌐 Step 5: Configure Web Server

### 5.1 Set Document Root

**Point domain ke folder `/public`**

Di cPanel/hPanel:
1. Domains → Manage
2. Document Root: `/public_html/public` (atau sesuai path)
3. Save

### 5.2 Setup .htaccess (Auto-created, tapi verify)

File `public/.htaccess` harus ada dan berisi:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### 5.3 PHP Version

Pastikan PHP version di hosting adalah **8.2+**:
- cPanel → MultiPHP Manager
- Select domain → PHP 8.2 atau 8.3

---

## 🗄️ Step 6: Run Database Migrations

### Via SSH:

```bash
php artisan migrate --force
php artisan db:seed --force
```

### Via Tinker (Jika SSH tidak tersedia):

Buat file `migrate.php` di root:

```php
<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->call('migrate', ['--force' => true]);
echo "Migration completed!";
```

Akses: `https://your-domain.com/migrate.php`

**⚠️ HAPUS FILE INI setelah selesai!**

---

## ✅ Step 7: Testing

### 7.1 Basic Tests

1. **Homepage**: https://your-domain.com
   - ✅ Harus bisa akses tanpa error

2. **Login**: https://your-domain.com/login
   - ✅ Form login muncul

3. **Products**: https://your-domain.com/shop/products
   - ✅ List produk muncul (jika sudah seed)

4. **Database Connection**:
   - Login dengan test account (jika sudah seed)

### 7.2 Test Accounts (After Seeder)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@healthcare.com | password |
| Dokter | dokter@healthcare.com | password |
| Pasien | pasien@healthcare.com | password |

### 7.3 Check Logs

Jika ada error, check:
```
storage/logs/laravel.log
```

---

## 🔒 Step 8: Security Checklist

### 8.1 Production Settings

```env
APP_ENV=production
APP_DEBUG=false  # ⚠️ PENTING!
```

### 8.2 File Permissions

```bash
# Folders: 755
chmod -R 755 storage bootstrap/cache

# Files: 644
find . -type f -exec chmod 644 {} \;

# Executable: 755
chmod 755 artisan
```

### 8.3 Hide Sensitive Files

Tambahkan di `.htaccess` root:

```apache
# Deny access to .env
<Files .env>
    Order allow,deny
    Deny from all
</Files>

# Deny access to composer files
<FilesMatch "^(composer\.(json|lock))$">
    Order allow,deny
    Deny from all
</FilesMatch>
```

---

## 🚨 Troubleshooting

### Error: 500 Internal Server Error

**Solusi:**
```bash
# Clear cache
php artisan config:clear
php artisan cache:clear

# Check permissions
chmod -R 755 storage bootstrap/cache

# Check .htaccess
# Pastikan mod_rewrite enabled
```

### Error: Database Connection Failed

**Solusi:**
1. Cek Railway MySQL masih running
2. Verify credentials di `.env`
3. Test connection via MySQL client
4. Pastikan Railway MySQL allow external connections

### Error: Class Not Found

**Solusi:**
```bash
composer dump-autoload --optimize
php artisan config:clear
```

### Error: Storage Permission Denied

**Solusi:**
```bash
chmod -R 755 storage
chown -R www-data:www-data storage  # Linux
# atau
chown -R nobody:nobody storage      # cPanel
```

### Error: 419 Page Expired (CSRF)

**Solusi:**
```bash
php artisan config:clear
php artisan cache:clear

# Pastikan domain di APP_URL benar
APP_URL=https://your-actual-domain.com
```

---

## 🔄 Maintenance & Updates

### Update Code

```bash
# 1. Pull latest code (if using git)
git pull origin main

# 2. Install/update dependencies
composer install --no-dev --optimize-autoloader

# 3. Run migrations
php artisan migrate --force

# 4. Clear & rebuild cache
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Backup Database

**Via Railway Dashboard:**
1. MySQL service → Backups
2. Create snapshot

**Via mysqldump:**
```bash
mysqldump -h containers-us-west-xxx.railway.app \
  -P 6789 \
  -u root \
  -p railway > backup.sql
```

### Monitor Logs

```bash
# Watch live logs
tail -f storage/logs/laravel.log

# Clear old logs
php artisan log:clear
```

---

## 📊 Performance Optimization

### Enable Caching

```bash
# Config cache
php artisan config:cache

# Route cache
php artisan route:cache

# View cache
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

### Database Optimization

```bash
# Index optimization
php artisan db:seed --class=DatabaseIndexOptimizer

# Query optimization
# Enable query log di .env untuk development:
DB_LOG_QUERIES=true
```

### Enable OPcache (php.ini)

```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
opcache.revalidate_freq=60
```

---

## 📞 Support & Resources

- **Railway Docs**: https://docs.railway.app/
- **Laravel Deployment**: https://laravel.com/docs/deployment
- **GitHub Issues**: https://github.com/Fazliradika/Tubes-PemWeb/issues

---

## ✅ Deployment Checklist

Sebelum go-live, pastikan:

- [ ] Railway MySQL created & accessible
- [ ] All files uploaded to hosting
- [ ] `.env` configured with Railway credentials
- [ ] `APP_DEBUG=false` in production
- [ ] Dependencies installed (`composer install`)
- [ ] Migrations run (`php artisan migrate --force`)
- [ ] Seeders run (`php artisan db:seed --force`)
- [ ] Storage linked (`php artisan storage:link`)
- [ ] Permissions set (755 for storage & bootstrap/cache)
- [ ] Cache cleared & rebuilt
- [ ] Document root points to `/public`
- [ ] PHP version is 8.2+
- [ ] Test all main features
- [ ] Test login with seeded accounts
- [ ] SSL certificate installed (HTTPS)
- [ ] Backup plan in place

---

<p align="center">
  <strong>🎉 Ready for Production!</strong><br>
  <em>Good luck with your deployment! 🚀</em>
</p>

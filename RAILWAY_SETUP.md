# 🚀 Railway Deployment Guide

## 📋 Persiapan Selesai!

File-file berikut sudah dibuat untuk deployment Railway:
- ✅ `Procfile` - Command untuk menjalankan Laravel
- ✅ `nixpacks.toml` - Build configuration
- ✅ `railway.json` - Railway configuration
- ✅ `.env.example` - Template environment untuk production

## 🗄️ Database Setup

### Development (Lokal):
- **Database**: SQLite
- **File**: `database/database.sqlite`
- **Status**: ✅ Migrations sudah dijalankan

### Production (Railway):
- **Database**: PostgreSQL (dari Railway)
- **Auto-connect**: Menggunakan environment variables Railway

---

## 🚀 Langkah Deploy ke Railway

### 1. Commit & Push ke GitHub

```bash
git add .
git commit -m "Setup Railway deployment"
git push origin main
```

### 2. Setup di Railway

#### a. Sign Up & Login
1. Buka https://railway.app
2. Klik **"Login"** → Login dengan **GitHub**

#### b. Create New Project
1. Klik **"New Project"**
2. Pilih **"Deploy from GitHub repo"**
3. Pilih repository **"Tubes-PemWeb"**
4. Railway akan auto-detect Laravel! ✅

#### c. Add PostgreSQL Database
1. Di dashboard project, klik **"+ New"**
2. Pilih **"Database"**
3. Pilih **"Add PostgreSQL"**
4. Railway akan auto-create database ✅

#### d. Configure Environment Variables

Railway akan **auto-inject** database variables:
- `PGHOST`
- `PGPORT`
- `PGDATABASE`
- `PGUSER`
- `PGPASSWORD`

**Manual variables yang perlu ditambahkan:**

1. Klik service **Laravel** (web service)
2. Tab **"Variables"**
3. Tambahkan variables berikut:

```env
APP_KEY=base64:FWhOm0in3JBw6g2fe564SdF9+e0PSsDonSrdmnXZNHY=
APP_ENV=production
APP_DEBUG=false
SESSION_DRIVER=database
CACHE_STORE=database
```

**PENTING**: Generate APP_KEY baru untuk production:
```bash
php artisan key:generate --show
# Copy output (contoh: base64:xxxxxxxx)
# Paste ke Railway Variables → APP_KEY
```

#### e. Generate Public Domain
1. Klik service **Laravel**
2. Tab **"Settings"**
3. Scroll ke **"Networking"** → **"Public Networking"**
4. Klik **"Generate Domain"**
5. ✅ Dapat URL: `https://tubes-pemweb-production-xxxx.up.railway.app`

---

## 🔄 Update Code Workflow

Setiap kali update code:

```bash
# 1. Edit code di lokal
# 2. Test dengan SQLite lokal
php artisan serve

# 3. Commit & Push
git add .
git commit -m "Update: [deskripsi perubahan]"
git push origin main

# 4. Railway AUTO-DEPLOY! ✨
# Cek di Railway dashboard untuk status deployment
```

---

## 📊 Railway Free Tier Limits

| Resource | Limit |
|----------|-------|
| Execution Time | $5 credit/month (~500 jam) |
| Database Storage | 5 GB |
| Database Bandwidth | 5 GB/month |
| Projects | Unlimited |

**Cukup untuk project tubes!** 🎉

---

## 🔧 Troubleshooting

### Error: APP_KEY not set
```bash
# Generate key baru
php artisan key:generate --show

# Copy ke Railway Variables → APP_KEY
```

### Error: Database connection
- Pastikan PostgreSQL service sudah dibuat
- Cek apakah variables `PGHOST`, `PGPORT`, dll sudah auto-inject
- Restart deployment

### Error: Migration failed
```bash
# Di Railway Deployment Logs, cek error detail
# Biasanya karena APP_KEY atau database connection
```

### Lihat Logs
1. Railway Dashboard
2. Klik service Laravel
3. Tab **"Deployments"**
4. Klik deployment terbaru
5. **"View Logs"**

---

## 🎯 Checklist Deployment

- [x] File configuration sudah dibuat (Procfile, nixpacks.toml, dll)
- [x] Database SQLite lokal sudah setup
- [x] Migrations sudah dijalankan lokal
- [ ] Push code ke GitHub
- [ ] Sign up Railway dengan GitHub
- [ ] Deploy Laravel dari GitHub
- [ ] Add PostgreSQL database
- [ ] Configure environment variables
- [ ] Generate APP_KEY baru untuk production
- [ ] Generate public domain
- [ ] Test aplikasi di URL production

---

## 💡 Tips

### Akses Database Railway (Opsional)
Untuk inspect database production:

1. Klik **PostgreSQL service** di Railway
2. Tab **"Connect"**
3. Copy connection string
4. Gunakan tool seperti **TablePlus**, **DBeaver**, atau **pgAdmin**

### Custom Domain (Opsional)
Jika punya domain sendiri:
1. Railway → Settings → Custom Domains
2. Add domain
3. Update DNS records di domain provider

### Environment-based Config
Code sudah disetup untuk auto-switch:
- **Local**: SQLite
- **Production**: PostgreSQL (auto dari Railway variables)

---

## 🎓 Resources

- Railway Docs: https://docs.railway.app
- Laravel Deployment: https://laravel.com/docs/deployment
- GitHub Student Pack: https://education.github.com/pack

---

**Happy Coding! 🚀**

# 🏥 Health First Medical

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind-4.1-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-9.5.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

**Sistem Manajemen Klinik & E-Commerce Kesehatan Modern**

[Demo Live](https://tubes-pemweb-production.up.railway.app) · [Dokumentasi](#-instalasi) · [Kontribusi](#-tim-pengembang)

</div>

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 🔐 **Multi-Role Auth** | Sistem login untuk Admin, Dokter, dan Pasien |
| 📅 **Appointment** | Buat janji temu dengan dokter pilihan |
| 💊 **Resep Digital** | Dokter membuat resep, pasien akses online |
| 💬 **Chat Konsultasi** | Komunikasi real-time dokter-pasien |
| 🤖 **AI Health Assistant** | Asisten kesehatan AI (Groq LLaMA 3.3) |
| 🛒 **E-Commerce** | Toko obat & produk kesehatan online |
| 📊 **Dashboard Analytics** | Statistik & laporan untuk setiap role |

---

## 🚀 Quick Start

### Prasyarat
- PHP >= 8.2 & Composer
- MySQL 8.0+
- Node.js & NPM

### Instalasi

```bash
# 1. Clone & masuk direktori
git clone https://github.com/Fazliradika/Tubes-PemWeb.git
cd Tubes-PemWeb

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
# DB_DATABASE=healthcare_db
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Migrasi & seed data
php artisan migrate:fresh --seed
php artisan storage:link

# 6. Jalankan server
php artisan serve
npm run dev
```

Akses: **http://localhost:8000**

---

## 👤 Akun Demo

| Role | Email | Password |
|------|-------|----------|
| 👨‍💼 Admin | `admin@healthfirst.com` | `password` |
| 👨‍⚕️ Dokter | `doctor@healthfirst.com` | `password123` |
| 👤 Pasien | `patient@test.com` | `password123` |

> ⚠️ **Catatan:** Hanya pasien yang dapat registrasi mandiri. Akun dokter dibuat oleh admin.

---

## 🛠️ Tech Stack

```
Backend     : Laravel 12.x, PHP 8.4
Frontend    : Blade, Tailwind CSS, Alpine.js
Database    : MySQL 8.0
AI          : Groq API (LLaMA 3.3 70B)
Deployment  : Railway
```

---

## 📁 Struktur Proyek

```
├── app/
│   ├── Http/Controllers/    # Logic aplikasi
│   └── Models/              # Model database
├── database/
│   ├── migrations/          # Skema database
│   └── seeders/             # Data awal
├── resources/views/         # Template Blade
├── routes/web.php           # Routing
└── public/                  # Assets publik
```

---

## ☁️ Deployment (Railway)

1. Push ke GitHub
2. Connect repo di [Railway](https://railway.app)
3. Add MySQL service
4. Set environment variables:
   ```
   APP_ENV=production
   APP_DEBUG=false
   GROQ_API_KEY=your_key
   ```
5. Deploy! 🚀

---

## 👥 Tim Pengembang

**Kelompok Serigala Putih**

| Nama | NIM | Peran |
|------|-----|-------|
| Muhammad Rafadi Kurniawan | 103062300089 | E-Commerce & Product Management |
| Naufal Saifullah Yusuf | 103062300091 | Admin Panel & Settings |
| Fazli Radika | 103062300092 | Authentication & User Management |
| Muhammad Afriza Hidayat | 103062300093 | AI Health Assistant & Chat |
| Aldyansyah Wisnu Saputra | 103062300100 | Dashboard & Analytics |

---

## 📄 Lisensi

Proyek ini dibuat untuk **Tugas Besar Pemrograman Web** - Universitas Telkom.

---

<div align="center">

Made with ❤️ by **Kelompok Serigala Putih**

</div>

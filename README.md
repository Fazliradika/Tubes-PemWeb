# 🏥 Healthcare E-Commerce Platform# 🐺 Tugas Besar Pemrograman Web - Kelompok Serigala Putih



Sistem E-Commerce untuk produk kesehatan yang dibangun dengan Laravel 12.![Laravel](https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel)

![PHP](https://img.shields.io/badge/PHP-8.4-blue?style=for-the-badge&logo=php)

![Laravel](https://img.shields.io/badge/Laravel-12.x-red?style=flat-square&logo=laravel)![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)

![PHP](https://img.shields.io/badge/PHP-8.2+-blue?style=flat-square&logo=php)

![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?style=flat-square&logo=mysql)---



---## 📖 Tentang Proyek



## 🎯 Fitur UtamaIni adalah proyek Tugas Besar Pemrograman Web yang dikerjakan oleh **Kelompok Serigala Putih**. Proyek ini menggunakan Laravel Framework dengan berbagai fitur modern untuk membangun aplikasi web yang lengkap.



### 🔐 Autentikasi & Manajemen User---

- Login & Register dengan role (Admin/Dokter/Pasien)

- Profile management dengan upload foto## ✨ Fitur Utama

- Role-based access control

- Password management- 🔐 **Authentication & User Management** - Sistem login, register, dan manajemen user

- 🛒 **E-Commerce System** - Katalog produk, shopping cart, dan checkout

### 🛒 E-Commerce- 📊 **Dashboard & Analytics** - Visualisasi data dan laporan

- Katalog produk kesehatan (18 produk dalam 5 kategori)- 📝 **Content Management System** - Manajemen artikel dan konten

- Shopping cart untuk guest dan user- ⚙️ **Admin Panel** - Panel administrasi lengkap

- Search & filter produk- 📱 **Responsive Design** - Tampilan yang optimal di semua perangkat

- Checkout process lengkap

- Order tracking dengan 5 status---

- Payment simulation (Bank Transfer, E-wallet, COD)

## 🛠️ Teknologi yang Digunakan

### 📊 Dashboard Multi-Role

- **Admin**: Kelola orders, users, dan reports- **Backend**: Laravel 12.x

- **Dokter**: Dashboard khusus dokter- **Frontend**: Blade Templates, Tailwind CSS

- **Pasien**: Dashboard khusus pasien- **Database**: MySQL/PostgreSQL (sesuai konfigurasi)

- **Icons**: Font Awesome

### 📦 Kategori Produk- **Version Control**: Git

1. Vitamin & Suplemen

2. Obat-obatan---

3. Alat Kesehatan

4. Perawatan Tubuh## 📋 Prasyarat

5. Herbal & Tradisional

Sebelum memulai, pastikan Anda telah menginstall:

---

- PHP >= 8.4

## 🚀 Quick Start (Development)- Composer

- MySQL atau PostgreSQL

### Prasyarat- Node.js & NPM (optional, untuk asset compilation)

- PHP >= 8.2- Git

- Composer

- MySQL 8.0+---

- Node.js & NPM (optional)

## 🚀 Instalasi & Setup

### Instalasi

### 1. Clone Repository

1. **Clone Repository**

   ```bash```bash

   git clone https://github.com/Fazliradika/Tubes-PemWeb.gitcd /home/fara/Documents

   cd Tubes-PemWebgit clone [URL_REPOSITORY]

   ```cd "Tugas Besar Pemrograman Web Kelompokk Serigala Putih"

```

2. **Install Dependencies**

   ```bash### 2. Install Dependencies

   composer install

   npm install```bash

   ```composer install

```

3. **Setup Environment**

   ```bash### 3. Setup Environment

   cp .env.example .env

   php artisan key:generate```bash

   ```cp .env.example .env

php artisan key:generate

4. **Konfigurasi Database**```

   

   Edit file `.env`:### 4. Konfigurasi Database

   ```env

   DB_CONNECTION=mysqlEdit file `.env` dan sesuaikan dengan konfigurasi database Anda:

   DB_HOST=127.0.0.1

   DB_PORT=3306```env

   DB_DATABASE=healthcare_dbDB_CONNECTION=mysql

   DB_USERNAME=rootDB_HOST=127.0.0.1

   DB_PASSWORD=your_passwordDB_PORT=3306

   ```DB_DATABASE=nama_database

DB_USERNAME=username

5. **Migrasi & Seeder**DB_PASSWORD=password

   ```bash```

   php artisan migrate

   php artisan db:seed### 5. Migrasi Database

   php artisan storage:link

   ``````bash

php artisan migrate

6. **Build Assets (Optional)**```

   ```bash

   npm run build### 6. (Optional) Seeding Data

   ```

```bash

7. **Jalankan Server**php artisan db:seed

   ```bash```

   php artisan serve

   ```### 7. Jalankan Server



Akses: **http://localhost:8000**```bash

php artisan serve

---```



## ☁️ Deployment ke Cloud HostingAkses aplikasi di: **http://localhost:8000**



### Railway MySQL Configuration---



1. **Create Railway MySQL Database**## 📁 Struktur Proyek

   - Login ke Railway.app

   - Create new project → Add MySQL```

   - Copy database credentials├── app/

│   ├── Http/

2. **Update `.env` untuk Production**│   │   └── Controllers/     # Controllers

   ```env│   └── Models/              # Models

   APP_ENV=production├── database/

   APP_DEBUG=false│   ├── migrations/          # Database migrations

   APP_URL=https://your-domain.com│   └── seeders/             # Database seeders

   ├── public/                  # Public assets

   DB_CONNECTION=mysql├── resources/

   DB_HOST=containers-us-west-xxx.railway.app│   └── views/               # Blade templates

   DB_PORT=6789│       ├── layouts/         # Layout files

   DB_DATABASE=railway│       └── home.blade.php   # Homepage

   DB_USERNAME=root├── routes/

   DB_PASSWORD=your_railway_password│   └── web.php              # Web routes

   ├── PEMBAGIAN_TUGAS.md       # Dokumentasi pembagian tugas

   SESSION_DRIVER=database└── README.md                # Dokumentasi ini

   QUEUE_CONNECTION=database```

   ```

---

3. **Upload ke Cloud Hosting**

   ## 👥 Tim Pengembang

   Upload semua file kecuali:

   - `node_modules/`### Kelompok Serigala Putih

   - `.env` (buat baru di server)

   - `storage/` (set permission 755)1. **Anggota 1** - Authentication & User Management

2. **Anggota 2** - E-Commerce & Product Management

4. **Setup di Server**3. **Anggota 3** - Dashboard & Analytics

   ```bash4. **Anggota 4** - Content Management System

   composer install --optimize-autoloader --no-dev5. **Anggota 5** - Admin Panel & Settings

   php artisan migrate --force

   php artisan db:seed --force> 📝 Lihat detail pembagian tugas di [PEMBAGIAN_TUGAS.md](PEMBAGIAN_TUGAS.md)

   php artisan storage:link

   php artisan config:cache---

   php artisan route:cache

   php artisan view:cache## 🔄 Workflow Git

   ```

### Membuat Feature Branch

5. **Set Permissions**

   ```bash```bash

   chmod -R 755 storage bootstrap/cachegit checkout -b feature/nama-fitur

   chown -R www-data:www-data storage bootstrap/cache```

   ```

### Commit Changes

---

```bash

## 👤 Test Accountsgit add .

git commit -m "feat: deskripsi perubahan"

Setelah menjalankan seeder:```



| Role | Email | Password |### Push ke Remote

|------|-------|----------|

| Admin | admin@healthcare.com | password |```bash

| Dokter | dokter@healthcare.com | password |git push origin feature/nama-fitur

| Pasien | pasien@healthcare.com | password |```



---### Merge ke Main

1. Buat Pull Request

## 📁 Struktur Proyek2. Request review dari tim

3. Merge setelah approved

```

Tubes-PemWeb/---

├── app/

│   ├── Http/## 📝 Perintah Artisan yang Berguna

│   │   ├── Controllers/     # Controllers (Auth, Product, Cart, Order, etc.)

│   │   └── Middleware/      # RoleMiddleware```bash

│   └── Models/              # Models (User, Product, Cart, Order, etc.)# Membuat Controller

├── database/php artisan make:controller NamaController

│   ├── migrations/          # Database migrations

│   └── seeders/             # Seeders (Admin, Products, etc.)# Membuat Model dengan Migration

├── public/                  # Public assetsphp artisan make:model NamaModel -m

├── resources/

│   └── views/               # Blade templates# Menjalankan Migration

├── routes/php artisan migrate

│   ├── web.php              # Web routes

│   └── auth.php             # Auth routes# Rollback Migration

└── storage/                 # File storagephp artisan migrate:rollback

```

# Clear Cache

---php artisan cache:clear

php artisan config:clear

## 🔧 Commands Pentingphp artisan view:clear



```bash# Membuat Seeder

# Developmentphp artisan make:seeder NamaSeeder

php artisan serve               # Jalankan server lokal

php artisan migrate            # Jalankan migrations# Menjalankan Seeder

php artisan db:seed            # Isi data dummyphp artisan db:seed

php artisan storage:link       # Link storage untuk uploads```



# Caching (Production)---

php artisan config:cache       # Cache config

php artisan route:cache        # Cache routes## 🐛 Troubleshooting

php artisan view:cache         # Cache views

### Error: "Class not found"

# Clear Cache```bash

php artisan config:clearcomposer dump-autoload

php artisan route:clear```

php artisan view:clear

php artisan cache:clear### Error: Migration

```bash

# Maintenancephp artisan migrate:fresh

php artisan down               # Maintenance mode```

php artisan up                 # Normal mode

```### Error: Permission Denied (Storage)

```bash

---chmod -R 775 storage bootstrap/cache

```

## 🛣️ Routes Penting

---

### Public Routes

- `/` - Homepage## 📚 Resources

- `/shop/products` - Katalog produk

- `/shop/products/{slug}` - Detail produk- [Laravel Documentation](https://laravel.com/docs)

- `/shop/cart` - Shopping cart- [Tailwind CSS Documentation](https://tailwindcss.com/docs)

- [PHP Documentation](https://www.php.net/docs.php)

### Authenticated Routes- [Git Documentation](https://git-scm.com/doc)

- `/dashboard` - Dashboard (redirect by role)

- `/shop/checkout` - Checkout---

- `/orders` - Riwayat pesanan

- `/profile` - Profile management## 📄 License



### Admin RoutesThis project is created for educational purposes as part of Web Programming course assignment.

- `/admin/dashboard` - Admin dashboard

- `/admin/orders` - Kelola pesanan---

- `/reports/sales` - Sales report

- `/reports/users` - Users report## 📞 Contact



---Untuk pertanyaan atau bantuan, hubungi:

- **Repository**: [Link Repository]

## 🔒 Security- **Group Chat**: [Link Group Chat]



- ✅ CSRF Protection---

- ✅ SQL Injection Prevention

- ✅ Password Hashing (bcrypt)<p align="center">

- ✅ Role-based Authorization  <strong>Made with ❤️ by Kelompok Serigala Putih 🐺</strong>

- ✅ XSS Protection</p>

- ✅ Input Validation



---Laravel is accessible, powerful, and provides tools required for large, robust applications.



## 📊 Database Schema## Learning Laravel



### Main TablesLaravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

- `users` - User accounts dengan role

- `categories` - Kategori produkYou may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

- `products` - Produk kesehatan

- `carts` - Shopping cartsIf you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

- `cart_items` - Cart items

- `orders` - Customer orders## Laravel Sponsors

- `order_items` - Order details

- `payments` - Payment recordsWe would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).



---### Premium Partners



## 🐛 Troubleshooting- **[Vehikl](https://vehikl.com)**

- **[Tighten Co.](https://tighten.co)**

### Error: "Class not found"- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**

```bash- **[64 Robots](https://64robots.com)**

composer dump-autoload- **[Curotec](https://www.curotec.com/services/technologies/laravel)**

```- **[DevSquad](https://devsquad.com/hire-laravel-developers)**

- **[Redberry](https://redberry.international/laravel-development)**

### Error: Storage permission denied- **[Active Logic](https://activelogic.com)**

```bash

chmod -R 755 storage bootstrap/cache## Contributing

```

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

### Error: Database connection

- Pastikan MySQL running## Code of Conduct

- Cek credentials di `.env`

- Test connection: `php artisan migrate:status`In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).



### Error: 500 Internal Server Error (Production)## Security Vulnerabilities

```bash

php artisan config:clearIf you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

php artisan cache:clear

chmod -R 755 storage## License

```

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 📈 Development Roadmap

### ✅ Completed
- Authentication & User Management
- E-Commerce (Products, Cart, Checkout)
- Order Management
- Payment Simulation
- Dashboard Multi-Role
- 18 Products with 5 Categories

### 🔄 Future Enhancements
- Real Payment Gateway Integration (Midtrans/Xendit)
- Email Notifications
- Product Reviews & Ratings
- Wishlist Feature
- Discount/Promo Codes
- Export Reports (PDF/Excel)
- Advanced Analytics

---

## 📞 Support

- **Repository**: [Tubes-PemWeb](https://github.com/Fazliradika/Tubes-PemWeb)
- **Issues**: [Report Bug](https://github.com/Fazliradika/Tubes-PemWeb/issues)

---

## 📄 License

This project is for educational purposes.

---

<p align="center">
  <strong>Made with ❤️ for Healthcare</strong><br>
  <em>Kelompok Serigala Putih 🐺</em>
</p>

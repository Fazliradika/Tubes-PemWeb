# 🎯 E-Commerce - Command Reference

Daftar lengkap command yang dibutuhkan untuk setup dan maintenance E-Commerce system.

## 🚀 Setup Awal (Wajib Dijalankan)

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup
```bash
# Edit .env untuk database credentials
php artisan migrate
```

### 4. Seed Data
```bash
# Seed semua data (users + products)
php artisan db:seed

# Atau seed products saja
php artisan db:seed --class=ProductSeeder
```

### 5. Storage Link
```bash
php artisan storage:link
```

### 6. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Start Server
```bash
php artisan serve
```

## 🗄️ Database Commands

### Migration Commands
```bash
# Jalankan migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Rollback semua migrations
php artisan migrate:reset

# Fresh migration (reset + migrate)
php artisan migrate:fresh

# Fresh + seed
php artisan migrate:fresh --seed
```

### Seeder Commands
```bash
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=ProductSeeder

# Fresh migrate + seed (HATI-HATI: hapus semua data!)
php artisan migrate:fresh --seed
```

### Tinker (Database Console)
```bash
php artisan tinker
```

Contoh query di Tinker:
```php
// Lihat semua produk
Product::all();

// Lihat produk by ID
Product::find(1);

// Lihat semua kategori
Category::all();

// Lihat orders
Order::with('orderItems')->get();

// Lihat cart
Cart::with('cartItems.product')->get();
```

## 🔧 Maintenance Commands

### Cache Commands
```bash
# Clear all cache
php artisan cache:clear

# Clear config cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Clear compiled classes
php artisan clear-compiled

# Optimize (cache config, routes, views)
php artisan optimize
```

### Application Commands
```bash
# Check application status
php artisan about

# List all routes
php artisan route:list

# List all routes for e-commerce
php artisan route:list --name=products
php artisan route:list --name=cart
php artisan route:list --name=orders

# Show config
php artisan config:show database
php artisan config:show app
```

## 🧪 Testing & Debug Commands

### Tinker Quick Tests
```bash
php artisan tinker
```

Test Examples:
```php
// Test Product creation
$product = \App\Models\Product::create([
    'category_id' => 1,
    'name' => 'Test Product',
    'slug' => 'test-product',
    'description' => 'Test description',
    'price' => 50000,
    'stock' => 10,
    'is_active' => true
]);

// Test Order creation
$order = \App\Models\Order::create([
    'user_id' => 1,
    'order_number' => \App\Models\Order::generateOrderNumber(),
    'total_amount' => 100000,
    'status' => 'pending',
    'shipping_address' => 'Test Address',
    'shipping_city' => 'Jakarta',
    'shipping_postal_code' => '12345',
    'shipping_phone' => '08123456789'
]);

// Test relationships
$product = \App\Models\Product::with('category')->first();
$order = \App\Models\Order::with(['orderItems', 'payment'])->first();
$cart = \App\Models\Cart::with('cartItems.product')->first();
```

### Queue Commands (jika digunakan)
```bash
# Start queue worker
php artisan queue:work

# Start queue with retry
php artisan queue:work --tries=3

# Clear failed jobs
php artisan queue:clear
```

## 📦 Data Management Commands

### Export/Import Data
```bash
# Export database ke SQL
mysqldump -u username -p database_name > backup.sql

# Import database dari SQL
mysql -u username -p database_name < backup.sql
```

### Manual Product Creation via Tinker
```bash
php artisan tinker
```

```php
// Create category first
$category = \App\Models\Category::create([
    'name' => 'Kategori Baru',
    'slug' => 'kategori-baru',
    'description' => 'Deskripsi kategori'
]);

// Create product
\App\Models\Product::create([
    'category_id' => $category->id,
    'name' => 'Produk Baru',
    'slug' => 'produk-baru',
    'description' => 'Deskripsi produk lengkap',
    'price' => 75000,
    'stock' => 100,
    'is_active' => true
]);
```

## 🔐 User Management Commands

### Create Admin User via Tinker
```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name' => 'New Admin',
    'email' => 'newadmin@example.com',
    'password' => bcrypt('password123'),
    'role' => 'admin',
    'phone' => '08123456789',
    'address' => 'Admin Address'
]);
```

### Password Reset
```bash
php artisan tinker
```

```php
$user = \App\Models\User::where('email', 'user@example.com')->first();
$user->password = bcrypt('newpassword');
$user->save();
```

## 🚀 Production Commands

### Production Deployment
```bash
# 1. Pull latest code
git pull origin main

# 2. Install dependencies
composer install --no-dev --optimize-autoloader
npm install --production
npm run build

# 3. Run migrations
php artisan migrate --force

# 4. Clear & cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# 5. Set permissions
chmod -R 775 storage bootstrap/cache
```

### Laravel Optimization
```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer dump-autoload -o

# Full optimization
php artisan optimize
```

## 🐛 Debugging Commands

### Check Logs
```bash
# View Laravel logs
tail -f storage/logs/laravel.log

# Clear logs
> storage/logs/laravel.log
```

### Debug Mode
Edit `.env`:
```
APP_DEBUG=true
```

### Database Connection Test
```bash
php artisan tinker
```
```php
DB::connection()->getPdo();
```

### Check Laravel Installation
```bash
php artisan about
php -v
composer -V
npm -v
```

## 📊 Reporting Commands

### Get Statistics via Tinker
```bash
php artisan tinker
```

```php
// Total products
\App\Models\Product::count();

// Total orders
\App\Models\Order::count();

// Total revenue
\App\Models\Order::where('status', 'delivered')->sum('total_amount');

// Orders by status
\App\Models\Order::where('status', 'pending')->count();

// Products by category
\App\Models\Product::where('category_id', 1)->count();

// Low stock products
\App\Models\Product::where('stock', '<', 10)->get();
```

## 🔄 Git Commands (Bonus)

### Basic Git Workflow
```bash
# Check status
git status

# Add files
git add .

# Commit
git commit -m "Add e-commerce features"

# Push to remote
git push origin main

# Pull updates
git pull origin main

# Create branch
git checkout -b feature/new-feature

# Merge branch
git checkout main
git merge feature/new-feature
```

## ⚡ Quick Commands Reference

### Must-Run Commands (Setup)
```bash
composer install
php artisan migrate
php artisan db:seed
php artisan storage:link
npm install && npm run build
php artisan serve
```

### Daily Development
```bash
php artisan serve              # Start server
php artisan migrate            # Run new migrations
php artisan db:seed            # Seed data
php artisan cache:clear        # Clear cache
php artisan tinker             # Database console
```

### Common Issues Fix
```bash
# Route not found
php artisan route:clear
php artisan cache:clear

# View not updating
php artisan view:clear

# Config not updating
php artisan config:clear

# Class not found
composer dump-autoload

# Permission errors
chmod -R 775 storage bootstrap/cache
```

## 📝 Notes

### Environment Variables
Key `.env` variables untuk e-commerce:
```
APP_NAME="Healthcare E-Commerce"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
# Email config untuk notifications (optional)
```

### Important Paths
- Logs: `storage/logs/laravel.log`
- Uploaded files: `storage/app/public/`
- Public assets: `public/`
- Views: `resources/views/`
- Controllers: `app/Http/Controllers/`
- Models: `app/Models/`
- Migrations: `database/migrations/`
- Seeders: `database/seeders/`

---

**💡 Pro Tips:**

1. Always backup database before running migrations in production
2. Use `php artisan tinker` for quick testing
3. Check logs when something goes wrong
4. Run `composer dump-autoload` if class not found
5. Use `--force` flag for production migrations
6. Cache routes and config in production for performance

**Happy Coding! 🚀**

# 🏥 Healthcare E-Commerce System

Sistem manajemen kesehatan berbasis web dengan fitur E-Commerce lengkap untuk penjualan produk kesehatan.

## 🚀 Fitur Utama

### 👥 User Management
- Multi-role system (Admin, Doctor, Patient)
- Authentication & Authorization
- Profile management dengan foto
- Role-based dashboard

### 🛒 E-Commerce System (BARU!)

#### 📦 Katalog Produk
- List produk dengan pagination
- Detail produk dengan gambar
- Search & filter by category
- Sort by price, name, latest
- 5 kategori produk kesehatan
- 18 produk dummy ready to use

#### 🛍️ Shopping Cart
- Add to cart (guest & authenticated users)
- Update quantity
- Remove items
- Clear cart
- Real-time price calculation
- Persistent cart for logged-in users

#### 💳 Checkout & Payment
- Shipping information form
- Multiple payment methods:
  - Bank Transfer (BCA, BNI, Mandiri, BRI)
  - Credit/Debit Card
  - E-Wallet (GoPay, OVO, Dana, ShopeePay)
- Payment simulation
- Order notes
- Stock validation

#### 📋 Order Management
**For Customers:**
- Order history with pagination
- Order detail with tracking
- Status timeline (Pending → Processing → Shipped → Delivered)
- Payment confirmation
- Shipping information

**For Admins:**
- Complete order dashboard
- Filter by status
- Update order status
- View customer information
- Order details

## 🗄️ Database Schema

### E-Commerce Tables:
- **categories** - Product categories
- **products** - Healthcare products
- **carts** - Shopping carts
- **cart_items** - Cart items
- **orders** - Customer orders
- **order_items** - Order details
- **payments** - Payment information

## 📦 Produk Kesehatan

### Kategori:
1. **Vitamin & Suplemen** (4 produk)
   - Vitamin C, Multivitamin, Omega 3, Vitamin D3

2. **Obat-obatan** (3 produk)
   - Paracetamol, Obat Batuk, Antasida

3. **Alat Kesehatan** (4 produk)
   - Termometer, Tensimeter, Masker Medis, Hand Sanitizer

4. **Perawatan Tubuh** (3 produk)
   - Sabun Antiseptik, Lotion, Sunscreen

5. **Herbal & Tradisional** (4 produk)
   - Madu Murni, Jahe Merah, Habbatussauda Oil, Curcuma

## 🚀 Installation

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & NPM

### Setup Steps

1. **Clone repository**
```bash
git clone <repository-url>
cd Tubes-PemWeb
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**
Edit `.env` file:
```
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations**
```bash
php artisan migrate
```

6. **Run seeders**
```bash
php artisan db:seed
```

7. **Link storage**
```bash
php artisan storage:link
```

8. **Build assets**
```bash
npm run build
```

9. **Start server**
```bash
php artisan serve
```

Visit: http://localhost:8000

## 👤 Default Accounts

After seeding, use these accounts:

### Admin
- Email: admin@healthcare.com
- Password: password123

### Doctor
- Email: doctor@healthcare.com
- Password: password123

### Patient
- Email: patient@healthcare.com
- Password: password123

## 📍 Important URLs

### Public
- Home: `/`
- Products: `/shop/products`
- Cart: `/shop/cart`

### Authenticated
- Dashboard: `/dashboard`
- Checkout: `/shop/checkout`
- My Orders: `/orders`
- Profile: `/profile`

### Admin
- Admin Dashboard: `/admin/dashboard`
- Manage Orders: `/admin/orders`

## 🎯 Testing Flow

### As Customer:
1. Browse products at `/shop/products`
2. Add items to cart
3. View cart at `/shop/cart`
4. Login/Register
5. Checkout at `/shop/checkout`
6. Fill shipping info & select payment
7. Confirm order
8. Simulate payment confirmation
9. View order at `/orders`

### As Admin:
1. Login as admin
2. Go to `/admin/orders`
3. View all orders
4. Update order status
5. Filter by status

## 🛠️ Tech Stack

- **Framework**: Laravel 11
- **Frontend**: Blade Templates, TailwindCSS
- **Database**: MySQL/MariaDB
- **Icons**: Font Awesome
- **Authentication**: Laravel Breeze

## 📚 Documentation

- [E-Commerce Full Documentation](E_COMMERCE_DOCUMENTATION.md)
- [Quick Start Guide](E_COMMERCE_QUICK_START.md)
- [Implementation Summary](E_COMMERCE_SUMMARY.md)

## 🎨 Features Highlights

### ✅ Implemented:
- [x] Multi-role authentication
- [x] Product catalog with search & filter
- [x] Shopping cart (guest & user)
- [x] Checkout process
- [x] Order management
- [x] Payment simulation
- [x] Admin order dashboard
- [x] Status tracking
- [x] Responsive design
- [x] Stock management
- [x] 18 dummy products

### 🔄 Can Be Extended:
- [ ] Real payment gateway integration
- [ ] Email notifications
- [ ] Product reviews & ratings
- [ ] Wishlist functionality
- [ ] Discount codes & promotions
- [ ] Advanced reporting
- [ ] Product image uploads
- [ ] Multi-language support

## 🤝 Contributing

This is a university project (Tubes PemWeb). Feel free to fork and enhance!

## 📝 License

This project is for educational purposes.

## 👨‍💻 Team

[Your team information here]

## 📞 Support

For questions or issues, check the documentation files or contact the development team.

---

**Made with ❤️ for Tubes PemWeb**

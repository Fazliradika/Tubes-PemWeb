# 🔒 Security Policy / Kebijakan Keamanan

## Pelaporan Kerentanan Keamanan

Jika Anda menemukan kerentanan keamanan dalam aplikasi ini, mohon laporkan melalui:
- Email: fazliradika30april@gmail.com
- Atau buat private security advisory di GitHub

**JANGAN** membuat issue publik untuk kerentanan keamanan yang serius.

## Best Practices untuk Deployment

### 1. Environment Variables (.env)

**WAJIB dilakukan:**
- ✅ **JANGAN PERNAH** commit file `.env` ke repository
- ✅ Gunakan `.env.example` sebagai template
- ✅ Ganti semua nilai default di production
- ✅ Set `APP_DEBUG=false` di production
- ✅ Set `APP_ENV=production` di production

### 2. Credentials & API Keys

**Untuk API Keys (Groq AI, AWS, dll):**
- ✅ Simpan di environment variables, BUKAN di code
- ✅ Gunakan service seperti Railway Secrets, AWS Secrets Manager, atau HashiCorp Vault
- ✅ Rotate API keys secara berkala
- ✅ Gunakan API keys yang berbeda untuk dev/staging/production
- ❌ JANGAN hardcode API keys di code
- ❌ JANGAN commit API keys ke git
- ❌ JANGAN share API keys via email/chat

**Untuk Database Credentials:**
- ✅ Gunakan password yang kuat (min 16 karakter, kombinasi huruf/angka/simbol)
- ✅ Batasi akses database hanya dari IP aplikasi
- ✅ Gunakan SSL/TLS untuk koneksi database
- ❌ JANGAN gunakan password default seperti "root", "password", "123456"

### 3. Akun Default

**WAJIB dilakukan setelah deployment:**
- ✅ Login dengan akun admin default
- ✅ Ganti password admin default SEGERA
- ✅ Ganti email admin jika perlu
- ✅ Hapus atau disable akun demo yang tidak digunakan
- ✅ Buat akun admin baru dengan credentials yang kuat
- ❌ JANGAN biarkan akun dengan password "password" atau "password123"

### 4. Konfigurasi Aplikasi

**Production checklist:**
```bash
# .env file untuk production
APP_ENV=production
APP_DEBUG=false
APP_KEY=[generate dengan: php artisan key:generate]

# Database
DB_PASSWORD=[gunakan password yang sangat kuat]

# Groq AI
GROQ_API_KEY=[API key dari https://console.groq.com/]
```

### 5. Server Security

**Recommended:**
- ✅ Gunakan HTTPS (SSL/TLS certificate)
- ✅ Set proper file permissions (755 untuk direktori, 644 untuk file)
- ✅ Disable directory listing di web server
- ✅ Update dependencies secara berkala: `composer update` dan `npm update`
- ✅ Monitor logs untuk aktivitas mencurigakan
- ✅ Implementasi rate limiting untuk API
- ✅ Gunakan firewall dan security groups

### 6. Backup & Recovery

**Best practices:**
- ✅ Backup database secara rutin (harian/mingguan)
- ✅ Backup file uploads dan storage
- ✅ Test restore process secara berkala
- ✅ Simpan backup di lokasi terpisah (offsite)
- ✅ Enkripsi backup yang berisi data sensitif

## Dependency Security

### Memeriksa Kerentanan

```bash
# Check PHP dependencies
composer audit

# Check Node.js dependencies
npm audit

# Fix vulnerabilities
composer update
npm audit fix
```

### Update Dependencies

```bash
# Update semua dependencies
composer update
npm update

# Update specific package
composer update vendor/package
npm update package-name
```

## Common Vulnerabilities yang Dihindari

### ✅ SQL Injection
- Aplikasi ini menggunakan Laravel Eloquent ORM yang secara otomatis melindungi dari SQL injection
- JANGAN gunakan raw queries tanpa parameter binding

### ✅ Cross-Site Scripting (XSS)
- Blade templating engine secara otomatis escape output dengan `{{ $var }}`
- Gunakan `{!! $var !!}` hanya jika benar-benar perlu HTML dan sudah di-sanitize

### ✅ Cross-Site Request Forgery (CSRF)
- Semua form sudah dilindungi dengan `@csrf` token
- JANGAN disable CSRF protection

### ✅ Authentication & Authorization
- Gunakan middleware `auth` dan `role` untuk protect routes
- Validasi permissions di controller methods
- JANGAN hardcode user roles di views

## Monitoring & Logging

**Yang harus di-monitor:**
- Login attempts (success & failed)
- API usage dan rate limits
- Error logs dan exceptions
- Database queries yang lambat
- File uploads

**JANGAN log:**
- ❌ Passwords (plain text atau hashed)
- ❌ API keys atau tokens
- ❌ Credit card numbers
- ❌ Personal identifiable information (PII) yang sensitif

## Contact

Untuk pertanyaan terkait keamanan, hubungi:
- **Email**: fazliradika30april@gmail.com
- **GitHub**: [@Fazliradika](https://github.com/Fazliradika)

---

**Terakhir diupdate**: Desember 2025

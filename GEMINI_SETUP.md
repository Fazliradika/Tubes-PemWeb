# 🤖 Setup dan Troubleshooting Gemini AI

## 📋 Checklist Setup

### 1. **Verifikasi API Key**
```bash
# Cek apakah API key sudah ada di .env
Get-Content .env | Select-String -Pattern "GEMINI"
```

Expected output:
```
GEMINI_API_KEY=AIzaSyDlinhwKE14HhzQRKt_SOR2YtZcBECXTSw
```

### 2. **Test Koneksi API (Manual)**
Buka PowerShell dan jalankan:

```powershell
$apiKey = "AIzaSyDlinhwKE14HhzQRKt_SOR2YtZcBECXTSw"
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=$apiKey"

$body = @{
    contents = @(
        @{
            parts = @(
                @{
                    text = "Hello, sebutkan 3 tips hidup sehat"
                }
            )
        }
    )
} | ConvertTo-Json -Depth 10

$response = Invoke-RestMethod -Uri $url -Method Post -Body $body -ContentType "application/json"
$response.candidates[0].content.parts[0].text
```

### 3. **Verifikasi File Konfigurasi**

#### File: `.env`
```bash
GEMINI_API_KEY=AIzaSyDlinhwKE14HhzQRKt_SOR2YtZcBECXTSw
```

#### File: `config/services.php`
```php
'gemini' => [
    'api_key' => env('GEMINI_API_KEY'),
],
```

### 4. **Clear Cache Laravel**
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## 🔍 Troubleshooting Error

### ❌ Error: "Terjadi kesalahan koneksi"

**Kemungkinan Penyebab:**

1. **API Key tidak terkonfigurasi**
   - Solution: Pastikan `GEMINI_API_KEY` ada di file `.env`
   - Restart server setelah menambahkan API key

2. **API Key salah atau expired**
   - Verifikasi API key di: https://makersuite.google.com/app/apikey
   - Generate API key baru jika perlu

3. **API key tidak memiliki akses**
   - Pastikan API key sudah diaktifkan untuk Gemini API
   - Enable "Generative Language API" di Google Cloud Console

4. **Koneksi internet bermasalah**
   - Test koneksi: `curl https://google.com`
   - Periksa firewall/proxy settings

5. **Rate limit exceeded**
   - Tunggu beberapa menit sebelum mencoba lagi
   - Gemini API free tier: 60 requests/minute

### ❌ Error: "API key tidak memiliki akses"

**Solution:**
1. Buka [Google AI Studio](https://makersuite.google.com/)
2. Generate API key baru
3. Pastikan Gemini API sudah enabled
4. Update `.env` dengan API key baru

### ❌ Error: "400 Bad Request"

**Solution:**
- Periksa format request di HealthAIController.php
- Pastikan struktur JSON sesuai dengan dokumentasi Gemini API

### ❌ Error: "429 Too Many Requests"

**Solution:**
- Tunggu 1 menit sebelum mencoba lagi
- Implementasi rate limiting di aplikasi
- Upgrade ke paid tier jika perlu traffic lebih tinggi

## 📊 Monitoring & Logging

### Cek Log Laravel
```bash
# Windows PowerShell
Get-Content storage/logs/laravel.log -Tail 50
```

### Log yang dicari:
```
[INFO] Sending request to Gemini API
[INFO] Gemini API Response {"status":200,"successful":true}
[ERROR] Gemini API Error {"status":400,"body":"..."}
```

## 🧪 Test di Browser

1. Login sebagai **Patient** (pasien@healthcare.com / password)
2. Klik tombol chat AI (icon robot di kanan bawah)
3. Ketik pertanyaan: "Apa tips hidup sehat?"
4. Tekan Enter atau klik Send
5. Tunggu response dari AI

### Expected Behavior:
- ✅ Loading indicator muncul
- ✅ Response AI muncul dalam 2-5 detik
- ✅ Pesan error jelas jika ada masalah

### Error Handling yang Baik:
- ❌ "Konfigurasi AI belum lengkap" → API key tidak ada
- ❌ "API key tidak memiliki akses" → API key invalid/expired
- ❌ "Tidak dapat terhubung ke server AI" → Koneksi internet
- ❌ "Terlalu banyak permintaan" → Rate limit

## 🚀 Deploy ke Railway

### Update Environment Variables:
1. Buka Railway Dashboard
2. Pilih project Anda
3. Klik "Variables"
4. Tambahkan:
   ```
   GEMINI_API_KEY=AIzaSyDlinhwKE14HhzQRKt_SOR2YtZcBECXTSw
   ```
5. Deploy ulang aplikasi

### Verifikasi di Production:
```bash
# Check logs di Railway
railway logs

# Atau via dashboard Railway
```

## 📚 Resources

- [Gemini API Documentation](https://ai.google.dev/docs)
- [Google AI Studio](https://makersuite.google.com/)
- [Laravel HTTP Client](https://laravel.com/docs/http-client)

## 🔐 Security Best Practices

1. ✅ **Jangan commit `.env` ke Git**
   - Sudah ada di `.gitignore`

2. ✅ **Rotate API key secara berkala**
   - Generate new key setiap 3-6 bulan

3. ✅ **Set rate limiting di aplikasi**
   - Batasi request per user per minute

4. ✅ **Monitor usage di Google Cloud Console**
   - Track quota dan costs

## ✅ Final Checklist

- [ ] File `.env` ada dan berisi `GEMINI_API_KEY`
- [ ] Test manual API berhasil (via PowerShell)
- [ ] Laravel server running (`php artisan serve`)
- [ ] Login sebagai patient berhasil
- [ ] AI chat button muncul di dashboard
- [ ] Send message dan terima response dari AI
- [ ] Check logs jika ada error
- [ ] Deploy ke Railway dengan environment variables
- [ ] Test di production environment

---

**Support**: Jika masih ada error, check `storage/logs/laravel.log` untuk detail error.

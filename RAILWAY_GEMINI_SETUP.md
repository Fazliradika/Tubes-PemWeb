# 🚀 Setup Gemini AI di Railway

## ✅ Status: API Berhasil Ditest!

API Gemini sudah berhasil ditest dan berfungsi dengan baik menggunakan model **gemini-2.0-flash-exp**.

---

## 📋 Langkah Setup di Railway

### 1. **Login ke Railway Dashboard**
```
https://railway.app/
```

### 2. **Pilih Project Anda**
- Klik project healthcare Laravel Anda

### 3. **Tambahkan Environment Variable**

Klik tab **"Variables"** atau **"Settings"** → **"Environment Variables"**

Tambahkan variable baru:

```
GEMINI_API_KEY=AIzaSyDlinhwKE14HhzQRKt_SOR2YtZcBECXTSw
```

### 4. **Save dan Deploy**
- Klik **"Save"** atau **"Add Variable"**
- Railway akan otomatis **redeploy** aplikasi Anda
- Tunggu proses deploy selesai (biasanya 2-5 menit)

### 5. **Verifikasi Deployment**
- Cek logs di Railway dashboard
- Pastikan tidak ada error terkait Gemini API
- Look for: `✅ Deployment successful`

---

## 🧪 Testing di Production

### 1. **Login sebagai Patient**
```
URL: https://your-app.railway.app/login
Email: pasien@healthcare.com
Password: password
```

### 2. **Test AI Chatbot**
1. Setelah login, Anda akan masuk ke dashboard patient
2. Lihat tombol **chat AI floating** (icon robot) di pojok kanan bawah
3. Klik tombol tersebut untuk membuka sidebar chat
4. Ketik pertanyaan kesehatan, contoh:
   - "Apa tips hidup sehat?"
   - "Bagaimana cara menjaga kesehatan jantung?"
   - "Apa makanan yang baik untuk diabetes?"
5. Tekan **Enter** atau klik tombol **Send**
6. Tunggu response dari AI (biasanya 2-5 detik)

### Expected Result ✅
```
✅ Loading indicator muncul
✅ Response AI muncul dalam beberapa detik
✅ Jawaban dalam Bahasa Indonesia
✅ Jawaban relevan dengan pertanyaan kesehatan
```

### Error Handling ✅
Jika ada masalah, pesan error yang jelas akan muncul:
- ❌ "Konfigurasi AI belum lengkap" → API key belum ditambahkan di Railway
- ❌ "API key tidak memiliki akses" → API key invalid
- ❌ "Tidak dapat terhubung ke server AI" → Masalah koneksi
- ❌ "Terlalu banyak permintaan" → Rate limit exceeded

---

## 🔧 Technical Details

### API Endpoint
```
https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent
```

### Authentication Method
```php
Headers:
- Content-Type: application/json
- x-goog-api-key: YOUR_API_KEY
```

### Request Format
```json
{
  "contents": [
    {
      "parts": [
        {
          "text": "Your question here"
        }
      ]
    }
  ]
}
```

### Response Format
```json
{
  "candidates": [
    {
      "content": {
        "parts": [
          {
            "text": "AI response here"
          }
        ]
      }
    }
  ]
}
```

---

## 🎯 Features Implemented

### Controller: `HealthAIController.php`
- ✅ Validasi input (max 1000 karakter)
- ✅ System prompt untuk health assistant
- ✅ Authentication dengan x-goog-api-key header
- ✅ Timeout 30 detik
- ✅ Error handling dengan pesan yang jelas
- ✅ Logging untuk debugging
- ✅ Support Bahasa Indonesia

### Frontend: `patient/dashboard.blade.php`
- ✅ Floating AI button (bottom-right)
- ✅ Sliding sidebar chat interface
- ✅ Message bubbles (user & AI)
- ✅ Loading indicator
- ✅ Auto-scroll to latest message
- ✅ Textarea auto-resize
- ✅ Send button & Enter key support
- ✅ Error message display
- ✅ Smooth animations

### Route: `web.php`
```php
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::post('/health/ai/chat', [HealthAIController::class, 'chat'])
        ->name('health.ai.chat');
});
```

---

## 📊 Monitoring

### Check Logs di Railway
1. Buka Railway dashboard
2. Klik project Anda
3. Klik tab **"Deployments"**
4. Klik deployment terbaru
5. Klik **"View Logs"**

### Log yang Perlu Dicari
```
[INFO] Sending request to Gemini API
[INFO] Gemini API Response {"status":200,"successful":true}
✅ Successful response

[ERROR] Gemini API Error
❌ Error - check details
```

---

## 🔐 Security Best Practices

### ✅ Implemented
1. API key disimpan di environment variable (tidak di-commit ke Git)
2. File `.env` ada di `.gitignore`
3. Route protected dengan middleware `auth` dan `role:patient`
4. Input validation (max 1000 karakter)
5. Request timeout (30 detik)

### 📝 Recommendations
1. **Rotate API key** setiap 3-6 bulan
2. **Monitor usage** di Google Cloud Console
3. **Set rate limiting** di aplikasi (opsional)
4. **Enable IP restrictions** di API key settings (opsional)

---

## 🎓 Quota & Limits

### Gemini API Free Tier
- **Requests per minute**: 15 RPM
- **Requests per day**: 1,500 RPD
- **Tokens per minute**: 1 million TPM

### Upgrade Options
Jika traffic tinggi, upgrade ke paid tier di:
```
https://ai.google.dev/pricing
```

---

## ❓ Troubleshooting

### Error: "Konfigurasi AI belum lengkap"
**Solution:**
1. Pastikan `GEMINI_API_KEY` sudah ditambahkan di Railway Variables
2. Redeploy aplikasi
3. Clear browser cache

### Error: "API key tidak memiliki akses"
**Solution:**
1. Verifikasi API key di https://makersuite.google.com/app/apikey
2. Generate API key baru jika perlu
3. Update di Railway Variables

### Error: "Terlalu banyak permintaan"
**Solution:**
1. Tunggu 1 menit
2. Coba lagi
3. Jika terus terjadi, upgrade ke paid tier

### Chat Button Tidak Muncul
**Solution:**
1. Pastikan login sebagai **patient** (bukan admin/doctor)
2. Clear browser cache
3. Hard refresh (Ctrl + Shift + R)

---

## ✅ Checklist Deployment

- [x] API key tested locally ✅
- [x] Code pushed to GitHub ✅
- [ ] **GEMINI_API_KEY** added to Railway Variables ⬅️ **LAKUKAN INI!**
- [ ] Railway redeploy completed
- [ ] Test login sebagai patient
- [ ] Test AI chat functionality
- [ ] Check logs for errors
- [ ] Verify response quality

---

## 📚 Resources

- [Gemini API Documentation](https://ai.google.dev/docs)
- [Google AI Studio](https://makersuite.google.com/)
- [Railway Documentation](https://docs.railway.app/)
- [Laravel HTTP Client](https://laravel.com/docs/http-client)

---

## 🎉 Next Steps

1. ✅ **Tambahkan GEMINI_API_KEY di Railway** (paling penting!)
2. Test AI chat di production
3. Monitor logs untuk error
4. Collect user feedback
5. Improve system prompt jika perlu
6. Add more health-related features

---

**Status:** Ready for deployment! 🚀
**Last Updated:** November 4, 2025
**Version:** 1.0.0

---

## 💬 Support

Jika masih ada masalah:
1. Check `GEMINI_SETUP.md` untuk troubleshooting detail
2. Check Railway logs
3. Check Laravel logs: `storage/logs/laravel.log`
4. Verify API key masih valid di Google AI Studio

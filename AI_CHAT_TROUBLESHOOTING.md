# 🔧 AI Chat Troubleshooting Guide

## ❌ Error: "Terjadi kesalahan koneksi. Silakan coba lagi."

Sekarang dengan **improved error handling**, Anda akan melihat pesan error yang lebih detail.

---

## 📋 Checklist Debugging (Ikuti berurutan!)

### **1. Pastikan Anda Sudah Login sebagai Patient** ✅
```
❌ SALAH: Login sebagai admin atau doctor
✅ BENAR: Login sebagai patient

Test Account:
Email: pasien@healthcare.com
Password: password
```

**Kenapa?** AI chat hanya tersedia untuk role `patient`.

---

### **2. Pastikan GEMINI_API_KEY Ada di Railway** ⭐ **PENTING!**

#### Cek di Railway Dashboard:
1. Login ke https://railway.app/
2. Pilih project healthcare Anda
3. Klik tab **"Variables"**
4. Cari **`GEMINI_API_KEY`**

#### Jika TIDAK ADA:
```
Klik "Add Variable":
Name: GEMINI_API_KEY
Value: AIzaSyDlinhwKE14HhzQRKt_SOR2YtZcBECXTSw
```

#### Setelah menambahkan:
- Railway akan **auto-redeploy**
- Tunggu 2-5 menit sampai deploy selesai
- Refresh halaman website
- Login lagi dan test chat

---

### **3. Cek Error Message di Browser Console**

#### Cara membuka Console:
- **Chrome/Edge**: Tekan `F12` → Tab "Console"
- **Firefox**: Tekan `F12` → Tab "Console"

#### Error Messages dan Solusinya:

#### ❌ `419 - CSRF Token Mismatch`
**Penyebab:** Session expired atau CSRF token tidak valid

**Solusi:**
```
1. Hard refresh: Ctrl + Shift + R
2. Clear cookies & cache
3. Logout → Login lagi
4. Coba kirim pesan lagi
```

---

#### ❌ `404 - Not Found`
**Penyebab:** Route tidak ditemukan

**Solusi:**
```
1. Pastikan code terbaru sudah ter-deploy di Railway
2. Check Railway logs: ada error "route not found"?
3. Redeploy manual di Railway
```

**Verifikasi Route:**
- Route harus ada: `POST /health/ai/chat`
- File: `routes/web.php`
- Controller: `HealthAIController@chat`

---

#### ❌ `500 - Internal Server Error`
**Penyebab:** Error di server (Laravel/PHP)

**Solusi:**
```
1. Check Railway logs (detail error ada di sini)
2. Kemungkinan: GEMINI_API_KEY belum di-set
3. Kemungkinan: API key invalid/expired
```

**Check Logs di Railway:**
```
Railway Dashboard → Project → Deployments → Latest → View Logs

Look for:
[ERROR] Gemini API key not configured
[ERROR] Gemini API Error
```

---

#### ❌ `401/403 - Unauthorized/Forbidden`
**Penyebab:** Authentication error

**Solusi:**
```
1. Pastikan sudah login
2. Pastikan login sebagai PATIENT (bukan admin/doctor)
3. Logout → Login lagi
```

---

#### ❌ `Failed to fetch` atau `Network Error`
**Penyebab:** Koneksi internet atau server down

**Solusi:**
```
1. Check koneksi internet Anda
2. Buka website lain, apakah loading?
3. Check Railway status: https://railway.app/
4. Tunggu beberapa menit, server mungkin sedang restart
```

---

### **4. Test API Key Manual**

Buka PowerShell dan test API key:

```powershell
$headers = @{
    "Content-Type" = "application/json"
    "x-goog-api-key" = "AIzaSyDlinhwKE14HhzQRKt_SOR2YtZcBECXTSw"
}

$body = '{"contents":[{"parts":[{"text":"Hello"}]}]}'

$response = Invoke-RestMethod `
    -Uri "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent" `
    -Method Post `
    -Headers $headers `
    -Body $body

Write-Host "✅ SUCCESS!" -ForegroundColor Green
$response.candidates[0].content.parts[0].text
```

**Expected Result:**
```
✅ SUCCESS!
AI will respond with a message
```

**Jika Error:**
- `404` → Model tidak tersedia atau API key salah
- `403` → API key tidak memiliki akses
- `429` → Rate limit exceeded (tunggu 1 menit)

---

### **5. Check Railway Deployment Status**

#### Railway Dashboard:
1. Klik project Anda
2. Klik tab **"Deployments"**
3. Check status deployment terbaru:
   - ✅ **Success** → Bagus
   - ⏳ **Building** → Tunggu selesai
   - ❌ **Failed** → Ada error di build

#### Jika Deployment Failed:
```
1. Klik deployment yang failed
2. Klik "View Logs"
3. Cari error message
4. Fix error di code
5. Git push → Auto redeploy
```

---

### **6. Check Railway Logs (Real-time)**

#### Cara check logs:
```
Railway Dashboard → Project → Deployments → Latest → View Logs
```

#### Log yang BAGUS (Success):
```
[INFO] Sending request to Gemini API
[INFO] Gemini API Response {"status":200,"successful":true}
✅ Chat berhasil
```

#### Log yang ERROR:
```
[ERROR] Gemini API key not configured
→ GEMINI_API_KEY belum di-set di Railway

[ERROR] Gemini API Error {"status":403}
→ API key invalid/expired

[ERROR] Health AI Chat Error: Connection timeout
→ Network issue atau Gemini API down
```

---

### **7. Verifikasi Database & Session**

#### Check di Railway:
```
1. Pastikan MySQL database sudah running
2. Check environment variables:
   - DB_HOST
   - DB_DATABASE
   - DB_USERNAME
   - DB_PASSWORD
```

#### Laravel Session Settings:
```
SESSION_DRIVER=database (BUKAN file)
CACHE_STORE=database (BUKAN file)
```

**Kenapa?** Railway ephemeral storage, file-based session akan hilang setelah restart.

---

## 🧪 Step-by-Step Testing

### Test 1: Basic Connectivity
```
1. Buka website Railway Anda
2. Apakah website loading?
   ✅ Yes → Lanjut test 2
   ❌ No → Check Railway deployment status
```

### Test 2: Login
```
1. Buka /login
2. Login sebagai: pasien@healthcare.com / password
3. Apakah berhasil login?
   ✅ Yes → Lanjut test 3
   ❌ No → Check database connection
```

### Test 3: Dashboard Patient
```
1. Setelah login, apakah masuk ke dashboard?
2. Apakah ada floating AI button (icon robot) di kanan bawah?
   ✅ Yes → Lanjut test 4
   ❌ No → Berarti Anda bukan patient, login ulang
```

### Test 4: Open Chat
```
1. Klik tombol AI floating
2. Apakah sidebar chat muncul dari kanan?
   ✅ Yes → Lanjut test 5
   ❌ No → Check browser console for JavaScript errors
```

### Test 5: Send Message
```
1. Ketik: "Hello"
2. Tekan Enter
3. Buka F12 → Console
4. Apa yang muncul?
```

#### Hasil Console yang Mungkin:

**✅ Success:**
```javascript
POST /health/ai/chat 200 OK
Response: {success: true, message: "AI response here"}
```

**❌ Error CSRF:**
```javascript
POST /health/ai/chat 419 CSRF Token Mismatch
```
→ **Solusi:** Hard refresh (Ctrl+Shift+R), login ulang

**❌ Error 404:**
```javascript
POST /health/ai/chat 404 Not Found
```
→ **Solusi:** Route tidak ada, check Railway deployment

**❌ Error 500:**
```javascript
POST /health/ai/chat 500 Internal Server Error
```
→ **Solusi:** Check Railway logs untuk detail error

**❌ Error Network:**
```javascript
Failed to fetch
TypeError: Failed to fetch
```
→ **Solusi:** Check koneksi internet atau server down

---

## 🔍 Advanced Debugging

### Enable Laravel Debug Mode (Development Only!)

**⚠️ WARNING:** Jangan enable di production!

Railway Variables:
```
APP_DEBUG=true
APP_ENV=local
```

Ini akan menampilkan **detailed error** di browser.

**Setelah selesai debugging, MATIKAN:**
```
APP_DEBUG=false
APP_ENV=production
```

---

## ✅ Final Checklist

Pastikan SEMUA ini sudah dilakukan:

- [ ] Code terbaru di-push ke GitHub
- [ ] Railway auto-deploy selesai (Status: Success)
- [ ] **GEMINI_API_KEY** ada di Railway Variables
- [ ] Login sebagai **patient** (bukan admin/doctor)
- [ ] AI button muncul di dashboard patient
- [ ] Chat sidebar bisa dibuka
- [ ] Test API key manual (berhasil)
- [ ] Check browser console (tidak ada error)
- [ ] Check Railway logs (tidak ada error)

---

## 🚨 Common Mistakes

### ❌ Mistake #1: Lupa Set API Key di Railway
**Symptom:** Error "Konfigurasi AI belum lengkap"
**Solution:** Add `GEMINI_API_KEY` to Railway Variables

### ❌ Mistake #2: Login sebagai Doctor/Admin
**Symptom:** AI button tidak muncul
**Solution:** Logout → Login as patient

### ❌ Mistake #3: Session Expired
**Symptom:** 419 CSRF Token Mismatch
**Solution:** Hard refresh → Login ulang

### ❌ Mistake #4: Deployment Belum Selesai
**Symptom:** Old code still running
**Solution:** Wait for Railway deployment to finish

### ❌ Mistake #5: API Key Invalid
**Symptom:** 403 Forbidden
**Solution:** Generate new API key di Google AI Studio

---

## 📞 Getting More Help

### 1. Check Browser Console (F12)
```
Look for:
- Red error messages
- Network requests status
- JavaScript errors
```

### 2. Check Railway Logs
```
Railway Dashboard → Deployments → View Logs
Look for [ERROR] messages
```

### 3. Test API Key Directly
```powershell
# Run the PowerShell test from section 4
# If this fails, API key is the problem
```

### 4. Verify Environment
```
Check Railway Variables:
- GEMINI_API_KEY = AIzaSy...
- DB_HOST = correct
- SESSION_DRIVER = database
- CACHE_STORE = database
```

---

## 🎯 Quick Fix Summary

| Error | Quick Fix |
|-------|-----------|
| CSRF 419 | Hard refresh + Login ulang |
| 404 Not Found | Redeploy di Railway |
| 500 Server Error | Check Railway logs |
| Network Error | Check internet connection |
| No AI button | Login sebagai patient |
| "Konfigurasi belum lengkap" | Add GEMINI_API_KEY to Railway |
| "API key tidak akses" | Generate new API key |

---

**Last Updated:** November 4, 2025
**Version:** 2.0 (with improved error messages)

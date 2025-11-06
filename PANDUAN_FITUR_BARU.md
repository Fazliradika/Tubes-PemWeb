# 🏥 Panduan Lengkap: Prescriptions & Messages dengan Voice/Video Call

## 🎯 Ringkasan Fitur

Sistem ini menambahkan 3 fitur utama:

1. **💊 Prescriptions** - Dokter bisa memberikan resep obat setelah konsultasi
2. **💬 Messages** - Chat real-time antara pasien dan dokter yang sudah booking
3. **📞 Voice/Video Call** - Panggilan suara dan video menggunakan WebRTC

---

## 📋 Cara Kerja Prescriptions

### Untuk Dokter:

1. **Buat Resep Baru:**
   ```
   Appointment Detail → Klik "Create Prescription"
   → Isi Diagnosis
   → Pilih Obat dari database
   → Set Dosis (contoh: "3x sehari")
   → Set Jumlah obat
   → Set Durasi (hari)
   → Tambah instruksi khusus (opsional)
   → Save
   ```

2. **Edit Resep:**
   ```
   Doctor Dashboard → Prescriptions
   → Pilih resep → Klik Edit
   → Update informasi → Save
   ```

3. **Update Status Resep:**
   - **Active**: Resep masih berlaku
   - **Completed**: Pengobatan selesai
   - **Cancelled**: Resep dibatalkan

### Untuk Pasien:

1. **Lihat Resep:**
   ```
   Patient Dashboard → Klik "Prescriptions"
   → Lihat daftar semua resep
   → Klik detail untuk info lengkap
   ```

2. **Info yang Ditampilkan:**
   - Nama dokter & spesialisasi
   - Tanggal resep
   - Diagnosis
   - Daftar obat dengan dosis & durasi
   - Catatan dari dokter
   - Status resep

---

## 💬 Cara Kerja Messages (Chat)

### Memulai Percakapan:

**Dari Pasien:**
```
1. Buat appointment dengan dokter
2. Tunggu dokter konfirmasi
3. Setelah confirmed → Klik "Messages" di dashboard
4. Pilih dokter → Mulai chat
```

**Dari Detail Appointment:**
```
My Appointments → Klik appointment
→ Klik "Start Chat" → Chat room terbuka
```

### Fitur Chat:

✅ **Text Messages**
- Ketik pesan di input box
- Tekan Enter atau klik Send
- Pesan langsung terkirim

✅ **Read Receipts**
- Pesan otomatis ditandai sudah dibaca
- Timestamp di setiap pesan

✅ **Chat History**
- Semua pesan tersimpan
- Scroll ke atas untuk lihat history

---

## 📞 Voice & Video Call

### Cara Memulai Call:

1. **Buka Chat Room:**
   ```
   Messages → Pilih dokter/pasien
   ```

2. **Pilih Jenis Call:**
   - **Voice Call**: Klik tombol hijau dengan icon telepon
   - **Video Call**: Klik tombol biru dengan icon kamera

3. **Saat Call Dimulai:**
   - Browser akan minta izin akses microphone (dan camera untuk video)
   - Klik "Allow" untuk melanjutkan
   - Call modal akan terbuka
   - Tunggu pihak lain menjawab

### Kontrol Saat Call:

#### Toggle Microphone:
- Klik icon microphone untuk mute/unmute
- Warna merah = muted
- Warna abu = active

#### Toggle Camera (Video Call):
- Klik icon camera untuk hide/show video
- Warna merah = camera off
- Warna abu = camera on

#### End Call:
- Klik tombol merah dengan icon X
- Call akan berakhir
- Durasi call tersimpan di chat history

### Call History:

Setiap panggilan tercatat dalam chat dengan info:
- ⏱️ Durasi panggilan
- 📞 Jenis (Voice/Video)
- ⏰ Waktu panggilan

---

## 🔧 Technical Details

### Database Tables:

```
prescriptions
├── id
├── appointment_id
├── doctor_id
├── patient_id
├── diagnosis
├── notes
├── prescription_date
└── status (active/completed/cancelled)

prescription_items
├── id
├── prescription_id
├── product_id (dari table products)
├── dosage (contoh: "3x sehari")
├── quantity (jumlah obat)
├── duration_days (durasi)
└── instructions (instruksi khusus)

conversations
├── id
├── appointment_id
├── patient_id
├── doctor_id
├── last_message_at
└── status (active/closed)

messages
├── id
├── conversation_id
├── sender_id
├── message (isi pesan)
├── type (text/voice_call/video_call)
├── metadata (JSON)
└── read_at

call_sessions
├── id
├── conversation_id
├── caller_id
├── receiver_id
├── type (voice/video)
├── status (calling/ongoing/ended/missed/rejected)
├── started_at
├── ended_at
└── duration_seconds
```

### URL Routes:

#### Patient Routes:
```
/prescriptions                    → Daftar resep
/prescriptions/{id}               → Detail resep
/messages                         → Daftar chat
/messages/{conversation}          → Chat room
/appointments/{id}/chat           → Start chat dari appointment
```

#### Doctor Routes:
```
/doctor/prescriptions                       → Daftar resep yang dibuat
/doctor/appointments/{id}/prescription/create  → Form buat resep
/doctor/prescriptions/{id}/edit             → Edit resep
/doctor/messages                            → Daftar chat
/doctor/messages/{conversation}             → Chat room
```

#### Call API Routes:
```
POST /calls/conversations/{id}/initiate     → Mulai call
POST /calls/sessions/{id}/answer            → Terima call
POST /calls/sessions/{id}/end               → Akhiri call
POST /calls/sessions/{id}/reject            → Tolak call
```

---

## 🚀 Setup & Installation

### 1. Migrations sudah dijalankan:
```bash
php artisan migrate
```

Tables yang dibuat:
- ✅ prescriptions
- ✅ prescription_items
- ✅ conversations
- ✅ messages
- ✅ call_sessions

### 2. Dependencies:
Semua sudah terinstall via `composer install`

### 3. WebRTC Configuration:
Menggunakan Google STUN servers (gratis):
- `stun:stun.l.google.com:19302`
- `stun:stun1.l.google.com:19302`

---

## ⚠️ Penting untuk Diketahui

### WebRTC Requirements:

1. **Browser Support:**
   - ✅ Chrome (recommended)
   - ✅ Firefox
   - ✅ Safari (iOS & macOS)
   - ✅ Edge
   - ❌ Internet Explorer (tidak support)

2. **HTTPS Requirement:**
   - Production: **WAJIB** pakai HTTPS
   - Development: bisa pakai HTTP di `localhost`
   - Browser tidak izinkan getUserMedia() di HTTP (kecuali localhost)

3. **Permissions:**
   - User harus izinkan akses microphone
   - Untuk video call, izinkan akses camera
   - Permission tersimpan per-domain

### Troubleshooting WebRTC:

**Problem**: Camera/Microphone tidak terdeteksi
**Solution**:
1. Check browser permissions
2. Check device sudah terkoneksi
3. Restart browser
4. Pastikan tidak ada aplikasi lain yang pakai camera/mic

**Problem**: Call tidak terhubung
**Solution**:
1. Check koneksi internet
2. Check firewall settings
3. Untuk production, pertimbangkan pakai TURN server

---

## 💡 Tips & Best Practices

### Untuk Dokter:

1. **Resep Detail:**
   - Tulis diagnosis yang jelas
   - Berikan instruksi spesifik untuk setiap obat
   - Set durasi yang sesuai

2. **Chat Professional:**
   - Respons tepat waktu
   - Gunakan bahasa medis yang mudah dipahami
   - Dokumentasikan informasi penting

3. **Video Consultation:**
   - Pastikan pencahayaan cukup
   - Gunakan headset untuk audio lebih baik
   - Background profesional

### Untuk Pasien:

1. **Simpan Resep:**
   - Screenshot atau foto resep
   - Catat nama obat dan dosis
   - Follow instruksi dokter

2. **Chat Etis:**
   - Tanyakan di jam kerja
   - Jelaskan keluhan dengan detail
   - Respect waktu dokter

3. **Persiapan Video Call:**
   - Test camera & mic sebelum call
   - Siapkan pertanyaan yang ingin ditanyakan
   - Catat jawaban dokter

---

## 🔒 Security & Privacy

### Data Protection:
- ✅ Authorization check di semua routes
- ✅ Hanya pasien & dokter terkait bisa akses chat
- ✅ Hanya dokter bisa buat/edit resep
- ✅ CSRF protection pada form

### Call Security:
- ✅ WebRTC peer-to-peer encryption
- ✅ No server-side recording (default)
- ✅ Call metadata tersimpan (duration, type)

---

## 📊 Monitoring & Analytics

### Dashboard Metrics:

**Patient Dashboard:**
- Jumlah resep aktif (real-time)
- Unread messages count
- Upcoming appointments

**Doctor Dashboard:**
- Total resep yang dibuat
- Active conversations
- Pending appointments

---

## 🎓 Demo Flow

### Complete User Journey:

```
1. Patient → Book appointment dengan dokter
2. Doctor → Confirm appointment
3. Patient → Start chat dari appointment detail
4. Patient & Doctor → Exchange messages
5. Patient atau Doctor → Initiate video call
6. Doctor → Create prescription setelah konsultasi
7. Patient → View prescription di dashboard
8. Patient → Follow instruksi pengobatan
9. Doctor → Update status resep menjadi "completed"
```

---

## 📞 Support & Questions

Jika ada pertanyaan atau issue:
1. Check documentation ini
2. Review code di controllers & views
3. Check browser console untuk WebRTC errors
4. Verify database tables & data

---

## ✅ Checklist Implementasi

- [x] Database migrations
- [x] Models & relationships
- [x] Controllers (Prescription & Chat)
- [x] Routes configuration
- [x] Views (prescriptions & chat)
- [x] WebRTC implementation
- [x] Dashboard integration
- [x] Authorization & security
- [x] Documentation

**Status: READY TO USE! 🎉**

---

Semua fitur sudah lengkap dan siap digunakan. Untuk production deployment, pertimbangkan untuk menambahkan:
- WebSocket untuk real-time chat (Laravel Echo + Pusher)
- TURN server untuk better call connectivity
- Push notifications
- File upload dalam chat

Selamat menggunakan! 🚀

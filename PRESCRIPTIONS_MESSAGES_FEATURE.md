# Fitur Prescriptions & Messages dengan Voice/Video Call

## 📋 Fitur yang Telah Diimplementasikan

### 1. **Prescriptions (Resep Obat)**
Sistem resep obat yang memungkinkan dokter memberikan resep setelah konsultasi dengan pasien.

#### Features:
- ✅ Dokter dapat membuat resep untuk pasien setelah appointment
- ✅ Resep mencakup diagnosis, catatan, dan daftar obat
- ✅ Setiap obat dalam resep memiliki:
  - Nama obat (dari database products)
  - Dosis (contoh: 3x sehari)
  - Jumlah (quantity)
  - Durasi pengobatan (hari)
  - Instruksi khusus
- ✅ Status resep: active, completed, cancelled
- ✅ Pasien dapat melihat semua resep mereka
- ✅ Terintegrasi dengan appointment system

#### Routes:
**Patient:**
- `GET /prescriptions` - Lihat semua resep
- `GET /prescriptions/{prescription}` - Detail resep

**Doctor:**
- `GET /doctor/prescriptions` - Daftar resep yang dibuat
- `GET /doctor/appointments/{appointment}/prescription/create` - Form buat resep
- `POST /doctor/appointments/{appointment}/prescription` - Simpan resep
- `GET /doctor/prescriptions/{prescription}/edit` - Edit resep
- `PUT /doctor/prescriptions/{prescription}` - Update resep

### 2. **Messages (Chat System)**
Sistem chat real-time antara pasien dan dokter yang telah melakukan booking appointment.

#### Features:
- ✅ Chat hanya tersedia untuk appointment yang sudah confirmed/completed
- ✅ Pasien dapat chat dengan dokter yang sudah di-booking
- ✅ Dokter dapat chat dengan pasien mereka
- ✅ Real-time messaging
- ✅ Read receipts (status baca)
- ✅ Message history

#### Routes:
**Patient:**
- `GET /messages` - Daftar percakapan
- `GET /messages/{conversation}` - Chat room
- `POST /messages/{conversation}/send` - Kirim pesan
- `POST /appointments/{appointment}/chat` - Buat chat dari appointment

**Doctor:**
- `GET /doctor/messages` - Daftar percakapan
- `GET /doctor/messages/{conversation}` - Chat room
- `POST /doctor/messages/{conversation}/send` - Kirim pesan

### 3. **Voice & Video Call (WebRTC)**
Fitur panggilan suara dan video menggunakan teknologi WebRTC.

#### Features:
- ✅ Voice call antara patient dan doctor
- ✅ Video call dengan camera feed
- ✅ Toggle microphone on/off
- ✅ Toggle camera on/off (untuk video call)
- ✅ Call duration tracking
- ✅ Call history tersimpan dalam chat
- ✅ Call status: calling, ongoing, ended, missed, rejected

#### Call Routes:
- `POST /calls/conversations/{conversation}/initiate` - Mulai panggilan
- `POST /calls/sessions/{callSession}/answer` - Terima panggilan
- `POST /calls/sessions/{callSession}/end` - Akhiri panggilan
- `POST /calls/sessions/{callSession}/reject` - Tolak panggilan

#### API Routes:
- `GET /api/messages/unread-count` - Hitung pesan belum dibaca

## 🗄️ Database Schema

### Tables Created:
1. **prescriptions** - Data resep obat
   - appointment_id, doctor_id, patient_id
   - diagnosis, notes, prescription_date, status

2. **prescription_items** - Item obat dalam resep
   - prescription_id, product_id
   - dosage, quantity, duration_days, instructions

3. **conversations** - Percakapan antara patient dan doctor
   - appointment_id, patient_id, doctor_id
   - last_message_at, status

4. **messages** - Pesan dalam percakapan
   - conversation_id, sender_id
   - message, type (text/image/file/voice_call/video_call)
   - metadata, read_at

5. **call_sessions** - Riwayat panggilan
   - conversation_id, caller_id, receiver_id
   - type (voice/video), status
   - started_at, ended_at, duration_seconds

## 🔧 Models & Relationships

### New Models:
- `Prescription` - Resep obat
- `PrescriptionItem` - Item dalam resep
- `Conversation` - Percakapan
- `Message` - Pesan
- `CallSession` - Sesi panggilan

### Updated Models:
- `User` - Added: prescriptions(), patientConversations(), messages(), doctorProfile()
- `Doctor` - Added: prescriptions(), conversations()
- `Appointment` - Added: prescription(), conversation()

## 📱 UI Components

### Patient Dashboard Updates:
- **Prescriptions Card** - Menampilkan jumlah resep aktif
- **Quick Actions** - Link ke Prescriptions dan Messages
- Data real-time dari database

### Views Created:
1. `/resources/views/prescriptions/index.blade.php` - Daftar resep patient
2. `/resources/views/chat/index.blade.php` - Daftar percakapan
3. `/resources/views/chat/show.blade.php` - Chat room dengan WebRTC

## 🚀 Cara Penggunaan

### Untuk Patient:
1. **Melihat Resep:**
   - Klik "Prescriptions" di dashboard
   - Lihat semua resep yang diberikan dokter
   - Klik detail untuk melihat obat yang diresepkan

2. **Chat dengan Dokter:**
   - Klik "Messages" di dashboard
   - Pilih dokter yang sudah di-booking
   - Kirim pesan text
   - Klik "Voice Call" atau "Video Call" untuk panggilan

### Untuk Doctor:
1. **Membuat Resep:**
   - Buka detail appointment pasien
   - Klik "Create Prescription"
   - Isi diagnosis dan pilih obat
   - Set dosis, jumlah, dan durasi
   - Save prescription

2. **Chat dengan Pasien:**
   - Klik menu "Messages"
   - Pilih percakapan dengan pasien
   - Balas pesan atau mulai panggilan

## 🔐 Security Features:
- ✅ Authorization checks pada semua routes
- ✅ Hanya pasien dan dokter terkait yang bisa akses chat
- ✅ Hanya dokter yang bisa membuat/edit resep
- ✅ CSRF protection pada semua form
- ✅ WebRTC peer-to-peer encryption

## 🌐 WebRTC Implementation

### STUN Servers Used:
- `stun:stun.l.google.com:19302`
- `stun:stun1.l.google.com:19302`

### Features:
- Peer-to-peer connection untuk call
- Media stream handling (audio & video)
- ICE candidate exchange
- Connection state management

## 📝 Next Steps (Optional Enhancements):

1. **Signaling Server** - Untuk production, implement signaling server dengan WebSocket (Laravel Echo + Pusher/Socket.io)
2. **TURN Server** - Untuk NAT traversal di network kompleks
3. **File Sharing** - Upload dan share gambar/dokumen dalam chat
4. **Push Notifications** - Notifikasi untuk pesan baru dan incoming call
5. **Call Recording** - Rekam panggilan untuk dokumentasi medis
6. **Prescription PDF Export** - Export resep ke PDF
7. **E-Prescription Integration** - Integrasi dengan apotek online

## 🧪 Testing

Untuk test fitur ini:
1. Login sebagai patient
2. Buat appointment dengan dokter
3. Dokter konfirmasi appointment
4. Patient dapat mulai chat
5. Dokter buat prescription setelah konsultasi
6. Patient lihat prescription di menu Prescriptions
7. Test voice/video call (butuh HTTPS atau localhost)

## ⚠️ Important Notes:

1. **WebRTC Requirements:**
   - Butuh HTTPS untuk production (getUserMedia API)
   - Di localhost bisa pakai HTTP
   - Browser harus support WebRTC (Chrome, Firefox, Safari, Edge)

2. **Database:**
   - Migrations sudah dijalankan
   - Tables sudah dibuat
   - Siap untuk digunakan

3. **Products Table:**
   - Pastikan ada products dengan category obat (category_id = 1)
   - Obat akan dipilih dari tabel products

## 📊 Dashboard Integration:

Dashboard patient sudah terintegrasi dengan:
- Active prescriptions count (real-time dari database)
- Quick action buttons ke Prescriptions dan Messages
- Unread messages count (coming soon)

Semua fitur sudah siap digunakan! 🎉

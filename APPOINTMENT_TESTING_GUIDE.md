# Appointment Booking Feature - Testing Guide

## Server Information
- Server URL: **http://127.0.0.1:9000**
- Server Status: ✅ RUNNING

## Test Credentials

### Patient Account (untuk booking appointment)
- **Email**: patient@test.com
- **Password**: password123

### Doctor Accounts (jika perlu login sebagai dokter)
- ahmad.fadli@hospital.com - Kardiologi
- citra.dewi@hospital.com - Dermatologi
- budi.santoso@hospital.com - Dokter Umum
- sarah.wijaya@hospital.com - Pediatri
- rudi.hermawan@hospital.com - Orthopedi
- linda.kusuma@hospital.com - Dokter Gigi
- andri.pratama@hospital.com - Psikiater
- maya.sari@hospital.com - Obstetri & Ginekologi
- **Password untuk semua dokter**: password123

## Cara Testing

### 1. Login sebagai Patient
1. Buka browser: http://127.0.0.1:9000
2. Klik "Login"
3. Masukkan: patient@test.com / password123
4. Klik "Login"

### 2. Booking Appointment
1. Di Dashboard Patient, lihat section "Quick Actions"
2. Klik tombol **"Book Appointment"** (warna biru dengan icon +)
3. Anda akan diarahkan ke halaman daftar dokter

### 3. Filter dan Pilih Dokter
1. Gunakan dropdown "Filter by Specialization" untuk filter:
   - Semua Spesialis
   - Kardiologi
   - Dermatologi
   - Dokter Umum
   - Pediatri
   - Orthopedi
   - Dokter Gigi
   - Psikiater
   - Obstetri & Ginekologi

2. Lihat informasi dokter:
   - ✅ Foto dokter (atau avatar placeholder)
   - ✅ Nama dan spesialisasi
   - ✅ Bio dan pengalaman
   - ✅ Jadwal praktik (hari-hari tersedia)
   - ✅ Jam praktik
   - ✅ Harga per sesi

3. Klik **"Book Appointment"** pada dokter pilihan

### 4. Isi Form Booking
1. Pilih tanggal appointment (minimal hari ini)
2. Pilih waktu sesuai jam praktik dokter
3. (Opsional) Tulis keluhan/gejala Anda
4. Lihat total biaya
5. Klik **"Konfirmasi Booking"**

### 5. Lihat Confirmation
- Setelah booking berhasil, Anda akan melihat halaman konfirmasi
- Status appointment: **PENDING** (menunggu konfirmasi dokter)
- Detail lengkap appointment ditampilkan

### 6. Lihat Riwayat Appointment
1. Klik "My Appointments" di Quick Actions (tombol ungu)
2. Atau klik "Lihat Semua Appointment" dari halaman konfirmasi
3. Anda bisa:
   - Melihat semua appointment (past & upcoming)
   - Lihat detail masing-masing appointment
   - Cancel appointment yang masih pending/confirmed

## Fitur yang Sudah Tersedia

✅ Daftar dokter dengan berbagai spesialisasi
✅ Filter dokter berdasarkan spesialisasi
✅ Foto/avatar dokter
✅ Informasi lengkap dokter (bio, pengalaman, jadwal, harga)
✅ Booking appointment dengan validasi
✅ Pengecekan jadwal dokter (hari tersedia)
✅ Pengecekan waktu slot (tidak bentrok dengan booking lain)
✅ Riwayat appointment
✅ Detail appointment
✅ Cancel appointment
✅ Status tracking (pending, confirmed, completed, cancelled)

## Troubleshooting

### Jika tombol Book Appointment tidak bekerja:
1. Pastikan sudah login sebagai patient
2. Clear browser cache (Cmd+Shift+R di Mac)
3. Periksa browser console untuk error (F12 > Console)
4. Pastikan server masih running di terminal

### Jika halaman error 404:
1. Jalankan: `php artisan route:clear`
2. Refresh halaman

### Jika error database:
1. Jalankan: `php artisan migrate:fresh`
2. Jalankan: `php artisan db:seed --class=DoctorSeeder`
3. Jalankan: `php artisan db:seed --class=PatientTestSeeder`

## Database Schema

### Table: doctors
- id, user_id, specialization, bio, photo
- price_per_session, years_of_experience
- available_days (JSON), start_time, end_time
- is_active, timestamps

### Table: appointments
- id, patient_id, doctor_id
- appointment_date, appointment_time
- status (pending/confirmed/completed/cancelled)
- symptoms, notes, total_price
- timestamps

## Routes

```
GET  /appointments                         - Daftar dokter
GET  /appointments/create/{doctor}         - Form booking
POST /appointments/store/{doctor}          - Proses booking
GET  /appointments/{appointment}           - Detail appointment
GET  /my-appointments                      - Riwayat appointment
PATCH /appointments/{appointment}/cancel   - Cancel appointment
```

## Notes
- Semua route appointment berada di middleware auth dan role:patient
- Validasi memastikan dokter tersedia di hari yang dipilih
- Validasi memastikan tidak ada booking bentrok di waktu yang sama
- Harga otomatis diambil dari price_per_session dokter

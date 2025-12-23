<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactMessage;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'phone' => '+62 812 3456 7890',
                'subject' => 'general',
                'message' => 'Halo, saya ingin bertanya apakah HealthFirst Medical menerima pasien BPJS? Terima kasih.',
                'status' => 'unread',
                'created_at' => now()->subHours(2),
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti.rahayu@yahoo.com',
                'phone' => '+62 857 1234 5678',
                'subject' => 'appointment',
                'message' => 'Saya sudah membuat janji temu untuk tanggal 26 Desember, tapi ada perubahan jadwal kerja. Bisakah saya mengubah jadwal ke tanggal 27 Desember dengan dokter yang sama?',
                'status' => 'read',
                'created_at' => now()->subHours(5),
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@outlook.com',
                'phone' => '+62 878 9012 3456',
                'subject' => 'payment',
                'message' => 'Pembayaran saya sudah berhasil tapi status pesanan masih pending. Sudah 2 jam tidak ada update. Mohon dicek. No. Order: ORD-20241224-001',
                'status' => 'replied',
                'admin_notes' => 'Sudah dibantu verifikasi pembayaran dan update status order. Pembayaran berhasil dikonfirmasi.',
                'replied_at' => now()->subHours(3),
                'replied_by' => 1,
                'created_at' => now()->subHours(6),
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'phone' => '+62 821 5678 9012',
                'subject' => 'technical',
                'message' => 'Video call dengan dokter sering terputus-putus. Saya sudah coba pakai WiFi dan data seluler tapi tetap sama. Mohon bantuannya.',
                'status' => 'unread',
                'created_at' => now()->subHours(1),
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@company.co.id',
                'phone' => '+62 813 2345 6789',
                'subject' => 'complaint',
                'message' => 'Saya kecewa dengan pelayanan dokter kemarin. Konsultasi hanya 5 menit dan dokter seperti terburu-buru. Padahal saya sudah bayar biaya konsultasi penuh. Mohon ditindaklanjuti.',
                'status' => 'read',
                'created_at' => now()->subDay(),
            ],
            [
                'name' => 'Rina Wijaya',
                'email' => 'rina.wijaya@email.com',
                'phone' => '+62 856 7890 1234',
                'subject' => 'general',
                'message' => 'Apakah ada layanan home visit untuk lansia yang kesulitan keluar rumah? Nenek saya berusia 80 tahun dan membutuhkan pemeriksaan rutin.',
                'status' => 'unread',
                'created_at' => now()->subMinutes(30),
            ],
            [
                'name' => 'Hendra Gunawan',
                'email' => 'hendra.g@gmail.com',
                'phone' => '+62 852 3456 7891',
                'subject' => 'payment',
                'message' => 'Bagaimana cara mendapatkan invoice untuk klaim asuransi kantor? Saya butuh invoice dengan kop surat resmi.',
                'status' => 'replied',
                'admin_notes' => 'Sudah dikirimkan panduan request invoice resmi melalui email. Customer sudah konfirmasi menerima.',
                'replied_at' => now()->subDay(),
                'replied_by' => 1,
                'created_at' => now()->subDays(2),
            ],
            [
                'name' => 'Maya Indah',
                'email' => 'maya.indah@hotmail.com',
                'phone' => '+62 817 8901 2345',
                'subject' => 'appointment',
                'message' => 'Saya ingin membuat appointment dengan dokter spesialis kulit. Apakah tersedia dokter dermatologi? Saya mengalami masalah jerawat yang cukup parah.',
                'status' => 'unread',
                'created_at' => now()->subHours(4),
            ],
            [
                'name' => 'Dimas Nugroho',
                'email' => 'dimas.nugroho@startup.io',
                'phone' => '+62 838 9012 3456',
                'subject' => 'other',
                'message' => 'Saya tertarik untuk bekerja sama sebagai mitra corporate. Perusahaan kami memiliki 200+ karyawan dan ingin menyediakan fasilitas kesehatan digital. Bisa dibantu untuk diskusi lebih lanjut?',
                'status' => 'read',
                'created_at' => now()->subDays(3),
            ],
            [
                'name' => 'Lisa Permata',
                'email' => 'lisa.permata@gmail.com',
                'phone' => '+62 859 0123 4567',
                'subject' => 'technical',
                'message' => 'Tidak bisa login ke akun saya. Sudah reset password berkali-kali tapi tetap tidak bisa. Email: lisa.permata@gmail.com. Mohon bantuan reset manual.',
                'status' => 'replied',
                'admin_notes' => 'Reset password manual berhasil. User sudah bisa login kembali. Issue disebabkan oleh cache browser.',
                'replied_at' => now()->subHours(12),
                'replied_by' => 1,
                'created_at' => now()->subDay(),
            ],
        ];

        foreach ($messages as $message) {
            ContactMessage::create($message);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            // General
            [
                'question' => 'Bagaimana cara membuat janji temu dengan dokter?',
                'answer' => 'Untuk membuat janji temu, login ke akun Anda, pilih menu "Dashboard", lalu klik "Book Appointment". Pilih dokter yang diinginkan, tanggal dan waktu yang tersedia, kemudian konfirmasi pembayaran. Anda akan menerima konfirmasi melalui email dan notifikasi di dashboard.',
                'category' => 'general',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah HealthFirst Medical memiliki cabang di kota lain?',
                'answer' => 'Saat ini HealthFirst Medical berfokus pada layanan telemedicine dan konsultasi online yang dapat diakses dari seluruh Indonesia. Kami berencana untuk membuka cabang fisik di beberapa kota besar dalam waktu dekat.',
                'category' => 'general',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara menghubungi customer service?',
                'answer' => 'Anda dapat menghubungi customer service kami melalui beberapa cara: 1) Telepon: +62 21 1234 5678, 2) WhatsApp: +62 812 3456 7890, 3) Email: support@healthfirst.id, 4) Formulir kontak di website. Tim kami siap melayani 24/7.',
                'category' => 'general',
                'order' => 3,
                'is_active' => true,
            ],

            // Appointment
            [
                'question' => 'Bagaimana cara membatalkan janji temu?',
                'answer' => 'Anda dapat membatalkan janji temu melalui menu "My Appointments" di dashboard. Pembatalan gratis jika dilakukan minimal 24 jam sebelum jadwal. Pembatalan kurang dari 24 jam akan dikenakan biaya administrasi 25% dari biaya konsultasi.',
                'category' => 'appointment',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah saya bisa mengubah jadwal janji temu?',
                'answer' => 'Ya, Anda bisa mengubah jadwal janji temu melalui menu "My Appointments" di dashboard. Perubahan jadwal gratis jika dilakukan minimal 6 jam sebelum jadwal asli. Jadwal baru tergantung ketersediaan dokter.',
                'category' => 'appointment',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Berapa lama waktu konsultasi dengan dokter?',
                'answer' => 'Waktu konsultasi standar adalah 15-30 menit tergantung kompleksitas masalah kesehatan Anda. Jika diperlukan waktu lebih lama, dokter dapat memperpanjang sesi atau menjadwalkan konsultasi lanjutan.',
                'category' => 'appointment',
                'order' => 3,
                'is_active' => true,
            ],

            // Payment
            [
                'question' => 'Metode pembayaran apa saja yang diterima?',
                'answer' => 'Kami menerima berbagai metode pembayaran termasuk transfer bank (BCA, Mandiri, BNI, BRI), e-wallet (GoPay, OVO, Dana, ShopeePay), kartu kredit/debit, dan pembayaran virtual account. Semua transaksi dijamin aman dan terenkripsi.',
                'category' => 'payment',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah biaya konsultasi bisa diklaim ke asuransi?',
                'answer' => 'Ya, HealthFirst Medical bekerja sama dengan berbagai perusahaan asuransi kesehatan. Silakan hubungi customer service kami untuk informasi lebih lanjut tentang klaim asuransi dan dokumen yang diperlukan.',
                'category' => 'payment',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara mendapatkan invoice pembayaran?',
                'answer' => 'Invoice pembayaran akan otomatis dikirimkan ke email Anda setelah pembayaran berhasil. Anda juga dapat mengunduh invoice melalui menu "Riwayat Pembayaran" di dashboard akun Anda.',
                'category' => 'payment',
                'order' => 3,
                'is_active' => true,
            ],

            // Technical
            [
                'question' => 'Aplikasi tidak bisa dibuka atau error, apa yang harus dilakukan?',
                'answer' => 'Jika mengalami masalah teknis, coba langkah berikut: 1) Refresh halaman atau restart aplikasi, 2) Hapus cache browser, 3) Coba menggunakan browser lain, 4) Pastikan koneksi internet stabil. Jika masalah berlanjut, hubungi support kami.',
                'category' => 'technical',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara melakukan video call dengan dokter?',
                'answer' => 'Saat jadwal konsultasi tiba, buka halaman detail appointment dan klik tombol "Mulai Konsultasi Video". Pastikan kamera dan mikrofon Anda sudah aktif. Gunakan browser Chrome, Firefox, atau Safari versi terbaru untuk pengalaman terbaik.',
                'category' => 'technical',
                'order' => 2,
                'is_active' => true,
            ],

            // Account
            [
                'question' => 'Bagaimana cara mengubah password akun?',
                'answer' => 'Untuk mengubah password: 1) Login ke akun Anda, 2) Klik nama Anda di pojok kanan atas, 3) Pilih "Profile", 4) Klik tab "Security" atau "Ubah Password", 5) Masukkan password lama dan password baru, 6) Klik simpan.',
                'category' => 'account',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana jika saya lupa password?',
                'answer' => 'Klik "Lupa Password" di halaman login. Masukkan email yang terdaftar, dan kami akan mengirimkan link untuk reset password. Link tersebut berlaku selama 60 menit. Jika tidak menerima email, periksa folder spam atau hubungi customer service.',
                'category' => 'account',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah data pribadi saya aman?',
                'answer' => 'Keamanan data Anda adalah prioritas kami. Semua data dienkripsi menggunakan standar industri (SSL/TLS), disimpan di server aman, dan kami mematuhi regulasi perlindungan data pribadi. Kami tidak pernah membagikan data Anda kepada pihak ketiga tanpa persetujuan.',
                'category' => 'account',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}

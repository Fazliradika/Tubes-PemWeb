<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kebijakan Privasi - {{ config('app.name', 'HealthFirst Medical') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 transition-colors duration-300">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white dark:bg-slate-900 shadow-sm border-b border-slate-200 dark:border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center justify-between">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/LOGO_HealthFirst.png') }}" alt="Logo" class="h-10 w-auto" />
                        <span
                            class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400 bg-clip-text text-transparent">HealthFirst
                            Medical</span>
                    </a>
                    <button @click="darkMode = !darkMode"
                        class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                        <i class="fas fa-sun text-yellow-500 dark:hidden"></i>
                        <i class="fas fa-moon text-blue-400 hidden dark:inline"></i>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div
                class="bg-white dark:bg-slate-800 rounded-2xl p-8 md:p-12 shadow-sm border border-slate-200 dark:border-slate-700">
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">Kebijakan Privasi</h1>
                <p class="text-slate-500 dark:text-slate-400 mb-8">Terakhir diperbarui: {{ date('d F Y') }}</p>

                <div class="prose prose-slate dark:prose-invert max-w-none">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">1. Pendahuluan</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        HealthFirst Medical berkomitmen untuk melindungi privasi dan data pribadi Anda. Kebijakan
                        privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi
                        informasi Anda.
                    </p>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">2. Informasi yang Kami
                        Kumpulkan</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">Kami mengumpulkan berbagai jenis informasi untuk
                        menyediakan layanan kepada Anda:</p>

                    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200 mt-6 mb-3">a. Informasi Pribadi
                    </h3>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li>Nama lengkap dan tanggal lahir</li>
                        <li>Alamat email dan nomor telepon</li>
                        <li>Alamat tempat tinggal</li>
                        <li>Foto profil (jika diunggah)</li>
                    </ul>

                    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200 mt-6 mb-3">b. Informasi
                        Kesehatan</h3>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li>Riwayat kesehatan dan kondisi medis</li>
                        <li>Catatan konsultasi dan diagnosis</li>
                        <li>Resep obat dan hasil pemeriksaan</li>
                        <li>Informasi asuransi kesehatan</li>
                    </ul>

                    <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200 mt-6 mb-3">c. Informasi Teknis
                    </h3>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li>Alamat IP dan jenis perangkat</li>
                        <li>Browser dan sistem operasi</li>
                        <li>Cookies dan data penggunaan</li>
                    </ul>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">3. Bagaimana Kami Menggunakan
                        Informasi</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">Informasi yang kami kumpulkan digunakan untuk:
                    </p>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li>Menyediakan dan meningkatkan layanan kesehatan</li>
                        <li>Memproses janji temu dan transaksi</li>
                        <li>Mengirimkan notifikasi dan informasi penting</li>
                        <li>Menganalisis penggunaan untuk peningkatan layanan</li>
                        <li>Memenuhi kewajiban hukum dan regulasi</li>
                    </ul>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">4. Keamanan Data</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Kami menerapkan langkah-langkah keamanan yang ketat untuk melindungi data Anda:
                    </p>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li>Enkripsi end-to-end untuk semua data sensitif</li>
                        <li>Sertifikasi ISO 27001 untuk keamanan informasi</li>
                        <li>Firewall dan sistem deteksi intrusi</li>
                        <li>Audit keamanan berkala</li>
                        <li>Akses terbatas berdasarkan kebutuhan</li>
                    </ul>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">5. Berbagi Informasi</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Kami tidak menjual data pribadi Anda. Informasi hanya dibagikan dalam situasi berikut:
                    </p>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li>Dengan tenaga medis untuk keperluan perawatan</li>
                        <li>Dengan mitra pembayaran untuk memproses transaksi</li>
                        <li>Jika diwajibkan oleh hukum atau perintah pengadilan</li>
                        <li>Dengan persetujuan eksplisit dari Anda</li>
                    </ul>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">6. Hak Pengguna</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">Anda memiliki hak untuk:</p>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li><strong>Akses:</strong> Meminta salinan data pribadi Anda</li>
                        <li><strong>Koreksi:</strong> Memperbarui informasi yang tidak akurat</li>
                        <li><strong>Penghapusan:</strong> Meminta penghapusan data (dengan batasan tertentu)</li>
                        <li><strong>Pembatasan:</strong> Membatasi pemrosesan data tertentu</li>
                        <li><strong>Portabilitas:</strong> Menerima data dalam format yang dapat dibaca mesin</li>
                    </ul>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">7. Cookies</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Kami menggunakan cookies untuk meningkatkan pengalaman pengguna. Anda dapat mengatur preferensi
                        cookie melalui pengaturan browser. Jenis cookies yang kami gunakan:
                    </p>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li><strong>Essential:</strong> Diperlukan untuk fungsi dasar platform</li>
                        <li><strong>Analytics:</strong> Membantu kami memahami penggunaan platform</li>
                        <li><strong>Preference:</strong> Menyimpan pengaturan pengguna</li>
                    </ul>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">8. Penyimpanan Data</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Data pribadi dan rekam medis disimpan selama diperlukan untuk menyediakan layanan atau sesuai
                        dengan ketentuan hukum yang berlaku. Rekam medis disimpan minimal selama 10 tahun sesuai
                        regulasi kesehatan Indonesia.
                    </p>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">9. Perubahan Kebijakan</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Perubahan signifikan akan
                        diberitahukan melalui email atau notifikasi di platform.
                    </p>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">10. Hubungi Kami</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Untuk pertanyaan tentang kebijakan privasi atau permintaan terkait data pribadi Anda, silakan
                        hubungi:
                    </p>
                    <div class="bg-slate-50 dark:bg-slate-700 rounded-xl p-6">
                        <p class="text-slate-600 dark:text-slate-400">
                            <strong>Data Protection Officer</strong><br>
                            Email: privacy@healthfirst.id<br>
                            Telepon: +62 21 1234 5678<br>
                            Alamat: Jl. Kesehatan No. 123, Jakarta Selatan, DKI Jakarta 12345
                        </p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center">
                <p class="text-slate-500 dark:text-slate-400">&copy; {{ date('Y') }} HealthFirst Medical. All rights
                    reserved.</p>
            </div>
        </footer>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FAQ - {{ config('app.name', 'HealthFirst Medical') }}</title>

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
        <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-4">Frequently Asked Questions</h1>
                <p class="text-lg text-slate-600 dark:text-slate-400">Temukan jawaban untuk pertanyaan yang sering
                    diajukan tentang layanan HealthFirst Medical</p>
            </div>

            <div class="space-y-4" x-data="{ openFaq: null }">
                <!-- FAQ Item 1 -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <button @click="openFaq = openFaq === 1 ? null : 1"
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <span class="font-semibold text-slate-900 dark:text-white">Bagaimana cara membuat janji temu
                            dengan dokter?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 1 }"></i>
                    </button>
                    <div x-show="openFaq === 1" x-collapse class="px-6 pb-4">
                        <p class="text-slate-600 dark:text-slate-400">Untuk membuat janji temu, login ke akun Anda,
                            pilih menu "Dashboard", lalu klik "Book Appointment". Pilih dokter yang diinginkan, tanggal
                            dan waktu yang tersedia, kemudian konfirmasi pembayaran. Anda akan menerima konfirmasi
                            melalui email dan notifikasi di dashboard.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <button @click="openFaq = openFaq === 2 ? null : 2"
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <span class="font-semibold text-slate-900 dark:text-white">Metode pembayaran apa saja yang
                            diterima?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 2 }"></i>
                    </button>
                    <div x-show="openFaq === 2" x-collapse class="px-6 pb-4">
                        <p class="text-slate-600 dark:text-slate-400">Kami menerima berbagai metode pembayaran termasuk
                            transfer bank (BCA, Mandiri, BNI, BRI), e-wallet (GoPay, OVO, Dana, ShopeePay), kartu
                            kredit/debit, dan pembayaran virtual account. Semua transaksi dijamin aman dan terenkripsi.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <button @click="openFaq = openFaq === 3 ? null : 3"
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <span class="font-semibold text-slate-900 dark:text-white">Bagaimana cara membatalkan janji
                            temu?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 3 }"></i>
                    </button>
                    <div x-show="openFaq === 3" x-collapse class="px-6 pb-4">
                        <p class="text-slate-600 dark:text-slate-400">Anda dapat membatalkan janji temu melalui menu "My
                            Appointments" di dashboard. Pembatalan gratis jika dilakukan minimal 24 jam sebelum jadwal.
                            Pembatalan kurang dari 24 jam mungkin dikenakan biaya administrasi sesuai kebijakan yang
                            berlaku.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <button @click="openFaq = openFaq === 4 ? null : 4"
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <span class="font-semibold text-slate-900 dark:text-white">Apakah resep obat bisa ditebus secara
                            online?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 4 }"></i>
                    </button>
                    <div x-show="openFaq === 4" x-collapse class="px-6 pb-4">
                        <p class="text-slate-600 dark:text-slate-400">Ya, setelah konsultasi dengan dokter, resep akan
                            tersedia di menu "Prescriptions". Anda dapat langsung menebus obat melalui Apotek Online
                            kami dengan pengiriman ke alamat Anda atau mengambil di apotek rekanan terdekat.</p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <button @click="openFaq = openFaq === 5 ? null : 5"
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <span class="font-semibold text-slate-900 dark:text-white">Bagaimana keamanan data medis
                            saya?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 5 }"></i>
                    </button>
                    <div x-show="openFaq === 5" x-collapse class="px-6 pb-4">
                        <p class="text-slate-600 dark:text-slate-400">Keamanan data Anda adalah prioritas utama kami.
                            HealthFirst Medical tersertifikasi ISO 27001 untuk keamanan informasi. Semua data dienkripsi
                            end-to-end dan disimpan di server yang aman sesuai standar regulasi kesehatan Indonesia.</p>
                    </div>
                </div>

                <!-- FAQ Item 6 -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <button @click="openFaq = openFaq === 6 ? null : 6"
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <span class="font-semibold text-slate-900 dark:text-white">Apakah ada fitur konsultasi
                            online?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 6 }"></i>
                    </button>
                    <div x-show="openFaq === 6" x-collapse class="px-6 pb-4">
                        <p class="text-slate-600 dark:text-slate-400">Ya, kami menyediakan fitur konsultasi online
                            melalui chat dan video call dengan dokter. Anda dapat mengakses fitur ini setelah membuat
                            janji temu konsultasi online. Pastikan koneksi internet stabil untuk pengalaman terbaik.</p>
                    </div>
                </div>

                <!-- FAQ Item 7 -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <button @click="openFaq = openFaq === 7 ? null : 7"
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <span class="font-semibold text-slate-900 dark:text-white">Bagaimana cara mengakses rekam medis
                            saya?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 7 }"></i>
                    </button>
                    <div x-show="openFaq === 7" x-collapse class="px-6 pb-4">
                        <p class="text-slate-600 dark:text-slate-400">Rekam medis digital Anda dapat diakses melalui
                            menu "Prescriptions" atau "Medical Records" di dashboard. Anda dapat melihat riwayat
                            konsultasi, diagnosis, resep obat, dan hasil pemeriksaan kapan saja dan di mana saja.</p>
                    </div>
                </div>

                <!-- FAQ Item 8 -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <button @click="openFaq = openFaq === 8 ? null : 8"
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <span class="font-semibold text-slate-900 dark:text-white">Apakah HealthFirst Medical bekerja
                            sama dengan BPJS?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 8 }"></i>
                    </button>
                    <div x-show="openFaq === 8" x-collapse class="px-6 pb-4">
                        <p class="text-slate-600 dark:text-slate-400">Saat ini kami sedang dalam proses integrasi dengan
                            BPJS Kesehatan. Untuk layanan kunjungan langsung di klinik rekanan, sebagian sudah dapat
                            menggunakan BPJS. Silakan hubungi customer service untuk informasi lebih lanjut.</p>
                    </div>
                </div>

                <!-- FAQ Item 9 -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <button @click="openFaq = openFaq === 9 ? null : 9"
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <span class="font-semibold text-slate-900 dark:text-white">Bagaimana cara menghubungi customer
                            service?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 9 }"></i>
                    </button>
                    <div x-show="openFaq === 9" x-collapse class="px-6 pb-4">
                        <p class="text-slate-600 dark:text-slate-400">Anda dapat menghubungi kami melalui:<br>
                            • WhatsApp: +62 812-3456-7890<br>
                            • Email: support@healthfirst.id<br>
                            • Live Chat di website (24/7)<br>
                            Tim kami siap membantu Anda setiap hari dari pukul 08:00 - 22:00 WIB.</p>
                    </div>
                </div>

                <!-- FAQ Item 10 -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <button @click="openFaq = openFaq === 10 ? null : 10"
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <span class="font-semibold text-slate-900 dark:text-white">Apa itu Health AI Assistant?</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === 10 }"></i>
                    </button>
                    <div x-show="openFaq === 10" x-collapse class="px-6 pb-4">
                        <p class="text-slate-600 dark:text-slate-400">Health AI Assistant adalah fitur chatbot berbasis
                            AI yang dapat membantu menjawab pertanyaan kesehatan umum, memberikan informasi gejala, dan
                            membantu navigasi di platform kami. Perlu diingat bahwa AI bukan pengganti konsultasi dokter
                            untuk diagnosis dan pengobatan.</p>
                    </div>
                </div>
            </div>

            <!-- Contact CTA -->
            <div class="mt-12 text-center bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-8 text-white">
                <h2 class="text-2xl font-bold mb-4">Masih ada pertanyaan?</h2>
                <p class="mb-6 text-blue-100">Tim customer service kami siap membantu Anda 24/7</p>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-semibold rounded-xl hover:bg-blue-50 transition">
                    <i class="fas fa-headset mr-2"></i>
                    Hubungi Kami
                </a>
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
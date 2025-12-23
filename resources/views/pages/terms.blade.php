<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Syarat & Ketentuan - {{ config('app.name', 'HealthFirst Medical') }}</title>

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
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-2">Syarat & Ketentuan</h1>
                <p class="text-slate-500 dark:text-slate-400 mb-8">Terakhir diperbarui: {{ date('d F Y') }}</p>

                <div class="prose prose-slate dark:prose-invert max-w-none">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">1. Pendahuluan</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Selamat datang di HealthFirst Medical. Dengan mengakses dan menggunakan layanan kami, Anda
                        menyetujui untuk terikat dengan syarat dan ketentuan berikut. Mohon baca dengan seksama sebelum
                        menggunakan layanan kami.
                    </p>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">2. Definisi</h2>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li><strong>"Platform"</strong> merujuk pada website, aplikasi mobile, dan semua layanan digital
                            HealthFirst Medical.</li>
                        <li><strong>"Pengguna"</strong> merujuk pada setiap individu yang mengakses atau menggunakan
                            Platform.</li>
                        <li><strong>"Layanan"</strong> merujuk pada semua fitur dan fungsi yang tersedia di Platform.
                        </li>
                        <li><strong>"Tenaga Medis"</strong> merujuk pada dokter dan profesional kesehatan yang terdaftar
                            di Platform.</li>
                    </ul>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">3. Pendaftaran Akun</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Untuk menggunakan layanan tertentu, Anda harus mendaftarkan akun dengan memberikan informasi
                        yang akurat dan lengkap. Anda bertanggung jawab untuk:
                    </p>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li>Menjaga kerahasiaan kata sandi akun Anda</li>
                        <li>Memberikan informasi yang benar dan terkini</li>
                        <li>Segera memberitahu kami jika terjadi akses tidak sah</li>
                    </ul>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">4. Layanan Kesehatan</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        HealthFirst Medical menyediakan platform untuk menghubungkan pasien dengan tenaga medis. Penting
                        untuk dipahami bahwa:
                    </p>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li>Konsultasi online tidak menggantikan pemeriksaan langsung untuk kondisi darurat</li>
                        <li>Informasi kesehatan di platform bersifat edukatif dan tidak menggantikan nasihat medis
                            profesional</li>
                        <li>Keputusan pengobatan tetap menjadi tanggung jawab tenaga medis yang menangani</li>
                    </ul>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">5. Pembayaran dan
                        Pengembalian Dana</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Semua pembayaran untuk layanan harus dilakukan sesuai dengan metode yang tersedia di Platform.
                        Ketentuan pengembalian dana:
                    </p>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li>Pembatalan 24 jam sebelum jadwal: pengembalian dana penuh</li>
                        <li>Pembatalan kurang dari 24 jam: dikenakan biaya administrasi 25%</li>
                        <li>Tidak hadir tanpa pemberitahuan: tidak ada pengembalian dana</li>
                    </ul>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">6. Hak Kekayaan Intelektual
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Seluruh konten di Platform, termasuk namun tidak terbatas pada logo, desain, teks, grafis, dan
                        perangkat lunak, merupakan milik HealthFirst Medical dan dilindungi oleh hukum hak cipta.
                    </p>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">7. Batasan Tanggung Jawab
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        HealthFirst Medical tidak bertanggung jawab atas:
                    </p>
                    <ul class="list-disc list-inside text-slate-600 dark:text-slate-400 space-y-2 mb-4">
                        <li>Kerugian yang timbul dari penggunaan atau ketidakmampuan menggunakan layanan</li>
                        <li>Keputusan yang diambil berdasarkan informasi di Platform</li>
                        <li>Tindakan atau kelalaian pihak ketiga, termasuk tenaga medis independen</li>
                    </ul>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">8. Perubahan Syarat &
                        Ketentuan</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Kami berhak mengubah syarat dan ketentuan ini kapan saja. Perubahan akan berlaku segera setelah
                        dipublikasikan di Platform. Penggunaan berkelanjutan atas layanan kami setelah perubahan berarti
                        Anda menyetujui syarat yang diperbarui.
                    </p>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">9. Hukum yang Berlaku</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Syarat dan ketentuan ini diatur oleh dan ditafsirkan sesuai dengan hukum Republik Indonesia.
                        Setiap perselisihan akan diselesaikan melalui pengadilan yang berwenang di Jakarta, Indonesia.
                    </p>

                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mt-8 mb-4">10. Hubungi Kami</h2>
                    <p class="text-slate-600 dark:text-slate-400 mb-4">
                        Jika Anda memiliki pertanyaan tentang syarat dan ketentuan ini, silakan hubungi kami di:
                    </p>
                    <p class="text-slate-600 dark:text-slate-400">
                        <strong>Email:</strong> legal@healthfirst.id<br>
                        <strong>Telepon:</strong> +62 21 1234 5678<br>
                        <strong>Alamat:</strong> Jl. Kesehatan No. 123, Jakarta Selatan, DKI Jakarta 12345
                    </p>
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
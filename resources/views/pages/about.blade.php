<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tentang Kami - {{ config('app.name', 'HealthFirst Medical') }}</title>

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

        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Tentang HealthFirst Medical</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">Solusi kesehatan digital terpadu untuk pelayanan
                    medis yang lebih cepat, akurat, dan terpercaya.</p>
            </div>
        </section>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- About Section -->
            <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">Visi Kami</h2>
                    <p class="text-lg text-slate-600 dark:text-slate-400 mb-4">
                        HealthFirst Medical hadir sebagai platform kesehatan digital yang menghubungkan pasien dengan
                        tenaga medis profesional melalui teknologi modern.
                    </p>
                    <p class="text-lg text-slate-600 dark:text-slate-400">
                        Kami percaya bahwa setiap orang berhak mendapatkan akses layanan kesehatan yang mudah, cepat,
                        dan berkualitas. Melalui platform kami, Anda dapat berkonsultasi dengan dokter, menebus resep
                        obat, dan mengelola rekam medis Anda di mana saja dan kapan saja.
                    </p>
                </div>
                <div
                    class="bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-2xl p-8">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 dark:text-blue-400">100+</div>
                            <div class="text-sm text-slate-600 dark:text-slate-400 mt-1">Dokter Spesialis</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 dark:text-blue-400">10K+</div>
                            <div class="text-sm text-slate-600 dark:text-slate-400 mt-1">Pasien Terdaftar</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 dark:text-blue-400">50K+</div>
                            <div class="text-sm text-slate-600 dark:text-slate-400 mt-1">Konsultasi Sukses</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 dark:text-blue-400">4.9</div>
                            <div class="text-sm text-slate-600 dark:text-slate-400 mt-1">Rating Kepuasan</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Values Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white text-center mb-12">Nilai-Nilai Kami</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-slate-700">
                        <div
                            class="w-14 h-14 bg-blue-100 dark:bg-blue-900/50 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-heart text-2xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Kepedulian</h3>
                        <p class="text-slate-600 dark:text-slate-400">Kami menempatkan kesehatan dan kenyamanan pasien
                            sebagai prioritas utama dalam setiap layanan yang kami berikan.</p>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-slate-700">
                        <div
                            class="w-14 h-14 bg-emerald-100 dark:bg-emerald-900/50 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-shield-alt text-2xl text-emerald-600 dark:text-emerald-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Keamanan</h3>
                        <p class="text-slate-600 dark:text-slate-400">Data medis Anda dilindungi dengan standar keamanan
                            tertinggi dan enkripsi end-to-end untuk privasi maksimal.</p>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-slate-700">
                        <div
                            class="w-14 h-14 bg-purple-100 dark:bg-purple-900/50 rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-bolt text-2xl text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4">Inovasi</h3>
                        <p class="text-slate-600 dark:text-slate-400">Kami terus berinovasi dengan teknologi terkini
                            untuk memberikan pengalaman layanan kesehatan yang lebih baik.</p>
                    </div>
                </div>
            </div>

            <!-- Team Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white text-center mb-12">Tim Kami</h2>
                <div class="grid md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div
                            class="w-32 h-32 mx-auto bg-slate-200 dark:bg-slate-700 rounded-full mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-slate-400"></i>
                        </div>
                        <h3 class="font-semibold text-slate-900 dark:text-white">Dr. Budi Santoso</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">CEO & Founder</p>
                    </div>
                    <div class="text-center">
                        <div
                            class="w-32 h-32 mx-auto bg-slate-200 dark:bg-slate-700 rounded-full mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-slate-400"></i>
                        </div>
                        <h3 class="font-semibold text-slate-900 dark:text-white">Siti Rahayu</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Chief Medical Officer</p>
                    </div>
                    <div class="text-center">
                        <div
                            class="w-32 h-32 mx-auto bg-slate-200 dark:bg-slate-700 rounded-full mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-slate-400"></i>
                        </div>
                        <h3 class="font-semibold text-slate-900 dark:text-white">Ahmad Wijaya</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Chief Technology Officer</p>
                    </div>
                    <div class="text-center">
                        <div
                            class="w-32 h-32 mx-auto bg-slate-200 dark:bg-slate-700 rounded-full mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-4xl text-slate-400"></i>
                        </div>
                        <h3 class="font-semibold text-slate-900 dark:text-white">Lisa Hartono</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Head of Operations</p>
                    </div>
                </div>
            </div>

            <!-- Certifications -->
            <div
                class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-slate-700">
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white text-center mb-8">Sertifikasi & Akreditasi
                </h2>
                <div class="flex flex-wrap justify-center items-center gap-8">
                    <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-700 rounded-xl px-6 py-4">
                        <img src="{{ asset('images/bsi-logo-security.webp') }}" alt="ISO 27001"
                            class="h-12 w-auto object-contain" />
                        <span class="font-semibold text-slate-700 dark:text-slate-300">ISO 27001</span>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-700 rounded-xl px-6 py-4">
                        <img src="{{ asset('images/logo_ministry_of_health_large.webp') }}" alt="Kemenkes RI"
                            class="h-12 w-auto object-contain" />
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Kemenkes RI</span>
                    </div>
                    <div class="flex items-center gap-3 bg-slate-50 dark:bg-slate-700 rounded-xl px-6 py-4">
                        <img src="{{ asset('images/legit-script-cert.webp') }}" alt="LegitScript"
                            class="h-12 w-auto object-contain" />
                        <span class="font-semibold text-slate-700 dark:text-slate-300">LegitScript</span>
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
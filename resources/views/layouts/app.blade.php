<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>HealthFirst Medical - Layanan Kesehatan Terpercaya</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/LogoRs.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-gradient-to-r from-gray-800 to-gray-900 shadow-lg">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="text-white">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endisset
            
            @hasSection('header')
                <header class="bg-gradient-to-r from-gray-800 to-gray-900 shadow-lg">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="text-white">
                            @yield('header')
                        </div>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </main>

            <!-- Footer -->
            <footer class="bg-pink-50 py-12 mt-16">
                <div class="container mx-auto px-4">
                    <!-- Top Section with Logo -->
                    <div class="mb-8">
                        <div class="flex items-center mb-6">
                            <img src="{{ asset('images/LogoRs.png') }}" alt="HealthFirst Medical" class="h-10 w-auto mr-2">
                            <span class="text-2xl font-bold text-purple-600">HealthFirst Medical</span>
                        </div>

                        <!-- Info Banner -->
                        <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-2xl p-6 flex items-center justify-between mb-8">
                            <div class="flex items-center space-x-4">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="text-white">
                                    <p class="text-xl font-bold">Kesehatan Anda Prioritas Kami</p>
                                    <p class="text-lg">Layanan Terbaik, Kepercayaan Utama</p>
                                </div>
                            </div>
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Footer Links Grid -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-8">
                        <!-- Layanan -->
                        <div>
                            <h3 class="font-bold text-purple-600 text-sm mb-4 uppercase tracking-wide">Layanan Kami</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Konsultasi Dokter</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Rawat Jalan</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Rawat Inap</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Laboratorium</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Apotek</a></li>
                            </ul>
                        </div>

                        <!-- Informasi -->
                        <div>
                            <h3 class="font-bold text-purple-600 text-sm mb-4 uppercase tracking-wide">Informasi</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Tentang Kami</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Dokter Kami</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Fasilitas</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Jadwal Dokter</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Artikel Kesehatan</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Promo & Paket</a></li>
                            </ul>
                        </div>

                        <!-- Bantuan -->
                        <div>
                            <h3 class="font-bold text-purple-600 text-sm mb-4 uppercase tracking-wide">Bantuan</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">FAQ</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Syarat & Ketentuan</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Kebijakan Privasi</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Karir</a></li>
                                <li><a href="#" class="text-gray-700 hover:text-purple-600 text-sm transition">Hubungi Kami</a></li>
                            </ul>
                        </div>

                        <!-- Contact -->
                        <div>
                            <div class="mb-4">
                                <div class="flex items-center space-x-2 mb-2">
                                    <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <a href="mailto:info@healthfirst.com" class="text-gray-700 hover:text-purple-600 text-sm transition">info@healthfirst.com</a>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <a href="tel:021-1234-5678" class="text-gray-700 hover:text-purple-600 text-sm transition">(021) 1234-5678</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security & Certification -->
                    <div class="border-t border-gray-200 pt-8">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div>
                                <h4 class="font-bold text-pink-500 text-xs mb-4 uppercase tracking-wide">Keamanan & Privasi</h4>
                                <div class="flex items-center space-x-4">
                                    <div class="bg-white border border-gray-200 rounded-lg p-3 flex items-center gap-2">
                                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                                        </svg>
                                        <span class="text-xs font-semibold text-gray-700">ISO 27001</span>
                                    </div>
                                    <div class="bg-white border border-gray-200 rounded-lg p-3 flex items-center gap-2">
                                        <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                                        </svg>
                                        <span class="text-xs font-semibold text-gray-700">SSL Secure</span>
                                    </div>
                                    <div class="bg-white border border-gray-200 rounded-lg p-3 flex items-center gap-2">
                                        <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                                        </svg>
                                        <span class="text-xs font-semibold text-gray-700">Data Protected</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3 bg-white border border-gray-200 rounded-lg px-4 py-2">
                                <span class="text-gray-600 text-sm">Dibina oleh</span>
                                <div class="flex items-center gap-2">
                                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                    <span class="text-xs font-bold text-gray-700">Kemenkes RI</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <div class="border-t border-gray-200 mt-8 pt-6 text-center">
                        <p class="text-gray-600 text-sm">© 2025 HealthFirst Medical. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>

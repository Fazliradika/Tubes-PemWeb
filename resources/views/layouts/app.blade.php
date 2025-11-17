<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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
                    <!-- Top Section with Logo and Services -->
                    <div class="mb-8">
                        <div class="flex items-center mb-6">
                            <img src="{{ asset('images/LogoRs.png') }}" alt="HealthFirst Medical" class="h-10 w-auto mr-2">
                            <span class="text-2xl font-bold text-purple-600">HealthFirst Medical</span>
                        </div>

                        <!-- Service Icons -->
                        <div class="flex flex-wrap gap-3 mb-6">
                            <a href="{{ route('chat.index') }}" class="flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-200 hover:border-pink-500 transition text-sm">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                                <span class="text-gray-700">Chat dengan Dokter</span>
                            </a>
                            <a href="#" class="flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-200 hover:border-pink-500 transition text-sm">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span class="text-gray-700">Toko Kesehatan</span>
                            </a>
                            <a href="#" class="flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-200 hover:border-pink-500 transition text-sm">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                <span class="text-gray-700">Homecare</span>
                            </a>
                            <a href="#" class="flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-200 hover:border-pink-500 transition text-sm">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <span class="text-gray-700">Asuransiku</span>
                            </a>
                            <a href="#" class="flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-200 hover:border-pink-500 transition text-sm">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-gray-700">Haloskin</span>
                            </a>
                            <a href="#" class="flex items-center space-x-2 px-4 py-2 bg-white rounded-full border border-gray-200 hover:border-pink-500 transition text-sm">
                                <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="text-gray-700">Halofit</span>
                            </a>
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
                                    <div class="bg-white border border-gray-200 rounded-lg p-2">
                                        <img src="https://www.bsigroup.com/LocalFiles/id-id/sertifikasi/BSI-Assurance-Mark-ISMS-27001-KEYB.png" alt="ISO 27001" class="h-12 w-auto object-contain">
                                    </div>
                                    <div class="bg-white border border-gray-200 rounded-lg p-2">
                                        <img src="https://www.bsigroup.com/LocalFiles/id-id/sertifikasi/BSI-Assurance-Mark-ISMS-27017-KEYB.png" alt="ISO 27017" class="h-12 w-auto object-contain">
                                    </div>
                                    <div class="bg-white border border-gray-200 rounded-lg p-2">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/LegalScript_Certified_Logo.svg/200px-LegalScript_Certified_Logo.svg.png" alt="LegalScript Certified" class="h-12 w-auto object-contain">
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600 text-sm">Dibina oleh</span>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/Kemenkes_RI_new_logo.png/200px-Kemenkes_RI_new_logo.png" alt="Kemenkes" class="h-12 w-auto object-contain">
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

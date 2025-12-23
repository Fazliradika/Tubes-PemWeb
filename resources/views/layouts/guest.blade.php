<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-100 bg-gray-900">
        <div class="min-h-screen flex bg-[#0B1120]">
            <!-- Left Side - Branding (Hidden on mobile) -->
            <div class="hidden lg:flex lg:w-1/2 relative flex-col justify-center px-16 text-white">
                <!-- Content -->
                <div class="relative z-10 max-w-lg">
                    <div class="flex items-center gap-3 mb-12">
                        <img src="{{ asset('images/LOGO_HealthFirst.png') }}" alt="HealthFirst Medical Logo" class="w-10 h-10 object-contain rounded bg-white p-1">
                        <span class="text-xl font-bold">Health First Medical</span>
                    </div>

                    <h1 class="text-5xl font-bold mb-6 leading-tight">
                        Layanan Kesehatan <br />
                        <span class="text-blue-500">Digital</span> Terpercaya
                    </h1>
                    
                    <p class="text-gray-400 text-lg mb-10 leading-relaxed">
                        Konsultasi dengan dokter professional, booking appointment, dan kelola rekam medis Anda dengan mudah, kapan saja dan dimana saja.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white">Konsultasi Online 24/7</h3>
                                <p class="text-sm text-gray-400 mt-1">Dapatkan konsultasi dengan dokter berpengalaman kapan pun Anda membutuhkan</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white">Booking Appointment</h3>
                                <p class="text-sm text-gray-400 mt-1">Jadwalkan pemeriksaan kesehatan Anda dengan mudah dan cepat</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-500/20 flex items-center justify-center mt-1">
                                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-white">Rekam Medis Digital</h3>
                                <p class="text-sm text-gray-400 mt-1">Akses riwayat kesehatan Anda dengan aman dan terpercaya</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="flex-1 flex flex-col justify-center items-center p-6 sm:p-12 bg-[#111827] border-l border-gray-800">
                <div class="w-full max-w-md">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden text-center mb-8">
                        <img src="{{ asset('images/LOGO_HealthFirst.png') }}" alt="HealthFirst Medical Logo" class="w-16 h-16 mx-auto rounded-lg bg-white p-1">
                        <h2 class="mt-4 text-2xl font-bold text-white">HealthFirst</h2>
                    </div>

                    <div class="bg-gradient-to-b from-[#112240] to-[#064e3b] p-8 rounded-2xl shadow-2xl border border-gray-700">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

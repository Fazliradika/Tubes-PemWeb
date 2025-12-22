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
    <body class="font-sans antialiased text-gray-900 bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen flex text-gray-900 dark:text-gray-100">
            <!-- Left Side - Branding (Hidden on mobile) -->
            <div class="hidden lg:flex lg:w-1/2 bg-blue-600 dark:bg-slate-800 relative overflow-hidden flex-col justify-center items-center text-center p-12">
                <!-- Background Gradient/Pattern -->
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-indigo-700 dark:from-slate-800 dark:to-slate-900"></div>
                
                <!-- Decorative Elements -->
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-500 opacity-20 rounded-full blur-3xl"></div>

                <!-- Content -->
                <div class="relative z-10 text-white">
                    <img src="{{ asset('images/logo-new.jpg') }}" alt="HealthFirst Logo" class="w-32 h-32 mx-auto mb-8 rounded-2xl shadow-2xl object-cover transform hover:scale-105 transition duration-500">
                    <h1 class="text-4xl font-bold mb-4 tracking-tight">HealthFirst Medical</h1>
                    <p class="text-lg text-blue-100 max-w-md mx-auto leading-relaxed">
                        Layanan kesehatan digital terpercaya untuk Anda dan keluarga. Akses konsultasi dokter dan tebus resep obat dengan mudah dan cepat.
                    </p>
                </div>

                <!-- Bottom Copyright -->
                <div class="absolute bottom-8 text-blue-200 text-sm">
                    &copy; {{ date('Y') }} HealthFirst Medical. All rights reserved.
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="flex-1 flex flex-col justify-center items-center p-6 sm:p-12 bg-white dark:bg-gray-900">
                <div class="w-full max-w-md space-y-8">
                    <!-- Mobile Logo (Visible only on mobile) -->
                    <div class="lg:hidden text-center mb-8">
                        <img src="{{ asset('images/logo-new.jpg') }}" alt="Logo" class="w-20 h-20 mx-auto rounded-xl shadow-md object-cover">
                        <h2 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white">HealthFirst</h2>
                    </div>

                    <!-- Slot Content -->
                    <div class="w-full">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

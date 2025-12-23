<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HealthFirst Medical') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        
        .dark .glass-nav {
            background: rgba(15, 23, 42, 0.9);
        }

        .dark-mode-toggle {
            width: 60px;
            height: 30px;
            padding: 4px;
            border-radius: 100px;
            background: #e2e8f0;
            transition: all 0.3s ease;
        }

        .dark .dark-mode-toggle {
            background: #334155;
        }

        .toggle-circle {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .dark ::-webkit-scrollbar-track {
            background: #1e293b;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
        }
    </style>
</head>
<body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 transition-colors duration-300">
    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white/70 dark:bg-slate-900/70 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 sticky top-24 z-40 transition-colors duration-300">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @elseif(View::hasSection('header'))
            <header class="bg-white/70 dark:bg-slate-900/70 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 sticky top-24 z-40 transition-colors duration-300">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endhasSection

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <!-- Toast Notifications -->
        <div id="toast-container" class="fixed bottom-5 right-5 z-[100] flex flex-col gap-3 pointer-events-none"></div>

        <!-- Footer -->
        <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-1">
                        <div class="flex items-center gap-2 mb-4">
                            <img src="{{ asset('images/LOGO_HealthFirst.png') }}" alt="Logo" class="h-10 w-auto" />
                            <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-400 dark:to-indigo-400 bg-clip-text text-transparent">HealthFirst</span>
                        </div>
                        <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                            Solusi kesehatan digital terpadu untuk pelayanan medis yang lebih cepat, akurat, dan terpercaya. Karena kesehatan Anda adalah prioritas utama kami.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white mb-4">Layanan Kami</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition">Konsultasi Dokter</a></li>
                            <li><a href="#" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition">Check Up Kesehatan</a></li>
                            <li><a href="#" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition">Apotek Online</a></li>
                            <li><a href="#" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition">Rekam Medis Digital</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition">Tentang Kami</a></li>
                            <li><a href="#" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition">Hubungi Kami</a></li>
                            <li><a href="#" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition">Syarat & Ketentuan</a></li>
                            <li><a href="#" class="text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white mb-4">Newsletter</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">Dapatkan info kesehatan dan promo menarik langsung di email Anda.</p>
                        <form class="flex gap-2">
                            <input type="email" placeholder="Email Anda" class="flex-grow px-4 py-2 rounded-lg bg-slate-100 dark:bg-slate-800 border-transparent focus:border-blue-500 focus:ring-0 text-sm transition" />
                            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition shadow-md shadow-blue-500/20">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
<<<<<<< HEAD
                <div class="mt-12 pt-8 border-t border-slate-200 dark:border-slate-800 flex flex-col md:row items-center justify-between gap-4">
                    <p class="text-sm text-slate-500 dark:text-slate-500">
                        &copy; {{ date('Y') }} HealthFirst Medical. All rights reserved.
                    </p>
                    <div class="flex gap-6">
                        <a href="#" class="text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition text-lg"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-slate-400 hover:text-pink-600 dark:hover:text-pink-400 transition text-lg"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-slate-400 hover:text-blue-400 dark:hover:text-blue-400 transition text-lg"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-slate-400 hover:text-red-600 dark:hover:text-red-400 transition text-lg"><i class="fab fa-youtube"></i></a>
=======

                <!-- Security & Certification -->
                <div class="border-t border-blue-200/50 dark:border-blue-800/50 pt-8">
                    <h4 class="font-bold text-blue-600 dark:text-blue-400 text-xs mb-4 uppercase tracking-wide">
                        Keamanan & Privasi</h4>

                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="glass-card rounded-xl px-4 py-3 flex items-center gap-3">
                                <img src="{{ asset('images/bsi-logo-security.webp') }}" alt="BSI ISO 27001" class="h-10 w-auto object-contain" />
                                <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">ISO 27001</span>
                            </div>
                            <div class="glass-card rounded-xl px-4 py-3 flex items-center gap-3">
                                <img src="{{ asset('images/bsi-logo-privacy.webp') }}" alt="BSI Privacy" class="h-10 w-auto object-contain" />
                                <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">Privacy</span>
                            </div>
                            <div class="glass-card rounded-xl px-4 py-3 flex items-center gap-3">
                                <img src="{{ asset('images/legit-script-cert.webp') }}" alt="LegitScript Certified" class="h-10 w-auto object-contain" />
                                <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">Certified</span>
                            </div>
                        </div>

                        <div class="glass-card rounded-xl px-4 py-3 flex items-center">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('images/logo_ministry_of_health_large.webp') }}" alt="Kemenkes RI" class="h-10 w-auto object-contain" />
                                <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Kemenkes RI</span>
                            </div>
                        </div>
>>>>>>> ea29bc99639dd67721f132d42a535f40d730c40c
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        // Toast Implementation
        window.showToast = function(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            const colors = {
                success: 'bg-emerald-500',
                error: 'bg-rose-500',
                warning: 'bg-amber-500',
                info: 'bg-blue-500'
            };

            const icons = {
                success: 'fa-check-circle',
                error: 'fa-exclamation-circle',
                warning: 'fa-exclamation-triangle',
                info: 'fa-info-circle'
            };

            toast.className = `pointer-events-auto flex items-center gap-3 px-6 py-4 rounded-2xl text-white shadow-2xl transform translate-y-full opacity-0 transition-all duration-500 ease-out ${colors[type] || colors.info}`;
            toast.innerHTML = `
                <i class="fas ${icons[type] || icons.info} text-xl"></i>
                <p class="font-medium">${message}</p>
                <button onclick="this.parentElement.remove()" class="ml-2 hover:opacity-75 transition">
                    <i class="fas fa-times"></i>
                </button>
            `;

            container.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-y-full', 'opacity-0');
            }, 100);

            // Auto Remove
            setTimeout(() => {
                toast.classList.add('translate-y-[-20px]', 'opacity-0');
                setTimeout(() => toast.remove(), 500);
            }, 5000);
        };

        // DOM Content Loaded to handle Blade Sessions
        document.addEventListener('DOMContentLoaded', function () {
            @php
                $notifications = [
                    'success' => session('success'),
                    'error' => session('error'),
                    'warning' => session('warning'),
                    'info' => session('info'),
                ];
            @endphp

            @foreach($notifications as $type => $message)
                @if($message)
                    window.showToast(@json($message), @json($type));
                @endif
            @endforeach
        });
    </script>
    @stack('scripts')
</body>
</html>
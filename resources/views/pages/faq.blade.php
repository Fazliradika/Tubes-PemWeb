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
                @forelse($faqs as $index => $faq)
                <!-- FAQ Item {{ $index + 1 }} -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <button @click="openFaq = openFaq === {{ $index + 1 }} ? null : {{ $index + 1 }}"
                        class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                        <span class="font-semibold text-slate-900 dark:text-white">{{ $faq->question }}</span>
                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                            :class="{ 'rotate-180': openFaq === {{ $index + 1 }} }"></i>
                    </button>
                    <div x-show="openFaq === {{ $index + 1 }}" x-collapse class="px-6 pb-4">
                        <p class="text-slate-600 dark:text-slate-400">{!! nl2br(e($faq->answer)) !!}</p>
                    </div>
                </div>
                @empty
                <!-- No FAQs available -->
                <div class="text-center py-12">
                    <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center">
                        <i class="fas fa-question-circle text-3xl text-slate-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-700 dark:text-slate-300 mb-2">Belum ada FAQ</h3>
                    <p class="text-slate-500 dark:text-slate-400">FAQ akan segera ditambahkan. Silakan hubungi kami jika ada pertanyaan.</p>
                </div>
                @endforelse
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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hubungi Kami - {{ config('app.name', 'HealthFirst Medical') }}</title>

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
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-4">Hubungi Kami</h1>
                <p class="text-lg text-slate-600 dark:text-slate-400">Kami siap membantu Anda. Jangan ragu untuk
                    menghubungi kami melalui berbagai saluran berikut.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div class="space-y-8">
                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-slate-700">
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Informasi Kontak</h2>

                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-xl text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white mb-1">Alamat</h3>
                                    <p class="text-slate-600 dark:text-slate-400">Jl. Kesehatan No. 123<br>Jakarta
                                        Selatan, DKI Jakarta 12345<br>Indonesia</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/50 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone-alt text-xl text-emerald-600 dark:text-emerald-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white mb-1">Telepon</h3>
                                    <p class="text-slate-600 dark:text-slate-400">+62 21 1234 5678<br>+62 812 3456 7890
                                        (WhatsApp)</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-purple-100 dark:bg-purple-900/50 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-xl text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white mb-1">Email</h3>
                                    <p class="text-slate-600 dark:text-slate-400">
                                        support@healthfirst.id<br>info@healthfirst.id</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-amber-100 dark:bg-amber-900/50 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-clock text-xl text-amber-600 dark:text-amber-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-slate-900 dark:text-white mb-1">Jam Operasional</h3>
                                    <p class="text-slate-600 dark:text-slate-400">Senin - Jumat: 08:00 - 22:00
                                        WIB<br>Sabtu - Minggu: 09:00 - 18:00 WIB<br>Customer Service: 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-slate-700">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Ikuti Kami</h2>
                        <div class="flex gap-4">
                            <a href="#"
                                class="w-12 h-12 bg-blue-600 hover:bg-blue-700 rounded-xl flex items-center justify-center text-white transition">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-pink-600 hover:bg-pink-700 rounded-xl flex items-center justify-center text-white transition">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-sky-500 hover:bg-sky-600 rounded-xl flex items-center justify-center text-white transition">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-red-600 hover:bg-red-700 rounded-xl flex items-center justify-center text-white transition">
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                            <a href="#"
                                class="w-12 h-12 bg-blue-800 hover:bg-blue-900 rounded-xl flex items-center justify-center text-white transition">
                                <i class="fab fa-linkedin-in text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div
                    class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-slate-700">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">Kirim Pesan</h2>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 rounded-r-xl flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <span class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nama
                                Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="Masukkan nama Anda">
                            @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="email@example.com">
                            @error('email') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="phone"
                                class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Nomor
                                Telepon</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                placeholder="+62 xxx xxxx xxxx">
                            @error('phone') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="subject"
                                class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Subjek <span class="text-red-500">*</span></label>
                            <select id="subject" name="subject" required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                <option value="">Pilih subjek...</option>
                                <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>Pertanyaan Umum</option>
                                <option value="appointment" {{ old('subject') == 'appointment' ? 'selected' : '' }}>Janji Temu</option>
                                <option value="payment" {{ old('subject') == 'payment' ? 'selected' : '' }}>Pembayaran</option>
                                <option value="technical" {{ old('subject') == 'technical' ? 'selected' : '' }}>Masalah Teknis</option>
                                <option value="complaint" {{ old('subject') == 'complaint' ? 'selected' : '' }}>Keluhan</option>
                                <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('subject') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="message"
                                class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Pesan <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="5" required
                                class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"
                                placeholder="Tulis pesan Anda di sini... (minimal 10 karakter)">{{ old('message') }}</textarea>
                            @error('message') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit"
                            class="w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl transition shadow-lg shadow-blue-500/20">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Map Section -->
            <div
                class="mt-12 bg-white dark:bg-slate-800 rounded-2xl overflow-hidden shadow-sm border border-slate-200 dark:border-slate-700">
                <div class="h-[400px] bg-slate-200 dark:bg-slate-700 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-map-marked-alt text-6xl text-slate-400 dark:text-slate-500 mb-4"></i>
                        <p class="text-slate-500 dark:text-slate-400">Peta Lokasi</p>
                        <p class="text-sm text-slate-400 dark:text-slate-500 mt-2">Integrasi Google Maps tersedia di
                            versi production</p>
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
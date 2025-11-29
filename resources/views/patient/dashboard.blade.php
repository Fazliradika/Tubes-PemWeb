<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card - Primary Blue -->
            <div class="bg-gradient-to-r from-emerald-600 to-teal-500 overflow-hidden shadow-lg sm:rounded-2xl mb-6">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Welcome, {{ $patient->name }}!</h3>
                    <p class="text-emerald-100">Manage your health and appointments</p>
                </div>
            </div>

            <!-- Stats Grid - With Dark Mode Support -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Upcoming Appointments -->
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-slate-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl p-3">
                                <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Upcoming Appointments</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">2</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Medical Records -->
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-slate-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-teal-50 dark:bg-teal-900/30 rounded-xl p-3">
                                <svg class="h-6 w-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Medical Records</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">15</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Prescriptions -->
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-slate-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-cyan-50 dark:bg-cyan-900/30 rounded-xl p-3">
                                <svg class="h-6 w-6 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Prescriptions</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $activePrescriptionsCount ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Appointments - Harmonized -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-slate-700 mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Your Upcoming Appointments</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800/50 rounded-xl">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 bg-emerald-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Dr. Ahmad Fadli</p>
                                    <p class="text-xs text-emerald-600 dark:text-emerald-400">Cardiologist</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-400 mt-1">General Checkup</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Tomorrow</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">10:00 AM</p>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-800/50 text-emerald-700 dark:text-emerald-300 mt-2">
                                    Confirmed
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800/50 rounded-xl">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 bg-emerald-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Dr. Citra Dewi</p>
                                    <p class="text-xs text-emerald-600 dark:text-emerald-400">Dermatologist</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-400 mt-1">Skin Consultation</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">Nov 5, 2025</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">02:30 PM</p>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-800/50 text-emerald-700 dark:text-emerald-300 mt-2">
                                    Confirmed
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions - Unified Theme with Dark Mode -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-slate-700 mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('appointments.index') }}" class="flex flex-col items-center justify-center p-4 bg-emerald-50 dark:bg-emerald-900/20 hover:bg-emerald-100 dark:hover:bg-emerald-900/40 border border-emerald-100 dark:border-emerald-800/50 rounded-xl transition">
                            <svg class="h-8 w-8 text-emerald-600 dark:text-emerald-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Book Appointment</span>
                        </a>
                        <a href="{{ route('appointments.my-appointments') }}" class="flex flex-col items-center justify-center p-4 bg-teal-50 dark:bg-teal-900/20 hover:bg-teal-100 dark:hover:bg-teal-900/40 border border-teal-100 dark:border-teal-800/50 rounded-xl transition">
                            <svg class="h-8 w-8 text-teal-600 dark:text-teal-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">My Appointments</span>
                        </a>
                        <a href="{{ route('prescriptions.index') }}" class="flex flex-col items-center justify-center p-4 bg-cyan-50 dark:bg-cyan-900/20 hover:bg-cyan-100 dark:hover:bg-cyan-900/40 border border-cyan-100 dark:border-cyan-800/50 rounded-xl transition">
                            <svg class="h-8 w-8 text-cyan-600 dark:text-cyan-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Prescriptions</span>
                        </a>
                        <a href="{{ route('chat.index') }}" class="flex flex-col items-center justify-center p-4 bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700 border border-slate-100 dark:border-slate-600 rounded-xl transition">
                            <svg class="h-8 w-8 text-slate-600 dark:text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Messages</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Health Articles Section - With Dark Mode -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-slate-700 mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Artikel Kesehatan Terkini untuk Anda</h3>
                    </div>

                    <!-- Articles Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Article 1 -->
                        <a href="{{ route('articles.show', '7-makanan-yang-bikin-kurus-cocok-untuk-menu-diet-harian') }}" class="article-card block" data-category="Hidup Sehat">
                            <div class="bg-white dark:bg-slate-700 border border-gray-100 dark:border-slate-600 rounded-xl overflow-hidden hover:shadow-lg hover:border-emerald-200 dark:hover:border-emerald-700 transition-all duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&h=250&fit=crop" 
                                         alt="Healthy Food" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-emerald-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Hidup Sehat
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-2 hover:text-emerald-600 dark:hover:text-emerald-400 cursor-pointer">
                                        7 Makanan yang Bikin Kurus, Cocok untuk Menu Diet Harian
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        Makanan yang bikin kurus menjadi incaran banyak orang yang ingin menurunkan berat badan tanpa rasa lapar atau tersiksa. Dengan memilih...
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 dark:text-gray-400">
                                        <span>5 min read</span>
                                        <span>• 2 hari lalu</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Article 2 -->
                        <a href="{{ route('articles.show', 'tips-olahraga-efektif-untuk-kesehatan-jantung') }}" class="article-card block" data-category="Olahraga">
                            <div class="bg-white dark:bg-slate-700 border border-gray-100 dark:border-slate-600 rounded-xl overflow-hidden hover:shadow-lg hover:border-teal-200 dark:hover:border-teal-700 transition-all duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=400&h=250&fit=crop" 
                                         alt="Exercise" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-teal-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Olahraga
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-2 hover:text-emerald-600 dark:hover:text-emerald-400 cursor-pointer">
                                        Tips Olahraga yang Efektif untuk Kesehatan Jantung
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        Olahraga teratur sangat penting untuk menjaga kesehatan jantung. Pelajari jenis olahraga yang paling efektif untuk meningkatkan fungsi...
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>7 min read</span>
                                        <span>• 3 hari lalu</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Article 3 -->
                        <a href="{{ route('articles.show', 'mengelola-diabetes-dengan-pola-makan-sehat') }}" class="article-card block" data-category="Diabetes">
                            <div class="bg-white dark:bg-slate-700 border border-gray-100 dark:border-slate-600 rounded-xl overflow-hidden hover:shadow-lg hover:border-cyan-200 dark:hover:border-cyan-700 transition-all duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=400&h=250&fit=crop" 
                                         alt="Diabetes" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-cyan-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Diabetes
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-2 hover:text-emerald-600 dark:hover:text-emerald-400 cursor-pointer">
                                    Mengelola Diabetes dengan Pola Makan Sehat
                                </h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                    Pola makan yang tepat sangat penting bagi penderita diabetes. Temukan panduan lengkap tentang makanan yang aman dan nutrisi yang...
                                </p>
                                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <span>6 min read</span>
                                    <span>• 4 hari lalu</span>
                                </div>
                            </div>
                        </div>

                        <!-- Article 4 -->
                        <a href="{{ route('articles.show', 'pentingnya-vitamin-dan-mineral-untuk-tubuh') }}" class="article-card block" data-category="Nutrisi">
                            <div class="bg-white dark:bg-slate-700 border border-gray-200 dark:border-slate-600 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=400&h=250&fit=crop" 
                                         alt="Nutrition" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-yellow-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Nutrisi
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-2 hover:text-emerald-600 dark:hover:text-emerald-400 cursor-pointer">
                                        Pentingnya Vitamin dan Mineral untuk Tubuh
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        Vitamin dan mineral adalah nutrisi esensial yang dibutuhkan tubuh. Pelajari manfaat masing-masing vitamin dan sumber makanan terbaik...
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>8 min read</span>
                                        <span>• 5 hari lalu</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Article 5 -->
                        <a href="{{ route('articles.show', 'cara-mengatasi-stres-dan-menjaga-kesehatan-mental') }}" class="article-card block" data-category="Kesehatan Mental">
                            <div class="bg-white dark:bg-slate-700 border border-gray-200 dark:border-slate-600 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=250&fit=crop" 
                                         alt="Mental Health" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-purple-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Kesehatan Mental
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-2 hover:text-emerald-600 dark:hover:text-emerald-400 cursor-pointer">
                                        Cara Mengatasi Stres dan Menjaga Kesehatan Mental
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        Kesehatan mental sama pentingnya dengan kesehatan fisik. Temukan strategi efektif untuk mengelola stres dan meningkatkan kesejahteraan...
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>10 min read</span>
                                        <span>• 1 minggu lalu</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Article 6 -->
                        <a href="{{ route('articles.show', 'tips-tidur-berkualitas-untuk-kulit-sehat-dan-bercahaya') }}" class="article-card block" data-category="Kecantikan">
                            <div class="bg-white dark:bg-slate-700 border border-gray-200 dark:border-slate-600 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?w=400&h=250&fit=crop"
                                         alt="Sleep" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-indigo-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Kecantikan
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-2 hover:text-emerald-600 dark:hover:text-emerald-400 cursor-pointer">
                                        Tips Tidur Berkualitas untuk Kulit Sehat dan Bercahaya
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        Tidur yang cukup dan berkualitas sangat penting untuk kesehatan kulit. Pelajari bagaimana tidur mempengaruhi kecantikan dan tips untuk...
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                        <span>6 min read</span>
                                        <span>• 1 minggu lalu</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- View All Button -->
                    <div class="text-center mt-8">
                        <a href="{{ route('articles.index') }}" class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors duration-200">
                            <span>Lihat Semua Artikel</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Patient Testimonials -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-slate-700 mb-6">
                <div class="p-8">
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Kata Mereka tentang HealthFirst Medical</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-10 max-w-3xl">
                        Cerita dari pasien yang merasakan layanan kesehatan cepat, aman, dan nyaman di HealthFirst Medical.
                    </p>

                    <div class="grid md:grid-cols-3 gap-8">
                        <!-- Testimonial 1 -->
                        <div class="flex flex-col space-y-5">
                            <div class="flex items-start space-x-4">
                                <img src="https://i.pravatar.cc/80?img=68" alt="Sainem Wiyono" class="w-14 h-14 rounded-full object-cover border border-gray-200" />
                                <div>
                                    <p class="italic text-gray-800 dark:text-gray-200 leading-relaxed">
                                        “Sangat membantu.. malam2 butuh obat, gak perlu keluar rumah”
                                    </p>
                                    <p class="uppercase tracking-wide text-[11px] text-gray-500 dark:text-gray-400 mt-3">SAINEM WIYONO</p>
                                </div>
                            </div>
                            <button class="w-fit px-5 py-2 border border-blue-500 dark:border-blue-400 text-blue-500 dark:text-blue-400 rounded-full text-xs font-semibold hover:bg-blue-50 dark:hover:bg-blue-900/20 transition">
                                Lihat Layanan
                            </button>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="flex flex-col space-y-5">
                            <div class="flex items-start space-x-4">
                                <div class="w-14 h-14 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                    <span class="text-blue-500 dark:text-blue-400 font-semibold text-lg">L</span>
                                </div>
                                <div>
                                    <p class="italic text-gray-800 dark:text-gray-200 leading-relaxed">
                                        “Sangat Helpful!!! Terima kasih yaa, sangat menghemat waktu dan respon dokternya juga baik. resep obatnya juga manjur sekali, thank u ya semoga kedepannya tambah keren lagi.”
                                    </p>
                                    <p class="uppercase tracking-wide text-[11px] text-gray-500 dark:text-gray-400 mt-3">LINTANG ANINDHITYA INDRASWARI</p>
                                </div>
                            </div>
                            <button class="w-fit px-5 py-2 border border-blue-500 dark:border-blue-400 text-blue-500 dark:text-blue-400 rounded-full text-xs font-semibold hover:bg-blue-50 dark:hover:bg-blue-900/20 transition">
                                Buat Janji Temu
                            </button>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="flex flex-col space-y-5">
                            <div class="flex items-start space-x-4">
                                <div class="w-14 h-14 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                    <span class="text-blue-500 dark:text-blue-400 font-semibold text-lg">A</span>
                                </div>
                                <div>
                                    <p class="italic text-gray-800 dark:text-gray-200 leading-relaxed">
                                        “Pengalaman rawat inap di HealthFirst Medical sangat berkesan. Perawatnya sangat care, kamarnya nyaman, dan makanannya enak. Terima kasih atas pelayanan terbaiknya!”
                                    </p>
                                    <p class="uppercase tracking-wide text-[11px] text-gray-500 dark:text-gray-400 mt-3">AHKBAR FELYAYTI</p>
                                </div>
                            </div>
                            <button class="w-fit px-5 py-2 border border-blue-500 dark:border-blue-400 text-blue-500 dark:text-blue-400 rounded-full text-xs font-semibold hover:bg-blue-50 dark:hover:bg-blue-900/20 transition">
                                Info Rawat Inap
                            </button>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8 mt-12">
                        <!-- Testimonial 4 -->
                        <div class="flex flex-col space-y-5">
                            <div class="flex items-start space-x-4">
                                <div class="w-14 h-14 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                    <span class="text-blue-500 dark:text-blue-400 font-semibold text-lg">I</span>
                                </div>
                                <div>
                                    <p class="italic text-gray-800 dark:text-gray-200 leading-relaxed">
                                        “Hallo, terimakasih HealthFirst Medical sejak pertama konsultasi hingga saat ini kulitku sudah banyak mengalami perubahan. Jerawat dan bekasnya semakin membaik berkat saran dokter-dokter HealthFirst Medical. Jujur baru kali ini bisa konsultasi dengan dokter kulit secara leluasa dan terbuka, semua pertanyaan tentang jerawatku dijawab secara gamblang.”
                                    </p>
                                    <p class="uppercase tracking-wide text-[11px] text-gray-500 dark:text-gray-400 mt-3">IZZA AFKARINA MUDMAINAH</p>
                                </div>
                            </div>
                            <button class="w-fit px-5 py-2 border border-blue-500 dark:border-blue-400 text-blue-500 dark:text-blue-400 rounded-full text-xs font-semibold hover:bg-blue-50 dark:hover:bg-blue-900/20 transition">
                                Cek Layanan Kami
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Health Tips -->
            <div class="bg-gradient-to-r from-teal-50 to-green-50 overflow-hidden shadow-sm sm:rounded-lg border border-teal-200">
                <div class="p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-teal-900">Health Tip of the Day</h3>
                            <p class="mt-2 text-sm text-teal-700">
                                Remember to stay hydrated! Drinking 8 glasses of water daily helps maintain your body's functions and keeps you energized throughout the day.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AI Health Assistant - Floating Button -->
    <button id="aiChatToggle" class="fixed bottom-6 right-6 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-2xl p-4 shadow-xl hover:shadow-blue-500/40 hover:scale-105 transition-all duration-300 z-40 group flex items-center gap-2">
        <div class="bg-white/20 rounded-xl p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </div>
        <span class="hidden md:inline font-semibold">Health AI</span>
        <span class="absolute -top-1 -right-1 flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
        </span>
    </button>

    <!-- AI Chat Sidebar -->
    <div id="aiChatSidebar" class="fixed top-0 right-0 h-full w-full md:w-[420px] bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-50 flex flex-col rounded-l-3xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-5">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-white rounded-xl p-2.5 shadow-lg">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-xl">Health First AI</h3>
                        <p class="text-xs text-blue-100 flex items-center gap-1">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            Asisten Kesehatan Online
                        </p>
                    </div>
                </div>
                <button id="aiChatClose" class="text-white hover:bg-white/20 rounded-xl p-2.5 transition-all duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <!-- Chat Controls -->
            <div class="flex items-center gap-2">
                <select id="chatSelect" class="flex-1 text-gray-700 bg-white rounded-xl px-3 py-2.5 text-sm font-medium shadow-sm border-0 focus:ring-2 focus:ring-blue-300">
                    <option value="">💬 Percakapan baru...</option>
                </select>
                <button id="newChatButton" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2.5 rounded-xl transition-all duration-200 flex items-center gap-2 font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="hidden sm:inline">Baru</span>
                </button>
                <button id="deleteChatButton" class="hidden bg-red-500/80 hover:bg-red-500 text-white px-3 py-2.5 rounded-xl transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Chat Messages Container -->
        <div id="chatMessages" class="flex-1 overflow-y-auto p-5 space-y-4 bg-gradient-to-b from-blue-50/50 to-white">
            <!-- Welcome Message -->
            <div class="flex items-start space-x-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-2.5 flex-shrink-0 shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-md p-4 shadow-sm max-w-[85%] border border-blue-100">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        👋 <strong>Halo!</strong> Saya <span class="text-blue-600 font-semibold">Health First AI Assistant</span>. 
                        Saya siap membantu menjawab pertanyaan seputar kesehatan Anda. Silakan tanyakan apa saja!
                    </p>
                    <div class="mt-3 p-2.5 bg-amber-50 rounded-xl border border-amber-200">
                        <p class="text-xs text-amber-700 flex items-start gap-2">
                            <span class="text-amber-500">⚠️</span>
                            <span>Saya bukan pengganti dokter. Untuk diagnosis dan pengobatan, konsultasikan dengan dokter profesional.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="border-t border-gray-100 p-4 bg-white">
            <form id="aiChatForm" class="space-y-3">
                <div class="relative">
                    <textarea 
                        id="aiChatInput" 
                        rows="2" 
                        class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none bg-gray-50 text-gray-700 placeholder-gray-400" 
                        placeholder="Ketik pertanyaan kesehatan Anda..."
                        maxlength="1000"
                    ></textarea>
                    <!-- Mic Button Inside Input -->
                    <button
                        type="button"
                        id="micButton"
                        title="Klik untuk bicara"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors duration-200 p-1.5 rounded-full hover:bg-blue-50"
                        aria-label="Aktifkan Speech to Text"
                    >
                        <svg id="micIconIdle" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a2 2 0 00-2 2v6a2 2 0 104 0V4a2 2 0 00-2-2z"/>
                            <path fill-rule="evenodd" d="M5 10a5 5 0 0010 0h-2a3 3 0 11-6 0H5zm5 7a7 7 0 007-7h-2a5 5 0 11-10 0H3a7 7 0 007 7zm-1 1h2v-2H9v2z" clip-rule="evenodd"/>
                        </svg>
                        <svg id="micIconOn" class="w-5 h-5 hidden text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a2 2 0 00-2 2v6a2 2 0 104 0V4a2 2 0 00-2-2z"/>
                            <path fill-rule="evenodd" d="M5 10a5 5 0 0010 0h-2a3 3 0 11-6 0H5zm5 7a7 7 0 007-7h-2a5 5 0 11-10 0H3a7 7 0 007 7zm-1 1h2v-2H9v2z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-400">
                        <span class="hidden sm:inline">Enter = kirim • Shift+Enter = baris baru</span>
                        <span class="sm:hidden">Enter untuk kirim</span>
                    </p>
                    <button 
                        type="submit" 
                        id="sendButton"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl px-6 py-2.5 hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2 font-medium"
                    >
                        <span>Kirim</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Overlay -->
    <div id="chatOverlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 hidden transition-opacity duration-300"></div>

    <script>
        // Chat Toggle
        const chatToggle = document.getElementById('aiChatToggle');
        const chatSidebar = document.getElementById('aiChatSidebar');
        const chatClose = document.getElementById('aiChatClose');
        const chatOverlay = document.getElementById('chatOverlay');
        const chatForm = document.getElementById('aiChatForm');
        const chatInput = document.getElementById('aiChatInput');
        const chatMessages = document.getElementById('chatMessages');
        const sendButton = document.getElementById('sendButton');
        const micButton = document.getElementById('micButton');
        const chatSelect = document.getElementById('chatSelect');
        const newChatButton = document.getElementById('newChatButton');
        const deleteChatButton = document.getElementById('deleteChatButton');

        let currentChatId = null;

        async function fetchChats() {
            try {
                const res = await fetch('{{ route("health.ai.chats") }}');
                if (!res.ok) return;
                const data = await res.json();
                if (!data.success) return;
                chatSelect.innerHTML = '<option value="">Chat baru…</option>';
                data.data.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c.id;
                    opt.textContent = (c.title || 'Percakapan') + ' · ' + new Date(c.updated_at).toLocaleString();
                    if (String(c.id) === String(currentChatId)) opt.selected = true;
                    chatSelect.appendChild(opt);
                });
                // show controls if any chat exists
                const has = data.data && data.data.length > 0;
                chatSelect.classList.toggle('hidden', !has);
                newChatButton.classList.toggle('hidden', false);
                deleteChatButton.classList.toggle('hidden', !currentChatId);
            } catch(_) {}
        }

        async function loadChatMessages(chatId) {
            if (!chatId) return;
            const url = '{{ route("health.ai.chats.messages", ["chat" => 0]) }}'.replace('/0', '/' + chatId);
            const res = await fetch(url);
            if (!res.ok) return;
            const data = await res.json();
            if (!data.success) return;
            currentChatId = data.chat_id;
            // clear messages
            chatMessages.innerHTML = '';
            // render all
            data.messages.forEach(m => {
                addMessage(m.content, m.role === 'user' ? 'user' : 'ai');
            });
            chatMessages.scrollTop = chatMessages.scrollHeight;
            deleteChatButton.classList.toggle('hidden', !currentChatId);
            await fetchChats();
        }

        if (chatSelect) {
            chatSelect.addEventListener('change', (e) => {
                const v = e.target.value;
                if (!v) {
                    startNewChat();
                } else {
                    loadChatMessages(v);
                }
            });
        }

        function startNewChat() {
            currentChatId = null;
            chatInput.value = '';
            // reset to welcome message area
            chatMessages.innerHTML = `
            <div class="flex items-start space-x-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-2.5 flex-shrink-0 shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-md p-4 shadow-sm max-w-[85%] border border-blue-100">
                    <p class="text-sm text-gray-700 leading-relaxed">
                        👋 <strong>Halo!</strong> Saya <span class="text-blue-600 font-semibold">Health First AI Assistant</span>. 
                        Saya siap membantu menjawab pertanyaan seputar kesehatan Anda. Silakan tanyakan apa saja!
                    </p>
                    <div class="mt-3 p-2.5 bg-amber-50 rounded-xl border border-amber-200">
                        <p class="text-xs text-amber-700 flex items-start gap-2">
                            <span class="text-amber-500">⚠️</span>
                            <span>Saya bukan pengganti dokter. Untuk diagnosis dan pengobatan, konsultasikan dengan dokter profesional.</span>
                        </p>
                    </div>
                </div>
            </div>`;
            fetchChats();
            deleteChatButton.classList.add('hidden');
        }

        if (newChatButton) newChatButton.addEventListener('click', startNewChat);
        if (deleteChatButton) {
            deleteChatButton.addEventListener('click', async () => {
                if (!currentChatId) return;
                const url = '{{ route("health.ai.chats.destroy", ["chat" => 0]) }}'.replace('/0', '/' + currentChatId);
                const res = await fetch(url, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
                if (res.ok) startNewChat();
            });
        }

        // --- Speech To Text (Web Speech API) ---
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        let recognition = null;
        let isListening = false;
        let holdToTalkActive = false;
        let longPressTimer = null;
        let sendAfterHold = false;
    let sttFinal = '';
    let sttInterim = '';

        function ensureRecognition() {
            if (!SpeechRecognition) return null;
            if (recognition) return recognition;
            recognition = new SpeechRecognition();
            recognition.lang = 'id-ID';
            recognition.interimResults = true;
            recognition.continuous = true;

            recognition.onstart = () => {
                micButton.classList.remove('bg-gray-100','text-gray-700');
                micButton.classList.add('bg-red-600','text-white','animate-pulse');
                micButton.title = 'Mendengarkan... klik untuk berhenti';
                // toggle icons
                document.getElementById('micIconIdle').classList.add('hidden');
                document.getElementById('micIconOn').classList.remove('hidden');
            };

            recognition.onresult = (event) => {
                // Build stable final and interim without duplications
                sttInterim = '';
                for (let i = event.resultIndex; i < event.results.length; i++) {
                    const transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) sttFinal += transcript + ' ';
                    else sttInterim = transcript;
                }
                const prefix = (chatInput.dataset.baseText || '').trim();
                const combined = [prefix, (sttFinal + sttInterim).trim()].filter(Boolean).join(' ');
                chatInput.value = combined;
                chatInput.dispatchEvent(new Event('input'));
            };

            recognition.onerror = (e) => {
                // Show a friendly error only once
                addMessage('❌ Gagal menggunakan speech-to-text: ' + (e.error || 'unknown error'), 'ai', true);
                stopListening(false);
            };

            recognition.onend = () => {
                micButton.classList.remove('bg-red-600','text-white','animate-pulse');
                micButton.classList.add('bg-gray-100','text-gray-700');
                micButton.title = 'Klik untuk bicara (Speech to Text)';
                document.getElementById('micIconOn').classList.add('hidden');
                document.getElementById('micIconIdle').classList.remove('hidden');
                // Do not auto-restart to avoid duplicate transcripts
                if (sendAfterHold) {
                    sendAfterHold = false;
                    if (chatInput.value.trim()) {
                        chatForm.dispatchEvent(new Event('submit'));
                    }
                }
            };
            return recognition;
        }

        function startListening(autoSend = false) {
            const rec = ensureRecognition();
            if (!rec) {
                addMessage('Browser Anda tidak mendukung Speech-to-Text. Coba gunakan Chrome/Edge terbaru di Android/Windows.', 'ai', true);
                return;
            }
            sendAfterHold = autoSend;
            isListening = true;
            chatInput.dataset.baseText = chatInput.value || '';
            sttFinal = '';
            sttInterim = '';
            try { rec.start(); } catch (_) {}
        }

        function stopListening(resetAutoSend = true) {
            if (recognition) {
                isListening = false;
                if (resetAutoSend === false) {
                    // keep sendAfterHold as is
                } else {
                    // default: do not auto-send unless explicitly set
                    sendAfterHold = false;
                }
                try { recognition.stop(); } catch (_) {}
            }
        }

        if (micButton) {
            micButton.addEventListener('click', () => {
                if (isListening) stopListening(); else startListening(false);
            });
        }

        // Hold-to-talk on Send button
        function startHoldTimer(e) {
            if (longPressTimer) clearTimeout(longPressTimer);
            holdToTalkActive = true;
            longPressTimer = setTimeout(() => {
                startListening(true);
            }, 450);
        }
        function clearHoldTimerAndMaybeStop() {
            if (longPressTimer) { clearTimeout(longPressTimer); longPressTimer = null; }
            if (holdToTalkActive && isListening) {
                stopListening(false); // keep sendAfterHold=true to auto-send on end
            }
            holdToTalkActive = false;
        }

        sendButton.addEventListener('mousedown', startHoldTimer);
        sendButton.addEventListener('touchstart', startHoldTimer);
        ['mouseup','mouseleave','touchend','touchcancel'].forEach(evt => {
            sendButton.addEventListener(evt, clearHoldTimerAndMaybeStop);
        });
        // Prevent form submit if we were in hold-to-talk mode
        sendButton.addEventListener('click', (e) => {
            if (holdToTalkActive || isListening) {
                e.preventDefault();
            }
        });

        // Open chat
        chatToggle.addEventListener('click', () => {
            chatSidebar.classList.remove('translate-x-full');
            chatOverlay.classList.remove('hidden');
            chatInput.focus();
        });

        // Close chat
        function closeChat() {
            chatSidebar.classList.add('translate-x-full');
            chatOverlay.classList.add('hidden');
        }

        chatClose.addEventListener('click', closeChat);
        chatOverlay.addEventListener('click', closeChat);

        // Handle form submission
        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const message = chatInput.value.trim();
            if (!message) return;

            // Add user message to chat
            addMessage(message, 'user');
            
            // Clear input
            chatInput.value = '';
            chatInput.style.height = 'auto';

            // Disable send button
            sendButton.disabled = true;

            // Show typing indicator
            const typingId = addTypingIndicator();

            try {
                // Send to AI
                const response = await fetch('{{ route("health.ai.chat") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message, chat_id: currentChatId })
                });

                // Remove typing indicator
                removeTypingIndicator(typingId);

                // Check if response is OK
                if (!response.ok) {
                    let errorMessage = '❌ Terjadi kesalahan pada server';
                    try {
                        const errorData = await response.json();
                        errorMessage = '❌ ' + (errorData.message || `Error ${response.status}: ${response.statusText}`);
                    } catch (e) {
                        errorMessage = `❌ Error ${response.status}: ${response.statusText}`;
                    }
                    addMessage(errorMessage, 'ai', true);
                    console.error('Server error:', response.status, response.statusText);
                    return;
                }

                const data = await response.json();

                if (data.success) {
                    addMessage(data.message, 'ai');
                    if (data.chat_id && !currentChatId) {
                        currentChatId = data.chat_id;
                        fetchChats();
                    }
                } else {
                    addMessage('❌ ' + (data.message || 'Gagal mendapatkan response dari AI'), 'ai', true);
                }
            } catch (error) {
                removeTypingIndicator(typingId);
                let errorMsg = '❌ Terjadi kesalahan koneksi. ';
                
                if (error.name === 'TypeError' && error.message.includes('Failed to fetch')) {
                    errorMsg += 'Tidak dapat terhubung ke server. Periksa koneksi internet Anda.';
                } else if (error.name === 'AbortError') {
                    errorMsg += 'Request timeout. Silakan coba lagi.';
                } else {
                    errorMsg += 'Silakan coba lagi. (' + error.message + ')';
                }
                
                addMessage(errorMsg, 'ai', true);
                console.error('Chat error:', error);
            } finally {
                sendButton.disabled = false;
            }
        });

        // Handle Enter key (Send) and Shift+Enter (New line)
        chatInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                chatForm.dispatchEvent(new Event('submit'));
            }
        });

        // Auto-resize textarea
        chatInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Add message to chat
        function addMessage(text, sender = 'user', isError = false) {
            const messageDiv = document.createElement('div');
            messageDiv.className = 'flex items-start space-x-3 animate-fade-in';
            
            if (sender === 'user') {
                messageDiv.classList.add('flex-row-reverse', 'space-x-reverse');
                messageDiv.innerHTML = `
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-2.5 flex-shrink-0 shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-2xl rounded-tr-md p-4 shadow-lg max-w-[85%]">
                        <p class="text-sm leading-relaxed">${escapeHtml(text)}</p>
                    </div>
                `;
            } else {
                messageDiv.innerHTML = `
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-2.5 flex-shrink-0 shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <div class="${isError ? 'bg-red-50 border border-red-200' : 'bg-white border border-blue-100'} rounded-2xl rounded-tl-md p-4 shadow-sm max-w-[85%]">
                        <div class="text-sm ${isError ? 'text-red-700' : 'text-gray-700'} leading-relaxed markdown-content">${isError ? escapeHtml(text) : formatMarkdown(text)}</div>
                    </div>
                `;
            }
            
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Add typing indicator
        function addTypingIndicator() {
            const typingDiv = document.createElement('div');
            typingDiv.id = 'typing-indicator';
            typingDiv.className = 'flex items-start space-x-3';
            typingDiv.innerHTML = `
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-2.5 flex-shrink-0 shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <div class="bg-white rounded-2xl rounded-tl-md p-4 shadow-sm border border-blue-100">
                    <div class="flex space-x-1.5">
                        <div class="w-2.5 h-2.5 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                        <div class="w-2.5 h-2.5 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                        <div class="w-2.5 h-2.5 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
                    </div>
                </div>
            `;
            
            chatMessages.appendChild(typingDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            return typingDiv.id;
        }

        // Remove typing indicator
        function removeTypingIndicator(id) {
            const indicator = document.getElementById(id);
            if (indicator) {
                indicator.remove();
            }
        }

        // Escape HTML to prevent XSS
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Format Markdown (bold, bullets, emojis) - safe rendering
        function formatMarkdown(text) {
            // Escape HTML first
            let formatted = escapeHtml(text);
            
            // Convert **bold** to <strong>
            formatted = formatted.replace(/\*\*(.+?)\*\*/g, '<strong class="font-bold text-gray-900">$1</strong>');
            
            // Convert bullet points • to styled bullets
            formatted = formatted.replace(/^• (.+)$/gm, '<div class="flex items-start ml-2 mb-1"><span class="text-blue-600 mr-2">•</span><span>$1</span></div>');
            
            // Convert line breaks to <br>
            formatted = formatted.replace(/\n/g, '<br>');
            
            // Highlight warning/important emoji
            formatted = formatted.replace(/⚠️/g, '<span class="text-amber-500 text-lg">⚠️</span>');
            
            return formatted;
        }
    </script>

    <style>
        .markdown-content {
            line-height: 1.7;
        }

        .markdown-content strong {
            color: #1e40af;
            font-weight: 700;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        #chatMessages::-webkit-scrollbar {
            width: 6px;
        }

        #chatMessages::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        #chatMessages::-webkit-scrollbar-thumb {
            background: #93c5fd;
            border-radius: 3px;
        }

        #chatMessages::-webkit-scrollbar-thumb:hover {
            background: #3b82f6;
        }

        /* Mic button listening animation */
        #micButton.listening {
            animation: pulse-mic 1.5s infinite;
        }

        @keyframes pulse-mic {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4);
            }
            50% {
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
            }
        }
    </style>
</x-app-layout>

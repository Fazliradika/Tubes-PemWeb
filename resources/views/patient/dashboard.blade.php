<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-green-500 to-teal-600 overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Welcome, {{ $patient->name }}!</h3>
                    <p class="text-green-100">Manage your health and appointments</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Upcoming Appointments -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Upcoming Appointments</p>
                                <p class="text-2xl font-semibold text-gray-900">2</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Medical Records -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Medical Records</p>
                                <p class="text-2xl font-semibold text-gray-900">15</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Prescriptions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Active Prescriptions</p>
                                <p class="text-2xl font-semibold text-gray-900">3</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Upcoming Appointments</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-gray-900">Dr. Ahmad Fadli</p>
                                    <p class="text-xs text-gray-600">Cardiologist</p>
                                    <p class="text-xs text-gray-500 mt-1">General Checkup</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-900">Tomorrow</p>
                                <p class="text-sm text-gray-600">10:00 AM</p>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-2">
                                    Confirmed
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-semibold text-gray-900">Dr. Citra Dewi</p>
                                    <p class="text-xs text-gray-600">Dermatologist</p>
                                    <p class="text-xs text-gray-500 mt-1">Skin Consultation</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-900">Nov 5, 2025</p>
                                <p class="text-sm text-gray-600">02:30 PM</p>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-2">
                                    Confirmed
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <button class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                            <svg class="h-8 w-8 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Book Appointment</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition">
                            <svg class="h-8 w-8 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Medical Records</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition">
                            <svg class="h-8 w-8 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Prescriptions</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition">
                            <svg class="h-8 w-8 text-yellow-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Messages</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Health Articles Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">Artikel Kesehatan Terkini untuk Anda</h3>
                    </div>

                    <!-- Article Categories -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-green-50 transition">
                            Nutrisi
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-green-50 transition">
                            Diabetes
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-green-50 transition">
                            Jantung
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-green-50 transition">
                            Kesehatan Mulut
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-green-50 transition">
                            Kolesterol Tinggi
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-green-50 transition">
                            Diet
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-green-50 transition">
                            Kecantikan
                        </button>
                    </div>

                    <!-- Articles Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Article 1 -->
                        <a href="{{ route('articles.show', '7-makanan-yang-bikin-kurus-cocok-untuk-menu-diet-harian') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&h=250&fit=crop" 
                                         alt="Healthy Food" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Hidup Sehat
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-2 hover:text-green-600 cursor-pointer">
                                        7 Makanan yang Bikin Kurus, Cocok untuk Menu Diet Harian
                                    </h4>
                                    <p class="text-sm text-gray-600 mb-3">
                                        Makanan yang bikin kurus menjadi incaran banyak orang yang ingin menurunkan berat badan tanpa rasa lapar atau tersiksa. Dengan memilih...
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>5 min read</span>
                                        <span>• 2 hari lalu</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Article 2 -->
                        <a href="{{ route('articles.show', 'tips-olahraga-efektif-untuk-kesehatan-jantung') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=400&h=250&fit=crop" 
                                         alt="Exercise" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Olahraga
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-2 hover:text-green-600 cursor-pointer">
                                        Tips Olahraga yang Efektif untuk Kesehatan Jantung
                                    </h4>
                                    <p class="text-sm text-gray-600 mb-3">
                                        Olahraga teratur sangat penting untuk menjaga kesehatan jantung. Pelajari jenis olahraga yang paling efektif untuk meningkatkan fungsi...
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>7 min read</span>
                                        <span>• 3 hari lalu</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Article 3 -->
                        <a href="{{ route('articles.show', 'mengelola-diabetes-dengan-pola-makan-sehat') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?w=400&h=250&fit=crop" 
                                         alt="Diabetes" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Diabetes
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-2 hover:text-green-600 cursor-pointer">
                                    Mengelola Diabetes dengan Pola Makan Sehat
                                </h4>
                                <p class="text-sm text-gray-600 mb-3">
                                    Pola makan yang tepat sangat penting bagi penderita diabetes. Temukan panduan lengkap tentang makanan yang aman dan nutrisi yang...
                                </p>
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span>6 min read</span>
                                    <span>• 4 hari lalu</span>
                                </div>
                            </div>
                        </div>

                        <!-- Article 4 -->
                        <a href="{{ route('articles.show', 'pentingnya-vitamin-dan-mineral-untuk-tubuh') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=400&h=250&fit=crop" 
                                         alt="Nutrition" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-yellow-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Nutrisi
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-2 hover:text-green-600 cursor-pointer">
                                        Pentingnya Vitamin dan Mineral untuk Tubuh
                                    </h4>
                                    <p class="text-sm text-gray-600 mb-3">
                                        Vitamin dan mineral adalah nutrisi esensial yang dibutuhkan tubuh. Pelajari manfaat masing-masing vitamin dan sumber makanan terbaik...
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>8 min read</span>
                                        <span>• 5 hari lalu</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Article 5 -->
                        <a href="{{ route('articles.show', 'cara-mengatasi-stres-dan-menjaga-kesehatan-mental') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=250&fit=crop" 
                                         alt="Mental Health" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-purple-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Kesehatan Mental
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-2 hover:text-green-600 cursor-pointer">
                                        Cara Mengatasi Stres dan Menjaga Kesehatan Mental
                                    </h4>
                                    <p class="text-sm text-gray-600 mb-3">
                                        Kesehatan mental sama pentingnya dengan kesehatan fisik. Temukan strategi efektif untuk mengelola stres dan meningkatkan kesejahteraan...
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>10 min read</span>
                                        <span>• 1 minggu lalu</span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Article 6 -->
                        <a href="{{ route('articles.show', 'tips-tidur-berkualitas-untuk-kulit-sehat-dan-bercahaya') }}" class="block">
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                                <div class="relative">
                                    <img src="https://images.unsplash.com/photo-1559388372-d01ad0cd0bce?w=400&h=250&fit=crop" 
                                         alt="Sleep" 
                                         class="w-full h-48 object-cover">
                                    <span class="absolute top-3 left-3 bg-indigo-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                        Kecantikan
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-bold text-gray-800 mb-2 hover:text-green-600 cursor-pointer">
                                        Tips Tidur Berkualitas untuk Kulit Sehat dan Bercahaya
                                    </h4>
                                    <p class="text-sm text-gray-600 mb-3">
                                        Tidur yang cukup dan berkualitas sangat penting untuk kesehatan kulit. Pelajari bagaimana tidur mempengaruhi kecantikan dan tips untuk...
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span>6 min read</span>
                                        <span>• 1 minggu lalu</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- View More Button -->
                    <div class="mt-8 text-center">
                        <a href="{{ route('articles.index') }}" class="inline-block px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                            Lihat Semua Artikel
                        </a>
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
</x-app-layout>

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
                        <a href="{{ route('appointments.index') }}" class="flex flex-col items-center justify-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                            <svg class="h-8 w-8 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Book Appointment</span>
                        </a>
                        <a href="{{ route('appointments.my-appointments') }}" class="flex flex-col items-center justify-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition">
                            <svg class="h-8 w-8 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-sm font-medium text-gray-700">My Appointments</span>
                        </a>
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

                        <!-- Article 2 -->
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

                        <!-- Article 3 -->
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

                        <!-- Article 5 -->
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

                        <!-- Article 6 -->
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1560750588-73207b1ef5b8?w=400&h=250&fit=crop" 
                                     alt="Beauty Sleep Skincare" 
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
                    </div>

                    <!-- View More Button -->
                    <div class="mt-8 text-center">
                        <button class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                            Lihat Semua Artikel
                        </button>
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
    <button id="aiChatToggle" class="fixed bottom-6 right-6 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full p-4 shadow-2xl hover:shadow-purple-500/50 hover:scale-110 transition-all duration-300 z-40 group">
        <svg class="w-7 h-7 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
        <span class="absolute -top-1 -right-1 flex h-4 w-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-pink-500"></span>
        </span>
    </button>

    <!-- AI Chat Sidebar -->
    <div id="aiChatSidebar" class="fixed top-0 right-0 h-full w-full md:w-96 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out z-50 flex flex-col">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-white/20 rounded-full p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg">AI Health Assistant</h3>
                    <p class="text-xs text-purple-100">Tanya seputar kesehatan Anda</p>
                </div>
            </div>
            <button id="aiChatClose" class="text-white hover:bg-white/20 rounded-full p-2 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Chat Messages Container -->
        <div id="chatMessages" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">
            <!-- Welcome Message -->
            <div class="flex items-start space-x-2">
                <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-full p-2 flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="bg-white rounded-lg rounded-tl-none p-3 shadow-sm max-w-[85%]">
                    <p class="text-sm text-gray-700">
                        👋 Halo! Saya AI Health Assistant. Saya siap membantu menjawab pertanyaan seputar kesehatan Anda. 
                        Silakan tanyakan apa saja!
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        ⚠️ Saya bukan pengganti dokter. Untuk diagnosis dan pengobatan, konsultasikan dengan dokter profesional.
                    </p>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="border-t border-gray-200 p-4 bg-white">
            <form id="aiChatForm" class="flex items-end space-x-2">
                <div class="flex-1">
                    <textarea 
                        id="aiChatInput" 
                        rows="2" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none" 
                        placeholder="Ketik pertanyaan Anda di sini..."
                        maxlength="1000"
                    ></textarea>
                    <p class="text-xs text-gray-400 mt-1">Tekan Enter untuk kirim • Shift+Enter baris baru • Klik ikon mikrofon untuk bicara</p>
                </div>
                <!-- Mic Button (Speech to Text) -->
                <button
                    type="button"
                    id="micButton"
                    title="Klik untuk bicara (Speech to Text). Tahan tombol Kirim untuk push-to-talk."
                    class="bg-gray-100 text-gray-700 rounded-lg p-3 hover:bg-gray-200 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    aria-label="Aktifkan Speech to Text"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a2 2 0 00-2 2v6a2 2 0 104 0V4a2 2 0 00-2-2z"/>
                        <path fill-rule="evenodd" d="M5 10a5 5 0 0010 0h-2a3 3 0 11-6 0H5zm5 7a7 7 0 007-7h-2a5 5 0 11-10 0H3a7 7 0 007 7zm-1 1h2v-2H9v2z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <button 
                    type="submit" 
                    id="sendButton"
                    class="bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg px-4 py-3 hover:shadow-lg transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Overlay -->
    <div id="chatOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300"></div>

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

        // --- Speech To Text (Web Speech API) ---
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        let recognition = null;
        let isListening = false;
        let holdToTalkActive = false;
        let longPressTimer = null;
        let sendAfterHold = false;

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
            };

            recognition.onresult = (event) => {
                let interim = '';
                let finalText = '';
                for (let i = event.resultIndex; i < event.results.length; i++) {
                    const transcript = event.results[i][0].transcript;
                    if (event.results[i].isFinal) finalText += transcript + ' ';
                    else interim += transcript;
                }
                if (interim) {
                    // preview interim in the input
                    chatInput.value = (chatInput.dataset.baseText || '') + interim;
                }
                if (finalText) {
                    const base = (chatInput.value || '').trim();
                    chatInput.value = (base ? base + ' ' : '') + finalText.trim();
                    chatInput.dataset.baseText = chatInput.value;
                    chatInput.dispatchEvent(new Event('input'));
                }
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
                if (isListening) {
                    // Auto-restart if still in listening mode (network hiccup)
                    try { recognition.start(); } catch(_) {}
                } else if (sendAfterHold) {
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
            }, 350);
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
                    body: JSON.stringify({ message })
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
            messageDiv.className = 'flex items-start space-x-2 animate-fade-in';
            
            if (sender === 'user') {
                messageDiv.classList.add('flex-row-reverse', 'space-x-reverse');
                messageDiv.innerHTML = `
                    <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg rounded-tr-none p-3 shadow-md max-w-[85%]">
                        <p class="text-sm">${escapeHtml(text)}</p>
                    </div>
                `;
            } else {
                messageDiv.innerHTML = `
                    <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-full p-2 flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="${isError ? 'bg-red-50 border border-red-200' : 'bg-white'} rounded-lg rounded-tl-none p-3 shadow-sm max-w-[85%]">
                        <div class="text-sm ${isError ? 'text-red-700' : 'text-gray-700'} markdown-content">${isError ? escapeHtml(text) : formatMarkdown(text)}</div>
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
            typingDiv.className = 'flex items-start space-x-2';
            typingDiv.innerHTML = `
                <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-full p-2 flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="bg-white rounded-lg rounded-tl-none p-3 shadow-sm">
                    <div class="flex space-x-1">
                        <div class="w-2 h-2 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                        <div class="w-2 h-2 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                        <div class="w-2 h-2 bg-purple-500 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
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
            formatted = formatted.replace(/^• (.+)$/gm, '<div class="flex items-start ml-2 mb-1"><span class="text-purple-600 mr-2">•</span><span>$1</span></div>');
            
            // Convert line breaks to <br>
            formatted = formatted.replace(/\n/g, '<br>');
            
            // Highlight warning/important emoji
            formatted = formatted.replace(/⚠️/g, '<span class="text-orange-500 text-lg">⚠️</span>');
            
            return formatted;
        }
    </script>

    <style>
        .markdown-content {
            line-height: 1.6;
        }

        .markdown-content strong {
            color: #1f2937;
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
            background: #f1f1f1;
        }

        #chatMessages::-webkit-scrollbar-thumb {
            background: #c084fc;
            border-radius: 3px;
        }

        #chatMessages::-webkit-scrollbar-thumb:hover {
            background: #a855f7;
        }
    </style>
</x-app-layout>

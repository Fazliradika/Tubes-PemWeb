<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-300">
                    {{ now()->format('l, d F Y') }}
                </span>
                <span class="px-3 py-1 bg-green-500/20 text-green-400 text-xs font-medium rounded-full">
                    Live Data
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Quick Stats Overview -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-8">
                <!-- Total Revenue -->
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-4 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-100 text-xs font-medium">Total Revenue</p>
                            <p class="text-lg font-bold">Rp {{ number_format($totalSales['month'] / 1000000, 1) }}M</p>
                        </div>
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center text-xs">
                        <span class="flex items-center text-emerald-100">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            +{{ $salesGrowth }}%
                        </span>
                        <span class="ml-2 text-emerald-200/70">vs bulan lalu</span>
                    </div>
                </div>
                
                <!-- Total Orders -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-xs font-medium">Total Pesanan</p>
                            <p class="text-lg font-bold">{{ number_format($orderStats['total']) }}</p>
                        </div>
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center text-xs">
                        <span class="flex items-center text-blue-100">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            +{{ $orderGrowth }}%
                        </span>
                        <span class="ml-2 text-blue-200/70">bulan ini</span>
                    </div>
                </div>
                
                <!-- Total Users -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-4 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-xs font-medium">Total Pengguna</p>
                            <p class="text-lg font-bold">{{ number_format($totalUsers) }}</p>
                        </div>
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center text-xs">
                        <span class="flex items-center text-purple-100">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            +{{ $userGrowth }}%
                        </span>
                        <span class="ml-2 text-purple-200/70">pertumbuhan</span>
                    </div>
                </div>
                
                <!-- Products -->
                <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-4 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-amber-100 text-xs font-medium">Total Produk</p>
                            <p class="text-lg font-bold">{{ number_format($totalProducts) }}</p>
                        </div>
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-xs text-amber-200/70">
                        {{ $activeProducts }} aktif
                    </div>
                </div>
                
                <!-- Appointments -->
                <div class="bg-gradient-to-br from-rose-500 to-rose-600 rounded-xl p-4 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-rose-100 text-xs font-medium">Janji Temu</p>
                            <p class="text-lg font-bold">{{ number_format($appointmentStats['total']) }}</p>
                        </div>
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-2 text-xs text-rose-200/70">
                        {{ $appointmentStats['today'] }} hari ini
                    </div>
                </div>
                
                <!-- Messages -->
                <div class="bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl p-4 text-white shadow-lg transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-cyan-100 text-xs font-medium">Pesan Masuk</p>
                            <p class="text-lg font-bold">{{ number_format($contactStats['total']) }}</p>
                        </div>
                        <div class="p-2 bg-white/20 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    @if($contactStats['unread'] > 0)
                    <div class="mt-2 text-xs">
                        <span class="px-2 py-0.5 bg-white/20 rounded-full">{{ $contactStats['unread'] }} belum dibaca</span>
                    </div>
                    @else
                    <div class="mt-2 text-xs text-cyan-200/70">
                        Semua terbaca
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Quick Access Reports -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- User Report Card -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 overflow-hidden shadow-xl sm:rounded-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 border border-blue-500/30">
                    <div class="p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold mb-1">Laporan Pengguna</h3>
                                <p class="text-blue-100 text-sm">Statistik dan demografi pengguna detail</p>
                            </div>
                            <div class="p-3 bg-white/10 rounded-xl">
                                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 mb-4">
                            <div class="bg-white/10 rounded-lg p-3 text-center">
                                <p class="text-2xl font-bold">{{ $adminUsers }}</p>
                                <p class="text-xs text-blue-200">Admin</p>
                            </div>
                            <div class="bg-white/10 rounded-lg p-3 text-center">
                                <p class="text-2xl font-bold">{{ $doctorUsers }}</p>
                                <p class="text-xs text-blue-200">Dokter</p>
                            </div>
                            <div class="bg-white/10 rounded-lg p-3 text-center">
                                <p class="text-2xl font-bold">{{ $patientUsers }}</p>
                                <p class="text-xs text-blue-200">Pasien</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.reports.users') }}" class="inline-flex items-center px-5 py-2.5 bg-white text-blue-700 font-semibold rounded-lg hover:bg-blue-50 shadow-lg hover:shadow-xl transition-all duration-200 text-sm">
                            Lihat Detail
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Sales Report Card -->
                <div class="bg-gradient-to-br from-purple-600 to-purple-700 overflow-hidden shadow-xl sm:rounded-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 border border-purple-500/30">
                    <div class="p-6 text-white">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold mb-1">Laporan Penjualan</h3>
                                <p class="text-purple-100 text-sm">Analisis data penjualan dan transaksi</p>
                            </div>
                            <div class="p-3 bg-white/10 rounded-xl">
                                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="bg-white/10 rounded-lg p-3">
                                <p class="text-xs text-purple-200 mb-1">Hari Ini</p>
                                <p class="text-lg font-bold">Rp {{ number_format($totalSales['today'] / 1000) }}K</p>
                            </div>
                            <div class="bg-white/10 rounded-lg p-3">
                                <p class="text-xs text-purple-200 mb-1">Minggu Ini</p>
                                <p class="text-lg font-bold">Rp {{ number_format($totalSales['week'] / 1000000, 1) }}M</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.reports.sales') }}" class="inline-flex items-center px-5 py-2.5 bg-white text-purple-700 font-semibold rounded-lg hover:bg-purple-50 shadow-lg hover:shadow-xl transition-all duration-200 text-sm">
                            Lihat Detail
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order Status Overview -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Status Pesanan</h3>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    <div class="text-center p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-200 dark:border-yellow-800">
                        <div class="w-12 h-12 mx-auto mb-2 bg-yellow-100 dark:bg-yellow-900/50 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $orderStats['pending'] }}</p>
                        <p class="text-xs text-yellow-700 dark:text-yellow-300">Menunggu</p>
                    </div>
                    <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                        <div class="w-12 h-12 mx-auto mb-2 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $orderStats['processing'] }}</p>
                        <p class="text-xs text-blue-700 dark:text-blue-300">Diproses</p>
                    </div>
                    <div class="text-center p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl border border-indigo-200 dark:border-indigo-800">
                        <div class="w-12 h-12 mx-auto mb-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $orderStats['shipped'] }}</p>
                        <p class="text-xs text-indigo-700 dark:text-indigo-300">Dikirim</p>
                    </div>
                    <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
                        <div class="w-12 h-12 mx-auto mb-2 bg-green-100 dark:bg-green-900/50 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $orderStats['delivered'] }}</p>
                        <p class="text-xs text-green-700 dark:text-green-300">Selesai</p>
                    </div>
                    <div class="text-center p-4 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-800">
                        <div class="w-12 h-12 mx-auto mb-2 bg-red-100 dark:bg-red-900/50 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $orderStats['cancelled'] }}</p>
                        <p class="text-xs text-red-700 dark:text-red-300">Dibatalkan</p>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Sales Trend Chart -->
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-lg sm:rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tren Penjualan</h3>
                            <span class="text-xs text-gray-500 dark:text-gray-400">6 bulan terakhir</span>
                        </div>
                        <div class="h-64">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Weekly Performance Chart -->
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-lg sm:rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Performa Mingguan</h3>
                            <span class="text-xs text-gray-500 dark:text-gray-400">7 hari terakhir</span>
                        </div>
                        <div class="h-64">
                            <canvas id="weeklyChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- User Registration Trend -->
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-lg sm:rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Registrasi Pengguna</h3>
                        <div class="h-56">
                            <canvas id="userRegistrationChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- User Role Distribution -->
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-lg sm:rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Distribusi Pengguna</h3>
                        <div class="h-56">
                            <canvas id="userRoleChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Revenue by Category -->
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-lg sm:rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pendapatan per Kategori</h3>
                        <div class="space-y-3">
                            @foreach($revenueByCategory as $item)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-700 dark:text-gray-300">{{ $item['category'] }}</span>
                                    <span class="text-gray-900 dark:text-white font-medium">Rp {{ number_format($item['revenue'] / 1000000, 1) }}M</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full transition-all duration-500" style="width: {{ $item['percentage'] }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product & Appointment Stats Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Product Inventory Status -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Status Inventori Produk</h3>
                        <a href="{{ route('admin.products.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Kelola →</a>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-xl p-4 border border-green-200 dark:border-green-800">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $activeProducts }}</p>
                                    <p class="text-sm text-green-700 dark:text-green-300">Produk Aktif</p>
                                </div>
                                <div class="p-3 bg-green-200 dark:bg-green-800 rounded-full">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/20 rounded-xl p-4 border border-yellow-200 dark:border-yellow-800">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $lowStockProducts }}</p>
                                    <p class="text-sm text-yellow-700 dark:text-yellow-300">Stok Rendah</p>
                                </div>
                                <div class="p-3 bg-yellow-200 dark:bg-yellow-800 rounded-full">
                                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 rounded-xl p-4 border border-red-200 dark:border-red-800">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $outOfStockProducts }}</p>
                                    <p class="text-sm text-red-700 dark:text-red-300">Habis</p>
                                </div>
                                <div class="p-3 bg-red-200 dark:bg-red-800 rounded-full">
                                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl p-4 border border-blue-200 dark:border-blue-800">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $totalProducts }}</p>
                                    <p class="text-sm text-blue-700 dark:text-blue-300">Total Produk</p>
                                </div>
                                <div class="p-3 bg-blue-200 dark:bg-blue-800 rounded-full">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appointment Status -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Status Janji Temu</h3>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Ringkasan</span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                                <span class="text-gray-700 dark:text-gray-300">Menunggu Konfirmasi</span>
                            </div>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">{{ $appointmentStats['pending'] }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                <span class="text-gray-700 dark:text-gray-300">Dikonfirmasi</span>
                            </div>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">{{ $appointmentStats['confirmed'] ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                <span class="text-gray-700 dark:text-gray-300">Selesai</span>
                            </div>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">{{ $appointmentStats['completed'] }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                                <span class="text-gray-700 dark:text-gray-300">Dibatalkan</span>
                            </div>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">{{ $appointmentStats['cancelled'] }}</span>
                        </div>
                        <div class="mt-4 p-4 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm opacity-90">Janji Temu Hari Ini</p>
                                    <p class="text-2xl font-bold">{{ $appointmentStats['today'] }}</p>
                                </div>
                                <svg class="w-10 h-10 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Top Products -->
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-lg sm:rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Produk Terlaris</h3>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Bulan ini</span>
                        </div>
                        <div class="space-y-4">
                            @foreach($topProducts as $index => $product)
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-slate-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                                <div class="flex items-center">
                                    <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center 
                                        @if($index == 0) bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-300
                                        @elseif($index == 1) bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300
                                        @elseif($index == 2) bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300
                                        @else bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300
                                        @endif rounded-full font-bold text-sm">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $product['name'] }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $product['category'] }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ number_format($product['sold']) }} unit</p>
                                    <p class="text-xs text-green-600 dark:text-green-400">Rp {{ number_format($product['revenue'] / 1000000, 1) }}M</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-lg sm:rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Aktivitas Terbaru</h3>
                            <span class="relative flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                            </span>
                        </div>
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                @foreach($recentActivities as $index => $activity)
                                <li>
                                    <div class="relative pb-8">
                                        @if($index < count($recentActivities) - 1)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-slate-600" aria-hidden="true"></span>
                                        @endif
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="h-8 w-8 rounded-full flex items-center justify-center ring-4 ring-white dark:ring-slate-800
                                                    @if($activity['color'] === 'blue') bg-blue-500
                                                    @elseif($activity['color'] === 'green') bg-green-500
                                                    @elseif($activity['color'] === 'yellow') bg-yellow-500
                                                    @elseif($activity['color'] === 'purple') bg-purple-500
                                                    @elseif($activity['color'] === 'red') bg-red-500
                                                    @else bg-gray-500 @endif">
                                                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        @if($activity['icon'] === 'shopping-cart')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                        @elseif($activity['icon'] === 'user-plus')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                                        @elseif($activity['icon'] === 'credit-card')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                        @elseif($activity['icon'] === 'calendar')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                        @endif
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                                <div>
                                                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $activity['message'] }}</p>
                                                </div>
                                                <div class="whitespace-nowrap text-right text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $activity['time'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ, Articles, and Messages Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                <!-- Recent FAQs -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 bg-gradient-to-r from-indigo-500 to-indigo-600 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">FAQ Terbaru</h3>
                        <a href="{{ route('admin.faqs.index') }}" class="text-xs text-indigo-100 hover:text-white">Lihat Semua →</a>
                    </div>
                    <div class="p-4 max-h-96 overflow-y-auto">
                        @forelse($recentFaqs as $faq)
                        <div class="mb-3 p-3 bg-gray-50 dark:bg-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-600 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2">{{ $faq->question }}</p>
                                    <span class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full 
                                        @if($faq->category == 'general') bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300
                                        @elseif($faq->category == 'appointment') bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300
                                        @elseif($faq->category == 'payment') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-300
                                        @elseif($faq->category == 'technical') bg-purple-100 text-purple-700 dark:bg-purple-900/50 dark:text-purple-300
                                        @else bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300
                                        @endif">
                                        {{ ucfirst($faq->category) }}
                                    </span>
                                </div>
                                <div class="flex space-x-1 ml-2">
                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="p-1.5 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus FAQ ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-600 hover:bg-red-100 dark:hover:bg-red-900/50 rounded" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 dark:text-gray-400 text-sm text-center py-4">Belum ada FAQ</p>
                        @endforelse
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-slate-700/50 border-t dark:border-slate-600">
                        <a href="{{ route('admin.faqs.create') }}" class="flex items-center justify-center text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah FAQ Baru
                        </a>
                    </div>
                </div>

                <!-- Recent Articles -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 bg-gradient-to-r from-emerald-500 to-emerald-600 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">Artikel Terbaru</h3>
                        <a href="{{ route('admin.articles.index') }}" class="text-xs text-emerald-100 hover:text-white">Lihat Semua →</a>
                    </div>
                    <div class="p-4 max-h-96 overflow-y-auto">
                        @forelse($recentArticles as $article)
                        <div class="mb-3 p-3 bg-gray-50 dark:bg-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-600 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white line-clamp-2">{{ $article->title }}</p>
                                    <div class="flex items-center mt-1 space-x-2">
                                        @php
                                            $catColor = $article->category_color ?? 'blue';
                                            $colorClasses = match($catColor) {
                                                'green' => 'bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300',
                                                'red' => 'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300',
                                                'orange' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/50 dark:text-orange-300',
                                                'purple' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/50 dark:text-purple-300',
                                                'pink' => 'bg-pink-100 text-pink-700 dark:bg-pink-900/50 dark:text-pink-300',
                                                'yellow' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-300',
                                                default => 'bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300',
                                            };
                                        @endphp
                                        <span class="inline-block px-2 py-0.5 text-xs rounded-full {{ $colorClasses }}">
                                            {{ $article->category }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $article->read_time ?? '5 min read' }}</span>
                                    </div>
                                </div>
                                <div class="flex space-x-1 ml-2">
                                    <a href="{{ route('admin.articles.edit', $article->id ?? $article->slug) }}" class="p-1.5 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article->id ?? $article->slug) }}" method="POST" class="inline" onsubmit="return confirm('Hapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-600 hover:bg-red-100 dark:hover:bg-red-900/50 rounded" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 dark:text-gray-400 text-sm text-center py-4">Belum ada artikel</p>
                        @endforelse
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-slate-700/50 border-t dark:border-slate-600">
                        <a href="{{ route('admin.articles.create') }}" class="flex items-center justify-center text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Artikel Baru
                        </a>
                    </div>
                </div>

                <!-- Recent Messages -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 bg-gradient-to-r from-rose-500 to-rose-600 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-white">Pesan Masuk</h3>
                        <a href="{{ route('admin.contacts.index') }}" class="text-xs text-rose-100 hover:text-white">Lihat Semua →</a>
                    </div>
                    <div class="p-4 max-h-96 overflow-y-auto">
                        @forelse($recentMessages as $message)
                        <div class="mb-3 p-3 bg-gray-50 dark:bg-slate-700 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-600 transition-colors {{ $message->status == 'unread' ? 'border-l-4 border-rose-500' : '' }}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $message->name }}</p>
                                        @if($message->status == 'unread')
                                        <span class="w-2 h-2 bg-rose-500 rounded-full"></span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2 mt-1">{{ $message->message }}</p>
                                    <div class="flex items-center mt-1 space-x-2">
                                        <span class="inline-block px-2 py-0.5 text-xs rounded-full 
                                            @if($message->subject == 'general') bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300
                                            @elseif($message->subject == 'appointment') bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300
                                            @elseif($message->subject == 'payment') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-300
                                            @elseif($message->subject == 'technical') bg-purple-100 text-purple-700 dark:bg-purple-900/50 dark:text-purple-300
                                            @elseif($message->subject == 'complaint') bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300
                                            @else bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300
                                            @endif">
                                            {{ ucfirst($message->subject) }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="flex space-x-1 ml-2">
                                    <a href="{{ route('admin.contacts.show', $message->id) }}" class="p-1.5 text-blue-600 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded" title="Lihat">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-600 hover:bg-red-100 dark:hover:bg-red-900/50 rounded" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 dark:text-gray-400 text-sm text-center py-4">Belum ada pesan</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart.js defaults for dark mode
        const isDarkMode = document.documentElement.classList.contains('dark');
        const textColor = isDarkMode ? '#e5e7eb' : '#374151';
        const gridColor = isDarkMode ? '#374151' : '#e5e7eb';
        
        Chart.defaults.color = textColor;
        Chart.defaults.borderColor = gridColor;

        // Sales Chart (Area Chart)
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesGradient = salesCtx.createLinearGradient(0, 0, 0, 300);
        salesGradient.addColorStop(0, 'rgba(168, 85, 247, 0.4)');
        salesGradient.addColorStop(1, 'rgba(168, 85, 247, 0.0)');
        
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlySales['labels']) !!},
                datasets: [{
                    label: 'Penjualan',
                    data: {!! json_encode($monthlySales['data']) !!},
                    borderColor: 'rgb(168, 85, 247)',
                    backgroundColor: salesGradient,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgb(168, 85, 247)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: gridColor },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value/1000000).toFixed(0) + 'M';
                            }
                        }
                    },
                    x: { grid: { display: false } }
                }
            }
        });

        // Weekly Performance Chart (Mixed)
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($weeklyPerformance['labels']) !!},
                datasets: [{
                    type: 'line',
                    label: 'Pendapatan',
                    data: {!! json_encode($weeklyPerformance['revenue']) !!},
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'transparent',
                    tension: 0.4,
                    yAxisID: 'y1',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }, {
                    type: 'bar',
                    label: 'Pesanan',
                    data: {!! json_encode($weeklyPerformance['orders']) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderRadius: 4,
                    yAxisID: 'y'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        grid: { color: gridColor },
                        title: { display: true, text: 'Pesanan' }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        title: { display: true, text: 'Pendapatan' },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value/1000000).toFixed(1) + 'M';
                            }
                        }
                    },
                    x: { grid: { display: false } }
                }
            }
        });

        // User Registration Chart
        const userRegCtx = document.getElementById('userRegistrationChart').getContext('2d');
        const userGradient = userRegCtx.createLinearGradient(0, 0, 0, 200);
        userGradient.addColorStop(0, 'rgba(59, 130, 246, 0.4)');
        userGradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)');
        
        new Chart(userRegCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyUsers['labels']) !!},
                datasets: [{
                    label: 'Pengguna Baru',
                    data: {!! json_encode($monthlyUsers['data']) !!},
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: userGradient,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: gridColor },
                        ticks: { precision: 0 }
                    },
                    x: { grid: { display: false } }
                }
            }
        });

        // User Role Distribution Chart
        const roleCtx = document.getElementById('userRoleChart').getContext('2d');
        new Chart(roleCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($userRoleDistribution)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($userRoleDistribution)) !!},
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(59, 130, 246, 0.8)'
                    ],
                    borderColor: [
                        'rgb(239, 68, 68)',
                        'rgb(34, 197, 94)',
                        'rgb(59, 130, 246)'
                    ],
                    borderWidth: 2,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>

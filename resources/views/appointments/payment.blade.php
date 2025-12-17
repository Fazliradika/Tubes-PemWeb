@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-slate-900 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Link -->
            <a href="{{ route('appointments.create', $doctor) }}"
                class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-700 mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Form Booking
            </a>

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Pembayaran Appointment</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-8">Pilih metode pembayaran untuk menyelesaikan booking</p>

            @if(session('error'))
                <div
                    class="mb-6 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('appointments.payment.process') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column: Summary -->
                    <div
                        class="bg-gradient-to-br from-blue-600 to-blue-700 dark:from-blue-700 dark:to-blue-800 rounded-xl p-6 text-white">
                        <h3 class="text-xl font-bold mb-6">Ringkasan Booking</h3>

                        <!-- Doctor -->
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mr-4">
                                @if($doctor->photo)
                                    <img src="{{ $doctor->photo }}" alt="{{ $doctor->user->name }}"
                                        class="w-full h-full rounded-full object-cover">
                                @else
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-lg">{{ $doctor->user->name }}</p>
                                <p class="text-blue-200">{{ $doctor->specialization }}</p>
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="space-y-4 border-t border-white/20 pt-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-200" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($booking['appointment_date'])->format('l, d F Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-blue-200" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $booking['appointment_time'] }}</span>
                            </div>
                            @if($booking['symptoms'])
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 mr-3 text-blue-200 mt-0.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="text-sm">{{ Str::limit($booking['symptoms'], 100) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Total -->
                        <div class="border-t border-white/20 mt-6 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-lg">Total Biaya</span>
                                <span class="text-2xl font-bold">Rp
                                    {{ number_format($booking['total_price'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Payment Methods -->
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                            <i class="fas fa-credit-card mr-2"></i>Metode Pembayaran
                        </h3>

                        <div class="space-y-3">
                            <label
                                class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                                <input type="radio" name="payment_method" value="bank_transfer" required
                                    class="mr-3 text-blue-600">
                                <div class="flex items-center flex-1">
                                    <i class="fas fa-university text-blue-600 text-2xl mr-3"></i>
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-white">Transfer Bank</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">BCA, BNI, Mandiri, BRI</div>
                                    </div>
                                </div>
                            </label>

                            <label
                                class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                                <input type="radio" name="payment_method" value="credit_card" required
                                    class="mr-3 text-blue-600">
                                <div class="flex items-center flex-1">
                                    <i class="fas fa-credit-card text-blue-600 text-2xl mr-3"></i>
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-white">Kartu Kredit/Debit</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">Visa, Mastercard, JCB</div>
                                    </div>
                                </div>
                            </label>

                            <label
                                class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                                <input type="radio" name="payment_method" value="e_wallet" required
                                    class="mr-3 text-blue-600">
                                <div class="flex items-center flex-1">
                                    <i class="fas fa-wallet text-blue-600 text-2xl mr-3"></i>
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-white">E-Wallet</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">GoPay, OVO, DANA, ShopeePay
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label
                                class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                                <input type="radio" name="payment_method" value="qris" required class="mr-3 text-blue-600">
                                <div class="flex items-center flex-1">
                                    <i class="fas fa-qrcode text-blue-600 text-2xl mr-3"></i>
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-white">QRIS</div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">Scan QR untuk bayar</div>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full mt-6 bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition-colors">
                            <i class="fas fa-check-circle mr-2"></i>Bayar & Konfirmasi Booking
                        </button>

                        <p class="mt-4 text-center text-sm text-gray-500 dark:text-gray-400">
                            <i class="fas fa-lock mr-1"></i>
                            Transaksi Anda aman dan terenkripsi
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
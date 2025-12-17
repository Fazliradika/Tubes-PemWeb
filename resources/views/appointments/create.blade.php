@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-slate-900 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('appointments.index') }}"
                    class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar Dokter
                </a>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg overflow-hidden">
                <div class="md:flex">
                    <!-- Doctor Info Section -->
                    <div
                        class="md:w-1/3 bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 p-8 text-white">
                        <div class="text-center">
                            @if($doctor->photo)
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=300&background=4F46E5&color=fff&bold=true"
                                    alt="{{ $doctor->user->name }}"
                                    class="w-32 h-32 rounded-full mx-auto mb-4 border-4 border-white object-cover">
                            @else
                                <div
                                    class="w-32 h-32 bg-white dark:bg-slate-700 rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif

                            <h2 class="text-2xl font-bold mb-2">{{ $doctor->user->name }}</h2>
                            <p class="text-blue-100 mb-4">{{ $doctor->specialization }}</p>

                            @if($doctor->years_of_experience > 0)
                                <div class="mb-4">
                                    <p class="text-sm text-blue-100">Pengalaman</p>
                                    <p class="text-xl font-semibold">{{ $doctor->years_of_experience }} tahun</p>
                                </div>
                            @endif

                            <div class="mb-4">
                                <p class="text-sm text-blue-100">Alamat Rumah Sakit</p>
                                <p class="text-base font-medium">HealthFirst Medical</p>
                                <p class="text-sm">Jl. Soekarno Hatta No. 576</p>
                                <p class="text-sm">Bandung, Jawa Barat 40286</p>
                            </div>

                            <div class="bg-white/20 rounded-lg p-4 mt-6">
                                <p class="text-sm text-blue-100 mb-1">Harga per sesi</p>
                                <p class="text-3xl font-bold">Rp
                                    {{ number_format($doctor->price_per_session, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form Section -->
                    <div class="md:w-2/3 p-8 dark:bg-slate-800">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Buat Appointment</h3>

                        @if(session('success'))
                            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Doctor Schedule Info -->
                        <div
                            class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Jadwal Praktik:</h4>
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($doctor->available_days as $day)
                                    <span class="px-3 py-1 bg-blue-600 dark:bg-blue-700 text-white text-sm rounded-full">
                                        {{ $day }}
                                    </span>
                                @endforeach
                            </div>
                            <p class="text-gray-700 dark:text-gray-300">
                                <strong>Jam:</strong>
                                {{ \Carbon\Carbon::parse($doctor->start_time)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($doctor->end_time)->format('H:i') }}
                            </p>
                        </div>

                        @if($doctor->bio)
                            <div class="mb-6">
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Tentang Dokter:</h4>
                                <p class="text-gray-600 dark:text-gray-400">{{ $doctor->bio }}</p>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('appointments.store', $doctor) }}" class="space-y-6">
                            @csrf

                            <div>
                                <label for="appointment_date"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Appointment <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="appointment_date" name="appointment_date" min="{{ date('Y-m-d') }}"
                                    required
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('appointment_date') border-red-500 @enderror">
                                @error('appointment_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="appointment_time"
                                    class="block text-sm font-medium text-gray-900 dark:text-gray-200 mb-2">
                                    Waktu Appointment <span class="text-red-500">*</span>
                                </label>
                                <input type="time" id="appointment_time" name="appointment_time"
                                    min="{{ \Carbon\Carbon::parse($doctor->start_time)->format('H:i') }}"
                                    max="{{ \Carbon\Carbon::parse($doctor->end_time)->format('H:i') }}" required
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('appointment_time') border-red-500 @enderror">
                                @error('appointment_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    Pilih waktu antara {{ \Carbon\Carbon::parse($doctor->start_time)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($doctor->end_time)->format('H:i') }}
                                </p>
                            </div>

                            <div>
                                <label for="symptoms"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Keluhan / Gejala (Opsional)
                                </label>
                                <textarea id="symptoms" name="symptoms" rows="4"
                                    placeholder="Ceritakan keluhan atau gejala yang Anda alami..."
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('symptoms') border-red-500 @enderror">{{ old('symptoms') }}</textarea>
                                @error('symptoms')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="border-t dark:border-gray-700 pt-4 mt-4">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-lg font-semibold text-gray-900 dark:text-white">Total Biaya:</span>
                                    <span class="text-2xl font-bold text-green-600 dark:text-green-400">
                                        Rp {{ number_format($doctor->price_per_session, 0, ',', '.') }}
                                    </span>
                                </div>

                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors duration-200">
                                    Konfirmasi Booking
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
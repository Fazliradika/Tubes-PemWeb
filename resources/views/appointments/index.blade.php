@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-slate-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Book Appointment</h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Pilih dokter dan jadwalkan konsultasi Anda</p>
                <p class="mt-1 text-sm text-blue-600 dark:text-blue-400">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    Jl. Soekarno Hatta No. 576, Bandung, Jawa Barat 40286
                </p>
            </div>

            <!-- Filter Section -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6 mb-6">
                <form method="GET" action="{{ route('appointments.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label for="specialization" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Filter by Specialization
                        </label>
                        <select name="specialization" id="specialization"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            onchange="this.form.submit()">
                            <option value="all" {{ $specialization == 'all' ? 'selected' : '' }}>Semua Spesialis</option>
                            @foreach($specializations as $spec)
                                <option value="{{ $spec }}" {{ $specialization == $spec ? 'selected' : '' }}>
                                    {{ $spec }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1 min-w-[200px]">
                        <label for="day" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Filter by Day
                        </label>
                        <select name="day" id="day"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            onchange="this.form.submit()">
                            <option value="all" {{ $day == 'all' ? 'selected' : '' }}>All Days</option>
                            <option value="Monday" {{ $day == 'Monday' ? 'selected' : '' }}>Monday</option>
                            <option value="Tuesday" {{ $day == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                            <option value="Wednesday" {{ $day == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                            <option value="Thursday" {{ $day == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                            <option value="Friday" {{ $day == 'Friday' ? 'selected' : '' }}>Friday</option>
                            <option value="Saturday" {{ $day == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                            <option value="Sunday" {{ $day == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Doctors Grid -->
            @if($doctors->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($doctors as $doctor)
                        <div
                            class="bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <!-- Doctor Photo -->
                            <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 relative">
                                @if($doctor->photo)
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($doctor->name) }}&size=200&background=4F46E5&color=fff&bold=true"
                                        alt="{{ $doctor->user->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="w-32 h-32 bg-white dark:bg-slate-700 rounded-full flex items-center justify-center">
                                            <svg class="w-20 h-20 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Doctor Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">
                                    {{ $doctor->user->name }}
                                </h3>

                                <p class="text-blue-600 dark:text-blue-400 font-semibold mb-3">
                                    {{ $doctor->specialization }}
                                </p>

                                @if($doctor->years_of_experience > 0)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                        <span class="font-medium">Pengalaman:</span> {{ $doctor->years_of_experience }} tahun
                                    </p>
                                @endif

                                @if($doctor->bio)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                        {{ $doctor->bio }}
                                    </p>
                                @endif

                                <!-- Schedule -->
                                <div class="mb-4 p-3 bg-gray-50 dark:bg-slate-700 rounded-lg">
                                    <p class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-2">Jadwal Praktik:</p>
                                    <div class="flex flex-wrap gap-1 mb-2">
                                        @foreach($doctor->available_days as $day)
                                            <span
                                                class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 text-xs rounded">
                                                {{ $day }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($doctor->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($doctor->end_time)->format('H:i') }}
                                    </p>
                                </div>

                                <!-- Hospital Address -->
                                <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                                    <p class="text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Alamat Rumah Sakit:</p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">HealthFirst Medical</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Jl. Soekarno Hatta No. 576</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Bandung, Jawa Barat 40286</p>
                                </div>

                                <!-- Price -->
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Harga per sesi</p>
                                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">
                                            Rp {{ number_format($doctor->price_per_session, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Book Button -->
                                <a href="{{ route('appointments.create', $doctor) }}"
                                    class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg text-center transition-colors duration-200">
                                    Book Appointment
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada dokter tersedia</h3>
                    <p class="text-gray-600">Silakan coba filter yang berbeda atau cek kembali nanti.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
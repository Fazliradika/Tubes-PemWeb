<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Jadwal Saya') }}
            </h2>
            <a href="{{ route('doctor.dashboard') }}" class="text-white hover:text-gray-200">
                ← Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Doctor Info -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="h-16 w-16 bg-blue-100 dark:bg-blue-900/50 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ substr($doctor->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $doctor->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $doctorProfile->specialization }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar View -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Jadwal 30 Hari Ke Depan</h3>
                        <a href="{{ route('doctor.appointments.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                            + Buat Appointment
                        </a>
                    </div>

                    @if($appointmentsByDate->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Tidak ada jadwal</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada appointment yang dijadwalkan untuk 30 hari ke depan.</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($appointmentsByDate as $date => $appointments)
                                @php
                                    $dateObj = \Carbon\Carbon::parse($date);
                                    $isToday = $dateObj->isToday();
                                    $isTomorrow = $dateObj->isTomorrow();
                                @endphp
                                
                                <div class="border border-gray-200 dark:border-slate-700 rounded-lg p-4 {{ $isToday ? 'bg-blue-50 dark:bg-blue-900/20 border-blue-300 dark:border-blue-700' : 'bg-white dark:bg-slate-800' }}">
                                    <!-- Date Header -->
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                {{ $dateObj->format('d F Y') }}
                                            </h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $dateObj->format('l') }}
                                                @if($isToday)
                                                    <span class="ml-2 px-2 py-1 text-xs rounded-full bg-blue-600 text-white">Hari Ini</span>
                                                @elseif($isTomorrow)
                                                    <span class="ml-2 px-2 py-1 text-xs rounded-full bg-green-600 text-white">Besok</span>
                                                @endif
                                            </p>
                                        </div>
                                        <span class="px-3 py-1 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium">
                                            {{ $appointments->count() }} Appointment
                                        </span>
                                    </div>

                                    <!-- Appointments List -->
                                    <div class="space-y-3">
                                        @foreach($appointments as $appointment)
                                            <div class="flex items-center justify-between p-3 bg-white dark:bg-slate-700/50 rounded-lg border border-gray-200 dark:border-slate-600 hover:shadow-md transition">
                                                <div class="flex items-center space-x-4 flex-1">
                                                    <!-- Time -->
                                                    <div class="text-center min-w-[60px]">
                                                        <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                                        </div>
                                                    </div>

                                                    <!-- Patient Info -->
                                                    <div class="flex-1">
                                                        <h5 class="font-semibold text-gray-900 dark:text-white">{{ $appointment->patient->name }}</h5>
                                                        @if($appointment->symptoms)
                                                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ Str::limit($appointment->symptoms, 50) }}</p>
                                                        @endif
                                                    </div>

                                                    <!-- Status -->
                                                    <div>
                                                        @if($appointment->status === 'completed')
                                                            <span class="px-3 py-1 text-sm rounded-full bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 font-medium">
                                                                Selesai
                                                            </span>
                                                        @elseif($appointment->status === 'confirmed')
                                                            <span class="px-3 py-1 text-sm rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 font-medium">
                                                                Terkonfirmasi
                                                            </span>
                                                        @elseif($appointment->status === 'pending')
                                                            <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200 font-medium">
                                                                Pending
                                                            </span>
                                                        @elseif($appointment->status === 'cancelled')
                                                            <span class="px-3 py-1 text-sm rounded-full bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 font-medium">
                                                                Dibatalkan
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Action Button -->
                                                <div class="ml-4">
                                                    <a href="{{ route('doctor.appointments.show', $appointment->id) }}"
                                                        class="px-4 py-2 text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-md transition">
                                                        Detail
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                @php
                    $totalAppointments = $appointmentsByDate->flatten()->count();
                    $confirmedCount = $appointmentsByDate->flatten()->where('status', 'confirmed')->count();
                    $pendingCount = $appointmentsByDate->flatten()->where('status', 'pending')->count();
                    $completedCount = $appointmentsByDate->flatten()->where('status', 'completed')->count();
                @endphp

                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Total Appointment</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalAppointments }}</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Terkonfirmasi</div>
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $confirmedCount }}</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Pending</div>
                        <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $pendingCount }}</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Selesai</div>
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $completedCount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

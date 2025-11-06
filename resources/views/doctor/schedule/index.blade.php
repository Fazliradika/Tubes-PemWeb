<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Jadwal Saya') }}
            </h2>
            <a href="{{ route('doctor.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                ← Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Doctor Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center space-x-4">
                        <div class="h-16 w-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-blue-600">{{ substr($doctor->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $doctor->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $doctorProfile->specialization }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar View -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Jadwal 30 Hari Ke Depan</h3>
                        <a href="{{ route('doctor.appointments.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                            + Buat Appointment
                        </a>
                    </div>

                    @if($appointmentsByDate->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada jadwal</h3>
                            <p class="mt-1 text-sm text-gray-500">Belum ada appointment yang dijadwalkan untuk 30 hari ke depan.</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($appointmentsByDate as $date => $appointments)
                                @php
                                    $dateObj = \Carbon\Carbon::parse($date);
                                    $isToday = $dateObj->isToday();
                                    $isTomorrow = $dateObj->isTomorrow();
                                @endphp
                                
                                <div class="border border-gray-200 rounded-lg p-4 {{ $isToday ? 'bg-blue-50 border-blue-300' : '' }}">
                                    <!-- Date Header -->
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-900">
                                                {{ $dateObj->format('d F Y') }}
                                            </h4>
                                            <p class="text-sm text-gray-600">
                                                {{ $dateObj->format('l') }}
                                                @if($isToday)
                                                    <span class="ml-2 px-2 py-1 text-xs rounded-full bg-blue-600 text-white">Hari Ini</span>
                                                @elseif($isTomorrow)
                                                    <span class="ml-2 px-2 py-1 text-xs rounded-full bg-green-600 text-white">Besok</span>
                                                @endif
                                            </p>
                                        </div>
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm font-medium">
                                            {{ $appointments->count() }} Appointment
                                        </span>
                                    </div>

                                    <!-- Appointments List -->
                                    <div class="space-y-3">
                                        @foreach($appointments as $appointment)
                                            <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200 hover:shadow-md transition">
                                                <div class="flex items-center space-x-4 flex-1">
                                                    <!-- Time -->
                                                    <div class="text-center min-w-[60px]">
                                                        <div class="text-lg font-semibold text-gray-900">
                                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                                        </div>
                                                    </div>

                                                    <!-- Patient Info -->
                                                    <div class="flex-1">
                                                        <h5 class="font-semibold text-gray-900">{{ $appointment->patient->name }}</h5>
                                                        @if($appointment->symptoms)
                                                            <p class="text-sm text-gray-600">{{ Str::limit($appointment->symptoms, 50) }}</p>
                                                        @endif
                                                    </div>

                                                    <!-- Status -->
                                                    <div>
                                                        @if($appointment->status === 'completed')
                                                            <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-800 font-medium">
                                                                Selesai
                                                            </span>
                                                        @elseif($appointment->status === 'confirmed')
                                                            <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800 font-medium">
                                                                Terkonfirmasi
                                                            </span>
                                                        @elseif($appointment->status === 'pending')
                                                            <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800 font-medium">
                                                                Pending
                                                            </span>
                                                        @elseif($appointment->status === 'cancelled')
                                                            <span class="px-3 py-1 text-sm rounded-full bg-red-100 text-red-800 font-medium">
                                                                Dibatalkan
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Action Button -->
                                                <div class="ml-4">
                                                    <a href="{{ route('doctor.appointments.show', $appointment->id) }}"
                                                        class="px-4 py-2 text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-md transition">
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

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="text-sm text-gray-600">Total Appointment</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalAppointments }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="text-sm text-gray-600">Terkonfirmasi</div>
                        <div class="text-2xl font-bold text-blue-600">{{ $confirmedCount }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="text-sm text-gray-600">Pending</div>
                        <div class="text-2xl font-bold text-yellow-600">{{ $pendingCount }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4">
                        <div class="text-sm text-gray-600">Selesai</div>
                        <div class="text-2xl font-bold text-green-600">{{ $completedCount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

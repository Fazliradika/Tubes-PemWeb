<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Data Pasien') }}
            </h2>
            <a href="{{ route('doctor.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                ← Kembali ke Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($patients->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pasien</h3>
                            <p class="mt-1 text-sm text-gray-500">Belum ada pasien yang melakukan booking dengan Anda.</p>
                        </div>
                    @else
                        <div class="grid gap-6">
                            @foreach($patients as $patient)
                                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                                    <!-- Patient Info -->
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $patient->name }}</h3>
                                            <p class="text-sm text-gray-600">{{ $patient->email }}</p>
                                            @if($patient->phone)
                                                <p class="text-sm text-gray-600">{{ $patient->phone }}</p>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                {{ $patient->appointments->count() }} Appointment
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Appointment History -->
                                    <div class="mt-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-3">Riwayat Appointment:</h4>
                                        <div class="space-y-2">
                                            @foreach($patient->appointments->take(5) as $appointment)
                                                <div class="flex items-center justify-between text-sm bg-gray-50 p-3 rounded">
                                                    <div class="flex items-center space-x-4">
                                                        <span class="text-gray-600">
                                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                                        </span>
                                                        <span class="text-gray-600">
                                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                                        </span>
                                                        @if($appointment->symptoms)
                                                            <span class="text-gray-500 text-xs">
                                                                {{ Str::limit($appointment->symptoms, 30) }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        @if($appointment->status === 'completed')
                                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                                Selesai
                                                            </span>
                                                        @elseif($appointment->status === 'confirmed')
                                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                                                Terkonfirmasi
                                                            </span>
                                                        @elseif($appointment->status === 'pending')
                                                            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                                                Pending
                                                            </span>
                                                        @elseif($appointment->status === 'cancelled')
                                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">
                                                                Dibatalkan
                                                            </span>
                                                        @endif
                                                        <a href="{{ route('doctor.appointments.show', $appointment->id) }}" 
                                                            class="text-blue-600 hover:text-blue-800">
                                                            Detail
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                            
                                            @if($patient->appointments->count() > 5)
                                                <p class="text-sm text-gray-500 text-center pt-2">
                                                    Dan {{ $patient->appointments->count() - 5 }} appointment lainnya
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="mt-4 flex space-x-3">
                                        <a href="{{ route('doctor.appointments.create') }}?patient_id={{ $patient->id }}"
                                            class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                            Buat Appointment Baru
                                        </a>
                                        @if($patient->appointments->where('status', 'completed')->count() > 0)
                                            <a href="{{ route('doctor.prescriptions.index') }}?patient_id={{ $patient->id }}"
                                                class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                                                Lihat Resep
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

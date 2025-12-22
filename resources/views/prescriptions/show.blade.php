<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Resep Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Prescription Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6 pb-4 border-b">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Resep #{{ $prescription->id }}</h3>
                            <p class="text-sm text-gray-500">{{ $prescription->prescription_date->format('d F Y') }}</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            @php
                                $statusColors = [
                                    'active' => 'bg-green-100 text-green-800',
                                    'completed' => 'bg-blue-100 text-blue-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $statusLabels = [
                                    'active' => 'Aktif',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$prescription->status] ?? 'bg-gray-100' }}">
                                {{ $statusLabels[$prescription->status] ?? $prescription->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Doctor & Patient Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="p-4 bg-blue-50 rounded-lg">
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Dokter</h4>
                            <div class="flex items-center">
                                <div class="h-12 w-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    {{ substr($prescription->doctor->user->name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">Dr. {{ $prescription->doctor->user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $prescription->doctor->specialization }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-green-50 rounded-lg">
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Pasien</h4>
                            <div class="flex items-center">
                                <div class="h-12 w-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                    {{ substr($prescription->patient->name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <p class="font-medium text-gray-900">{{ $prescription->patient->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $prescription->patient->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Diagnosis -->
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Diagnosis</h4>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <p class="text-gray-800">{{ $prescription->diagnosis }}</p>
                        </div>
                    </div>

                    <!-- Medicines -->
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Obat yang Diresepkan</h4>
                        <div class="space-y-3">
                            @foreach($prescription->items as $item)
                            <div class="p-4 border rounded-lg hover:shadow-sm transition">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                            </svg>
                                            <h5 class="font-medium text-gray-900">{{ $item->product->name ?? 'N/A' }}</h5>
                                        </div>
                                        <div class="mt-2 flex flex-wrap gap-3 text-sm text-gray-600">
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $item->dosage }}
                                            </span>
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                                </svg>
                                                {{ $item->quantity }} pcs
                                            </span>
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $item->duration_days }} hari
                                            </span>
                                        </div>
                                        @if($item->instructions)
                                        <p class="mt-2 text-sm text-gray-500 italic">
                                            <span class="font-medium">Instruksi:</span> {{ $item->instructions }}
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    @if($prescription->notes)
                    <!-- Notes -->
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Catatan Dokter</h4>
                        <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                            <p class="text-gray-800">{{ $prescription->notes }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t">
                        @if(Auth::user()->role === 'doctor')
                            <a href="{{ route('doctor.prescriptions.index') }}" 
                               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                                Kembali
                            </a>
                            @if($prescription->status === 'active')
                            <a href="{{ route('doctor.prescriptions.edit', $prescription) }}" 
                               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                                Edit Resep
                            </a>
                            @endif
                        @else
                            <a href="{{ route('prescriptions.index') }}" 
                               class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                                Kembali
                            </a>
                            <button onclick="window.print()" 
                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition inline-flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                </svg>
                                Cetak Resep
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Appointment Info (if linked) -->
            @if($prescription->appointment)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Terkait Appointment</h4>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-900">
                                {{ $prescription->appointment->appointment_date->format('d M Y') }} 
                                • {{ \Carbon\Carbon::parse($prescription->appointment->appointment_time)->format('H:i') }} WIB
                            </p>
                            <p class="text-sm text-gray-600">{{ $prescription->appointment->symptoms }}</p>
                        </div>
                        @if(Auth::user()->role === 'doctor')
                        <a href="{{ route('doctor.appointments.show', $prescription->appointment) }}" 
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Lihat Detail →
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>

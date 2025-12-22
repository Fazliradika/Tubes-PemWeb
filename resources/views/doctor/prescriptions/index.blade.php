<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resep Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Pending Appointments Section -->
            @if(isset($pendingAppointments) && $pendingAppointments->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Appointment Siap Dibuatkan Resep
                            </span>
                        </h3>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                            {{ $pendingAppointments->count() }} appointment
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($pendingAppointments as $appointment)
                        <div class="border rounded-lg p-4 hover:shadow-md transition bg-gradient-to-br from-blue-50 to-white">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                        {{ substr($appointment->patient->name ?? 'N', 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900">{{ $appointment->patient->name ?? 'N/A' }}</p>
                                        <p class="text-xs text-gray-500">{{ $appointment->appointment_date->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Confirmed</span>
                            </div>
                            
                            <div class="mb-3">
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    <span class="font-medium">Keluhan:</span> {{ Str::limit($appointment->symptoms, 80) }}
                                </p>
                            </div>

                            <a href="{{ route('doctor.prescriptions.create', $appointment) }}" 
                               class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Buat Resep
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Daftar Resep yang Dibuat</h3>

                    @if($prescriptions->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pasien</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnosis</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Obat</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($prescriptions as $prescription)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $prescription->prescription_date->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $prescription->patient->name ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900 max-w-xs truncate">
                                                    {{ $prescription->diagnosis }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $prescription->items->count() }} obat
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
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
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$prescription->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                    {{ $statusLabels[$prescription->status] ?? $prescription->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('doctor.prescriptions.show', $prescription) }}" class="text-blue-600 hover:text-blue-900 mr-3">Lihat</a>
                                                @if($prescription->status === 'active')
                                                    <a href="{{ route('doctor.prescriptions.edit', $prescription) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $prescriptions->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Resep</h3>
                            <p class="text-gray-600 mb-4">Anda belum membuat resep obat untuk pasien.</p>
                            @if(!isset($pendingAppointments) || $pendingAppointments->count() == 0)
                                <p class="text-sm text-gray-500">Konfirmasi appointment terlebih dahulu untuk bisa membuat resep.</p>
                                <a href="{{ route('doctor.appointments.index') }}" 
                                   class="inline-flex items-center mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                                    Lihat Daftar Appointment
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


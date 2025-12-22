<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Detail Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Appointment Info -->
                    <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informasi Appointment</h3>
                                @if($appointment->status === 'pending')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200">
                                        Pending
                                    </span>
                                @elseif($appointment->status === 'confirmed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-200">
                                        Confirmed
                                    </span>
                                @elseif($appointment->status === 'completed')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200">
                                        Completed
                                    </span>
                                @elseif($appointment->status === 'cancelled')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200">
                                        Cancelled
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal & Waktu</p>
                                        <p class="text-sm text-gray-900 dark:text-white">{{ $appointment->appointment_date->format('d M Y') }} • {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }} WIB</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Biaya Konsultasi</p>
                                        <p class="text-sm text-gray-900 dark:text-white">Rp {{ number_format($appointment->total_price, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Keluhan Pasien</p>
                                        <p class="text-sm text-gray-900 dark:text-white">{{ $appointment->symptoms }}</p>
                                    </div>
                                </div>

                                @if($appointment->notes)
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Catatan</p>
                                            <p class="text-sm text-gray-900 dark:text-white">{{ $appointment->notes }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Prescription Section -->
                    @if($appointment->prescription)
                        <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Resep Obat</h3>
                                    <a href="{{ route('doctor.prescriptions.edit', $appointment->prescription) }}" 
                                       class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">
                                        Edit Resep
                                    </a>
                                </div>

                                <div class="mb-4">
                                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Diagnosis:</p>
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $appointment->prescription->diagnosis }}</p>
                                </div>

                                <div class="space-y-3">
                                    @foreach($appointment->prescription->items as $item)
                                        <div class="bg-gray-50 dark:bg-slate-700 p-4 rounded-lg">
                                            <p class="font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $item->dosage }} • {{ $item->quantity }} pcs • {{ $item->duration_days }} hari
                                            </p>
                                            @if($item->instructions)
                                                <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">{{ $item->instructions }}</p>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Belum ada resep</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Buat resep untuk pasien ini</p>
                                <div class="mt-6">
                                    <a href="{{ route('doctor.prescriptions.create', $appointment) }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                        Buat Resep
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Patient Info -->
                    <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Pasien</h3>
                            
                            <div class="flex items-center mb-4">
                                <div class="h-16 w-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-2xl">
                                    {{ substr($appointment->patient->name, 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-900 dark:text-white">{{ $appointment->patient->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $appointment->patient->role }}</p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Email</p>
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $appointment->patient->email }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Telepon</p>
                                    <p class="text-sm text-gray-900 dark:text-white">{{ $appointment->patient->phone }}</p>
                                </div>
                                @if($appointment->patient->date_of_birth)
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Tanggal Lahir</p>
                                        <p class="text-sm text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($appointment->patient->date_of_birth)->format('d M Y') }}</p>
                                    </div>
                                @endif
                                @if($appointment->patient->address)
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Alamat</p>
                                        <p class="text-sm text-gray-900 dark:text-white">{{ $appointment->patient->address }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Aksi</h3>
                            <div class="space-y-3">
                                @if($appointment->status === 'pending')
                                    <form action="{{ route('doctor.appointments.confirm', $appointment) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                                            Konfirmasi Appointment
                                        </button>
                                    </form>
                                @endif

                                @if($appointment->status === 'confirmed' && !$appointment->prescription)
                                    <a href="{{ route('doctor.prescriptions.create', $appointment) }}" 
                                       class="block w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg text-center transition">
                                        Buat Resep
                                    </a>
                                @endif

                                @if($appointment->conversation)
                                    <a href="{{ route('doctor.chat.show', $appointment->conversation) }}" 
                                       class="block w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg text-center transition">
                                        Buka Chat
                                    </a>
                                @endif

                                @if($appointment->status === 'pending' || $appointment->status === 'confirmed')
                                    <button onclick="showCancelModal()" 
                                            class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition">
                                        Batalkan Appointment
                                    </button>
                                @endif

                                <a href="{{ route('doctor.appointments.index') }}" 
                                   class="block w-full px-4 py-2 bg-gray-200 dark:bg-slate-700 hover:bg-gray-300 dark:hover:bg-slate-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg text-center transition">
                                    Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div id="cancelModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white dark:bg-slate-800 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl border dark:border-slate-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Batalkan Appointment</h3>
            <form action="{{ route('doctor.appointments.cancel', $appointment) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alasan Pembatalan</label>
                    <textarea name="reason" rows="3" 
                              class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                              placeholder="Masukkan alasan pembatalan..."></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="hideCancelModal()" 
                            class="flex-1 px-4 py-2 bg-gray-200 dark:bg-slate-700 hover:bg-gray-300 dark:hover:bg-slate-600 text-gray-700 dark:text-gray-300 rounded-lg">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg">
                        Batalkan Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function showCancelModal() {
            document.getElementById('cancelModal').classList.remove('hidden');
        }
        function hideCancelModal() {
            document.getElementById('cancelModal').classList.add('hidden');
        }
    </script>
    @endpush
</x-app-layout>

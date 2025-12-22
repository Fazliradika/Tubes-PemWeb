<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Resep Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded print:hidden">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Prescription Card (Printable) -->
            <div id="prescription-card" class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 print:shadow-none print:rounded-none">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6 pb-4 border-b dark:border-slate-700">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Resep #{{ $prescription->id }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $prescription->prescription_date->format('d F Y') }}</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            @php
                                $statusColors = [
                                    'active' => 'bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200',
                                    'completed' => 'bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-200',
                                    'cancelled' => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200',
                                ];
                                $statusLabels = [
                                    'active' => 'Aktif',
                                    'completed' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$prescription->status] ?? 'bg-gray-100 dark:bg-gray-700' }}">
                                {{ $statusLabels[$prescription->status] ?? $prescription->status }}
                            </span>
                        </div>
                    </div>

                    <!-- Doctor & Patient Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Dokter</h4>
                            <div class="flex items-center">
                                <div class="h-12 w-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg print:hidden">
                                    {{ substr($prescription->doctor->user->name, 0, 1) }}
                                </div>
                                <div class="ml-3 print:ml-0">
                                    <p class="font-medium text-gray-900 dark:text-white">Dr. {{ $prescription->doctor->user->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $prescription->doctor->specialization }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Pasien</h4>
                            <div class="flex items-center">
                                <div class="h-12 w-12 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-lg print:hidden">
                                    {{ substr($prescription->patient->name, 0, 1) }}
                                </div>
                                <div class="ml-3 print:ml-0">
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $prescription->patient->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $prescription->patient->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Diagnosis -->
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Diagnosis</h4>
                        <div class="p-4 bg-gray-50 dark:bg-slate-700 rounded-lg">
                            <p class="text-gray-800 dark:text-gray-200">{{ $prescription->diagnosis }}</p>
                        </div>
                    </div>

                    <!-- Medicines -->
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Obat yang Diresepkan</h4>
                        <div class="space-y-3">
                            @foreach($prescription->items as $item)
                            <div class="p-4 border dark:border-slate-600 rounded-lg hover:shadow-sm transition bg-white dark:bg-slate-700/50">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                            </svg>
                                            <h5 class="font-medium text-gray-900 dark:text-white">{{ $item->product->name ?? 'N/A' }}</h5>
                                        </div>
                                        <div class="mt-2 flex flex-wrap gap-3 text-sm text-gray-600 dark:text-gray-300">
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $item->dosage }}
                                            </span>
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                                </svg>
                                                {{ $item->quantity }} pcs
                                            </span>
                                            <span class="inline-flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $item->duration_days }} hari
                                            </span>
                                        </div>
                                        @if($item->instructions)
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 italic">
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
                        <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Catatan Dokter</h4>
                        <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800/30">
                            <p class="text-gray-800 dark:text-gray-200">{{ $prescription->notes }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Actions (Hidden when printing) -->
                    <div class="flex items-center justify-between pt-4 border-t dark:border-slate-700 print:hidden">
                        @if(Auth::user()->role === 'doctor')
                            <a href="{{ route('doctor.prescriptions.index') }}" 
                               class="px-4 py-2 bg-gray-200 dark:bg-slate-600 hover:bg-gray-300 dark:hover:bg-slate-500 text-gray-700 dark:text-gray-200 rounded-lg transition">
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
                               class="px-4 py-2 bg-gray-200 dark:bg-slate-600 hover:bg-gray-300 dark:hover:bg-slate-500 text-gray-700 dark:text-gray-200 rounded-lg transition">
                                Kembali
                            </a>
                            <button onclick="printPrescription()" 
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

            <!-- Appointment Info (Hidden when printing) -->
            @if($prescription->appointment)
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg print:hidden">
                <div class="p-6">
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Terkait Appointment</h4>
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-slate-700 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ $prescription->appointment->appointment_date->format('d M Y') }} 
                                • {{ \Carbon\Carbon::parse($prescription->appointment->appointment_time)->format('H:i') }} WIB
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $prescription->appointment->symptoms }}</p>
                        </div>
                        @if(Auth::user()->role === 'doctor')
                        <a href="{{ route('doctor.appointments.show', $prescription->appointment) }}" 
                           class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                            Lihat Detail →
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        function printPrescription() {
            // Create a new window for printing
            const printContent = document.getElementById('prescription-card').innerHTML;
            const printWindow = window.open('', '', 'width=800,height=600');
            
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Resep #{{ $prescription->id }} - {{ $prescription->patient->name }}</title>
                    <style>
                        * { margin: 0; padding: 0; box-sizing: border-box; }
                        body { 
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
                            padding: 20px;
                            color: #1f2937;
                            background: white;
                        }
                        .p-6 { padding: 24px; }
                        .p-4 { padding: 16px; }
                        .mb-6 { margin-bottom: 24px; }
                        .mb-3 { margin-bottom: 12px; }
                        .mb-2 { margin-bottom: 8px; }
                        .mt-2 { margin-top: 8px; }
                        .pb-4 { padding-bottom: 16px; }
                        .pt-4 { padding-top: 16px; }
                        .ml-3 { margin-left: 12px; }
                        .mr-1 { margin-right: 4px; }
                        .mr-2 { margin-right: 8px; }
                        .space-y-3 > * + * { margin-top: 12px; }
                        .gap-3 { gap: 12px; }
                        .gap-6 { gap: 24px; }
                        .flex { display: flex; }
                        .flex-wrap { flex-wrap: wrap; }
                        .items-center { align-items: center; }
                        .items-start { align-items: flex-start; }
                        .justify-between { justify-content: space-between; }
                        .flex-1 { flex: 1; }
                        .inline-flex { display: inline-flex; }
                        .grid { display: grid; }
                        .grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
                        .rounded-lg { border-radius: 8px; }
                        .rounded-full { border-radius: 9999px; }
                        .border { border: 1px solid #e5e7eb; }
                        .border-b { border-bottom: 1px solid #e5e7eb; }
                        .border-t { border-top: 1px solid #e5e7eb; }
                        .text-xl { font-size: 20px; }
                        .text-lg { font-size: 18px; }
                        .text-sm { font-size: 14px; }
                        .text-xs { font-size: 12px; }
                        .font-bold { font-weight: 700; }
                        .font-semibold { font-weight: 600; }
                        .font-medium { font-weight: 500; }
                        .italic { font-style: italic; }
                        .text-gray-900 { color: #111827; }
                        .text-gray-800 { color: #1f2937; }
                        .text-gray-700 { color: #374151; }
                        .text-gray-600 { color: #4b5563; }
                        .text-gray-500 { color: #6b7280; }
                        .text-gray-400 { color: #9ca3af; }
                        .text-green-800 { color: #166534; }
                        .text-blue-800 { color: #1e40af; }
                        .text-blue-500 { color: #3b82f6; }
                        .bg-blue-50 { background-color: #eff6ff; }
                        .bg-green-50 { background-color: #f0fdf4; }
                        .bg-green-100 { background-color: #dcfce7; }
                        .bg-gray-50 { background-color: #f9fafb; }
                        .bg-yellow-50 { background-color: #fefce8; }
                        .border-yellow-200 { border-color: #fef08a; }
                        .px-3 { padding-left: 12px; padding-right: 12px; }
                        .py-1 { padding-top: 4px; padding-bottom: 4px; }
                        h5 { font-size: 16px; font-weight: 500; }
                        svg { width: 20px; height: 20px; }
                        .w-4 { width: 16px; }
                        .h-4 { height: 16px; }
                        .print\\:hidden { display: none !important; }
                        @media print {
                            body { padding: 0; }
                            .print\\:hidden { display: none !important; }
                        }
                    </style>
                </head>
                <body>
                    ${printContent}
                </body>
                </html>
            `);
            
            printWindow.document.close();
            printWindow.focus();
            
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 250);
        }
    </script>
    @endpush
</x-app-layout>

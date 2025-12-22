<x-app-layout>
    <!-- Blue Header Section -->
    <div class="bg-blue-600 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-white">Resep Saya</h1>
                <a href="{{ route('dashboard') }}" class="text-white hover:text-blue-100 transition-colors duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
            <p class="mt-2 text-blue-100">Lihat dan kelola resep obat Anda</p>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-gray-700">
                    @if($prescriptions->count() > 0)
                        <div class="space-y-4">
                            @foreach($prescriptions as $prescription)
                                <div class="border dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Dr. {{ $prescription->doctor->user->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $prescription->doctor->specialization }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                {{ $prescription->prescription_date->format('d M Y') }}
                                            </p>
                                        </div>
                                        <div>
                                            @if($prescription->status === 'active')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Aktif
                                                </span>
                                            @elseif($prescription->status === 'completed')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                    Dibatalkan
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Diagnosis:</h4>
                                        <p class="text-gray-600 dark:text-gray-400">{{ $prescription->diagnosis }}</p>
                                    </div>

                                    <div class="mb-4">
                                        <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Obat yang Diresepkan:</h4>
                                        <div class="space-y-2">
                                            @foreach($prescription->items as $item)
                                                <div class="flex items-center justify-between bg-gray-50 dark:bg-slate-700 p-3 rounded">
                                                    <div class="flex-1">
                                                        <p class="font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</p>
                                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                                            {{ $item->dosage }} • {{ $item->quantity }} pcs • {{ $item->duration_days }} hari
                                                        </p>
                                                        @if($item->instructions)
                                                            <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">{{ $item->instructions }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @if($prescription->notes)
                                        <div class="mb-4">
                                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Catatan Dokter:</h4>
                                            <p class="text-gray-600 dark:text-gray-400">{{ $prescription->notes }}</p>
                                        </div>
                                    @endif

                                    <div class="flex justify-end">
                                        <a href="{{ route('prescriptions.show', $prescription) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition">
                                            Lihat Detail
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $prescriptions->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Belum ada resep</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Anda belum memiliki resep dari dokter.</p>
                            <div class="mt-6">
                                <a href="{{ route('appointments.index') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Buat Appointment
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

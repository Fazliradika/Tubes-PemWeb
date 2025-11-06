<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter Tabs -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex space-x-4 border-b border-gray-200">
                        <a href="{{ route('doctor.appointments.index', ['status' => 'all']) }}" 
                           class="pb-4 px-4 {{ $status === 'all' ? 'border-b-2 border-blue-500 text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}">
                            Semua
                        </a>
                        <a href="{{ route('doctor.appointments.index', ['status' => 'pending']) }}" 
                           class="pb-4 px-4 {{ $status === 'pending' ? 'border-b-2 border-blue-500 text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}">
                            Pending
                        </a>
                        <a href="{{ route('doctor.appointments.index', ['status' => 'confirmed']) }}" 
                           class="pb-4 px-4 {{ $status === 'confirmed' ? 'border-b-2 border-blue-500 text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}">
                            Confirmed
                        </a>
                        <a href="{{ route('doctor.appointments.index', ['status' => 'completed']) }}" 
                           class="pb-4 px-4 {{ $status === 'completed' ? 'border-b-2 border-blue-500 text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}">
                            Completed
                        </a>
                        <a href="{{ route('doctor.appointments.index', ['status' => 'cancelled']) }}" 
                           class="pb-4 px-4 {{ $status === 'cancelled' ? 'border-b-2 border-blue-500 text-blue-600 font-medium' : 'text-gray-600 hover:text-gray-800' }}">
                            Cancelled
                        </a>
                    </div>
                </div>
            </div>

            <!-- Appointments List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($appointments->count() > 0)
                        <div class="space-y-4">
                            @foreach($appointments as $appointment)
                                <div class="border rounded-lg p-6 hover:shadow-lg transition">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start space-x-4 flex-1">
                                            <div class="flex-shrink-0 h-16 w-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                                {{ substr($appointment->patient->name, 0, 1) }}
                                            </div>
                                            <div class="flex-1">
                                                <h3 class="text-lg font-semibold text-gray-900">{{ $appointment->patient->name }}</h3>
                                                <p class="text-sm text-gray-600">{{ $appointment->patient->email }}</p>
                                                <p class="text-sm text-gray-600">{{ $appointment->patient->phone }}</p>
                                                
                                                <div class="mt-3">
                                                    <p class="text-sm font-medium text-gray-700">Keluhan:</p>
                                                    <p class="text-sm text-gray-600">{{ $appointment->symptoms }}</p>
                                                </div>
                                                
                                                @if($appointment->notes)
                                                    <div class="mt-2">
                                                        <p class="text-sm font-medium text-gray-700">Catatan:</p>
                                                        <p class="text-sm text-gray-600">{{ $appointment->notes }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="ml-6 text-right">
                                            <p class="text-sm font-semibold text-gray-900">
                                                {{ $appointment->appointment_date->format('d M Y') }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                            </p>
                                            <p class="text-sm font-medium text-gray-900 mt-2">
                                                Rp {{ number_format($appointment->total_price, 0, ',', '.') }}
                                            </p>
                                            
                                            <div class="mt-3">
                                                @if($appointment->status === 'pending')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                @elseif($appointment->status === 'confirmed')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                        Confirmed
                                                    </span>
                                                @elseif($appointment->status === 'completed')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                        Completed
                                                    </span>
                                                @elseif($appointment->status === 'cancelled')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                        Cancelled
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 flex justify-end space-x-3">
                                        <a href="{{ route('doctor.appointments.show', $appointment) }}" 
                                           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                                            Lihat Detail
                                        </a>
                                        
                                        @if($appointment->status === 'pending')
                                            <form action="{{ route('doctor.appointments.confirm', $appointment) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                                                    Konfirmasi
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $appointments->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada appointment</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                @if($status !== 'all')
                                    Tidak ada appointment dengan status {{ $status }}.
                                @else
                                    Belum ada appointment yang dibuat.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

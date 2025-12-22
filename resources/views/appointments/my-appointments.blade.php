@extends('layouts.app')

@section('content')
<!-- Blue Header Section -->
<div class="bg-blue-600 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-white">My Appointments</h1>
            <a href="{{ route('dashboard') }}" class="text-white hover:text-blue-100 transition-colors duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
        <p class="mt-2 text-blue-100">Kelola dan lihat riwayat appointment Anda</p>
    </div>
</div>

<div class="min-h-screen bg-gray-50 dark:bg-slate-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @if($appointments->count() > 0)
            <div class="space-y-4">
                @foreach($appointments as $appointment)
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
                        <div class="md:flex">
                            <!-- Appointment Info -->
                            <div class="flex-1 p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                                            {{ $appointment->doctor->user->name }}
                                        </h3>
                                        <p class="text-blue-600 dark:text-blue-400">{{ $appointment->doctor->specialization }}</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        @if($appointment->status === 'confirmed') bg-green-100 text-green-800
                                        @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                                        <svg class="w-5 h-5 mr-2 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $appointment->appointment_date->format('d F Y') }}
                                    </div>
                                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                                        <svg class="w-5 h-5 mr-2 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                    </div>
                                </div>

                                @if($appointment->symptoms)
                                    <div class="mb-4">
                                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Keluhan:</p>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">{{ Str::limit($appointment->symptoms, 100) }}</p>
                                    </div>
                                @endif

                                <div class="flex items-center justify-between">
                                    <p class="text-lg font-bold text-green-600 dark:text-green-400">
                                        Rp {{ number_format($appointment->total_price, 0, ',', '.') }}
                                    </p>
                                    
                                    <div class="flex gap-2">
                                        <a href="{{ route('appointments.show', $appointment) }}" 
                                           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors duration-200">
                                            Detail
                                        </a>
                                        
                                        @if(in_array($appointment->status, ['confirmed', 'completed']))
                                            <a href="{{ route('chat.create-from-appointment', $appointment->id) }}" 
                                               class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg transition-colors duration-200 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-5 5v-5z"/>
                                                </svg>
                                                Chat Dokter
                                            </a>
                                        @endif
                                        
                                        @if(in_array($appointment->status, ['pending', 'confirmed']))
                                            <form method="POST" action="{{ route('appointments.cancel', $appointment) }}" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan appointment ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition-colors duration-200">
                                                    Cancel
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $appointments->links() }}
            </div>
        @else
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Belum ada appointment</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Mulai buat appointment dengan dokter pilihan Anda</p>
                <a href="{{ route('appointments.index') }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors duration-200">
                    Book Appointment
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

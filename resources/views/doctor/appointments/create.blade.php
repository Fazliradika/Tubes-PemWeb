<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Buat Appointment Baru') }}
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
                    <form method="POST" action="{{ route('doctor.appointments.store') }}" class="space-y-6">
                        @csrf

                        <!-- Patient Selection -->
                        <div>
                            <label for="patient_id" class="block text-sm font-medium text-gray-700">
                                Pilih Pasien <span class="text-red-500">*</span>
                            </label>
                            <select name="patient_id" id="patient_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">-- Pilih Pasien --</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" 
                                        {{ (old('patient_id', request('patient_id')) == $patient->id) ? 'selected' : '' }}>
                                        {{ $patient->name }} - {{ $patient->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Appointment Date -->
                        <div>
                            <label for="appointment_date" class="block text-sm font-medium text-gray-700">
                                Tanggal Appointment <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="appointment_date" id="appointment_date" 
                                value="{{ old('appointment_date') }}"
                                min="{{ date('Y-m-d') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('appointment_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Appointment Time -->
                        <div>
                            <label for="appointment_time" class="block text-sm font-medium text-gray-700">
                                Waktu Appointment <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="appointment_time" id="appointment_time" 
                                value="{{ old('appointment_time') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('appointment_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Symptoms -->
                        <div>
                            <label for="symptoms" class="block text-sm font-medium text-gray-700">
                                Keluhan / Gejala
                            </label>
                            <textarea name="symptoms" id="symptoms" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('symptoms') }}</textarea>
                            @error('symptoms')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                Catatan
                            </label>
                            <textarea name="notes" id="notes" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('doctor.dashboard') }}"
                                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Buat Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

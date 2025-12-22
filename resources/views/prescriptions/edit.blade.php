<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Resep Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="mb-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Patient Info -->
                    <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Informasi Pasien</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Nama Pasien</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $prescription->patient->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Tanggal Resep</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $prescription->prescription_date->format('d M Y') }}</p>
                            </div>
                            @if($prescription->appointment)
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Keluhan Awal</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $prescription->appointment->symptoms }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('doctor.prescriptions.update', $prescription) }}" method="POST" id="prescriptionForm">
                        @csrf
                        @method('PUT')

                        <!-- Diagnosis -->
                        <div class="mb-6">
                            <label for="diagnosis" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Diagnosis <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                name="diagnosis" 
                                id="diagnosis" 
                                rows="3" 
                                class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 @error('diagnosis') border-red-500 @enderror"
                                required>{{ old('diagnosis', $prescription->diagnosis) }}</textarea>
                            @error('diagnosis')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Status Resep <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status" 
                                    class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500">
                                <option value="active" {{ $prescription->status === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="completed" {{ $prescription->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $prescription->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>

                        <!-- Prescription Items -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Obat yang Diresepkan <span class="text-red-500">*</span>
                                </label>
                                <button type="button" onclick="addMedicineItem()" 
                                        class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Tambah Obat
                                </button>
                            </div>

                            <div id="medicineItems" class="space-y-4">
                                @foreach($prescription->items as $index => $item)
                                <div class="medicine-item bg-gray-50 dark:bg-slate-700 p-4 rounded-lg border dark:border-slate-600" data-index="{{ $index }}">
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Obat #{{ $index + 1 }}</span>
                                        <button type="button" onclick="removeMedicineItem(this)" 
                                                class="text-red-500 hover:text-red-700 {{ $prescription->items->count() <= 1 ? 'hidden' : '' }} remove-btn">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                        <div>
                                            <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Nama Obat</label>
                                            <select name="items[{{ $index }}][product_id]" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-600 dark:text-white text-sm" required>
                                                <option value="">Pilih Obat</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                                        {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Dosis</label>
                                            <input type="text" name="items[{{ $index }}][dosage]" 
                                                   value="{{ $item->dosage }}"
                                                   class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-600 dark:text-white text-sm" 
                                                   placeholder="Contoh: 3x1 sehari" required>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                        <div>
                                            <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Jumlah</label>
                                            <input type="number" name="items[{{ $index }}][quantity]" min="1" 
                                                   value="{{ $item->quantity }}"
                                                   class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-600 dark:text-white text-sm" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Durasi (hari)</label>
                                            <input type="number" name="items[{{ $index }}][duration_days]" min="1" 
                                                   value="{{ $item->duration_days }}"
                                                   class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-600 dark:text-white text-sm" required>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Instruksi Khusus (opsional)</label>
                                        <input type="text" name="items[{{ $index }}][instructions]" 
                                               value="{{ $item->instructions }}"
                                               class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-600 dark:text-white text-sm" 
                                               placeholder="Contoh: Diminum setelah makan">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Catatan Tambahan (opsional)
                            </label>
                            <textarea 
                                name="notes" 
                                id="notes" 
                                rows="2" 
                                class="w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Catatan untuk pasien...">{{ old('notes', $prescription->notes) }}</textarea>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-4 border-t dark:border-slate-700">
                            <a href="{{ route('doctor.prescriptions.show', $prescription) }}" 
                               class="px-4 py-2 bg-gray-200 dark:bg-slate-600 hover:bg-gray-300 dark:hover:bg-slate-500 text-gray-700 dark:text-gray-200 rounded-lg transition">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                                Update Resep
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        let itemCount = {{ $prescription->items->count() }};
        const products = @json($products);

        function addMedicineItem() {
            const container = document.getElementById('medicineItems');
            const index = itemCount;
            
            const template = `
                <div class="medicine-item bg-gray-50 dark:bg-slate-700 p-4 rounded-lg border dark:border-slate-600" data-index="${index}">
                    <div class="flex justify-between items-start mb-3">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Obat #${index + 1}</span>
                        <button type="button" onclick="removeMedicineItem(this)" 
                                class="text-red-500 hover:text-red-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                        <div>
                            <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Nama Obat</label>
                            <select name="items[${index}][product_id]" class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-600 dark:text-white text-sm" required>
                                <option value="">Pilih Obat</option>
                                ${products.map(p => `<option value="${p.id}">${p.name} - Rp ${new Intl.NumberFormat('id-ID').format(p.price)}</option>`).join('')}
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Dosis</label>
                            <input type="text" name="items[${index}][dosage]" 
                                   class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-600 dark:text-white text-sm" 
                                   placeholder="Contoh: 3x1 sehari" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                        <div>
                            <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Jumlah</label>
                            <input type="number" name="items[${index}][quantity]" min="1" value="1"
                                   class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-600 dark:text-white text-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Durasi (hari)</label>
                            <input type="number" name="items[${index}][duration_days]" min="1" value="7"
                                   class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-600 dark:text-white text-sm" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Instruksi Khusus (opsional)</label>
                        <input type="text" name="items[${index}][instructions]" 
                               class="w-full rounded-md border-gray-300 dark:border-slate-600 dark:bg-slate-600 dark:text-white text-sm" 
                               placeholder="Contoh: Diminum setelah makan">
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', template);
            itemCount++;
            updateRemoveButtons();
        }

        function removeMedicineItem(button) {
            const item = button.closest('.medicine-item');
            item.remove();
            updateRemoveButtons();
            updateItemNumbers();
        }

        function updateRemoveButtons() {
            const items = document.querySelectorAll('.medicine-item');
            items.forEach((item) => {
                const removeBtn = item.querySelector('.remove-btn') || item.querySelector('button[onclick*="removeMedicineItem"]');
                if (removeBtn) {
                    if (items.length > 1) {
                        removeBtn.classList.remove('hidden');
                    } else {
                        removeBtn.classList.add('hidden');
                    }
                }
            });
        }

        function updateItemNumbers() {
            const items = document.querySelectorAll('.medicine-item');
            items.forEach((item, index) => {
                const label = item.querySelector('.text-sm.font-medium');
                if (label) {
                    label.textContent = `Obat #${index + 1}`;
                }
            });
        }
    </script>
    @endpush
</x-app-layout>

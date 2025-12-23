<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.faqs.index') }}" class="p-2 bg-white/10 hover:bg-white/20 rounded-xl text-white transition-all backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    {{ __('Tambah FAQ Baru') }}
                </h2>
                <p class="text-blue-100 text-sm mt-1">Tambahkan pertanyaan yang sering diajukan.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl sm:rounded-2xl border border-blue-50 dark:border-slate-700">
                <form action="{{ route('admin.faqs.store') }}" method="POST" class="p-8">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label for="question" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                Pertanyaan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="question" id="question" value="{{ old('question') }}" required
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-all"
                                placeholder="Contoh: Bagaimana cara membuat janji temu dengan dokter?">
                            @error('question') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="answer" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                Jawaban <span class="text-red-500">*</span>
                            </label>
                            <textarea name="answer" id="answer" rows="6" required
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-all"
                                placeholder="Tulis jawaban lengkap untuk pertanyaan di atas...">{{ old('answer') }}</textarea>
                            @error('answer') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="category" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select name="category" id="category" required
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>Umum</option>
                                    <option value="appointment" {{ old('category') == 'appointment' ? 'selected' : '' }}>Janji Temu</option>
                                    <option value="payment" {{ old('category') == 'payment' ? 'selected' : '' }}>Pembayaran</option>
                                    <option value="technical" {{ old('category') == 'technical' ? 'selected' : '' }}>Teknis</option>
                                    <option value="account" {{ old('category') == 'account' ? 'selected' : '' }}>Akun</option>
                                    <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('category') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="order" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                    Urutan
                                </label>
                                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" min="0"
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    placeholder="0">
                                <p class="mt-1 text-xs text-slate-500">Urutan tampil (angka kecil lebih dulu)</p>
                                @error('order') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">
                                    Status
                                </label>
                                <div class="flex items-center mt-3">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-slate-600 peer-checked:bg-blue-600"></div>
                                        <span class="ml-3 text-sm font-medium text-slate-700 dark:text-slate-300">Aktifkan FAQ</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-3">
                        <a href="{{ route('admin.faqs.index') }}" 
                           class="px-6 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 font-semibold hover:bg-slate-50 dark:hover:bg-slate-900 transition-all">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-8 py-2.5 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition-all">
                            Simpan FAQ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

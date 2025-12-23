<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.products.index') }}" class="p-2 bg-white/10 hover:bg-white/20 rounded-xl text-white transition-all backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    {{ __('Tambah Produk Baru') }}
                </h2>
                <p class="text-blue-100 text-sm mt-1">Masukkan detail produk kesehatan untuk dipublikasikan.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl sm:rounded-2xl border border-blue-50 dark:border-slate-700">
                <form action="{{ route('admin.products.store') }}" method="POST" class="p-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Basic Info --}}
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Produk</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    placeholder="Contoh: Vitamin C 1000mg">
                                @error('name') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Kategori</label>
                                <select name="category_id" id="category_id" required
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="price" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Harga (Rp)</label>
                                    <input type="number" name="price" id="price" value="{{ old('price') }}" required min="0"
                                        class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-all"
                                        placeholder="0">
                                    @error('price') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="stock" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Stok</label>
                                    <input type="number" name="stock" id="stock" value="{{ old('stock') }}" required min="0"
                                        class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-all"
                                        placeholder="0">
                                    @error('stock') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Media & Description --}}
                        <div class="space-y-6">
                            <div>
                                <label for="image" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">URL Gambar Produk</label>
                                <input type="url" name="image" id="image" value="{{ old('image') }}"
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    placeholder="https://example.com/image.jpg">
                                <p class="mt-1 text-xs text-slate-500">Kosongkan untuk menggunakan gambar default.</p>
                                @error('image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Deskripsi Produk</label>
                                <textarea name="description" id="description" rows="5" required
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    placeholder="Jelaskan detail, kegunaan, dan aturan pakai produk...">{{ old('description') }}</textarea>
                                @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex items-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:width-5 after:transition-all dark:border-slate-600 peer-checked:bg-blue-600"></div>
                                    <span class="ml-3 text-sm font-bold text-slate-700 dark:text-slate-300">Aktifkan Produk</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 pt-6 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-3">
                        <a href="{{ route('admin.products.index') }}" 
                           class="px-6 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 font-semibold hover:bg-slate-50 dark:hover:bg-slate-900 transition-all">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-8 py-2.5 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition-all">
                            Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

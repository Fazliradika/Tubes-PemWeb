<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.articles.index') }}" class="p-2 bg-white/20 hover:bg-white/30 rounded-lg text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('Edit Artikel: ') }} <span class="font-normal opacity-80">{{ $article->title }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl sm:rounded-2xl border border-blue-100 dark:border-blue-900/50">
                <form action="{{ route('admin.articles.update', $article->slug) }}" method="POST" class="p-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Left Column: Title & Basic Info -->
                        <div class="space-y-6">
                            <div>
                                <label for="title" class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2 uppercase tracking-wide">Judul Artikel</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required
                                       class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm"
                                       placeholder="Masukkan judul artikel yang menarik...">
                                @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="category" class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2 uppercase tracking-wide">Kategori</label>
                                    <select name="category" id="category" required
                                            class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                                        <option value="Hidup Sehat" {{ old('category', $article->category) == 'Hidup Sehat' ? 'selected' : '' }}>Hidup Sehat</option>
                                        <option value="Nutrisi" {{ old('category', $article->category) == 'Nutrisi' ? 'selected' : '' }}>Nutrisi</option>
                                        <option value="Kesehatan Mental" {{ old('category', $article->category) == 'Kesehatan Mental' ? 'selected' : '' }}>Kesehatan Mental</option>
                                        <option value="Olahraga" {{ old('category', $article->category) == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                                        <option value="Kecantikan" {{ old('category', $article->category) == 'Kecantikan' ? 'selected' : '' }}>Kecantikan</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="category_color" class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2 uppercase tracking-wide">Warna Tema</label>
                                    <select name="category_color" id="category_color" required
                                            class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
                                        <option value="green" {{ old('category_color', $article->category_color) == 'green' ? 'selected' : '' }}>Hijau (Hidup Sehat)</option>
                                        <option value="yellow" {{ old('category_color', $article->category_color) == 'yellow' ? 'selected' : '' }}>Kuning (Nutrisi)</option>
                                        <option value="purple" {{ old('category_color', $article->category_color) == 'purple' ? 'selected' : '' }}>Ungu (Kesehatan Mental)</option>
                                        <option value="blue" {{ old('category_color', $article->category_color) == 'blue' ? 'selected' : '' }}>Biru (Olahraga)</option>
                                        <option value="pink" {{ old('category_color', $article->category_color) == 'pink' ? 'selected' : '' }}>Pink (Kecantikan)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="author" class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2 uppercase tracking-wide">Penulis (Gelar)</label>
                                <input type="text" name="author" id="author" value="{{ old('author', $article->author) }}" required
                                       class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm"
                                       placeholder="Contoh: Dr. Andi Spesialis...">
                            </div>

                            <div>
                                <label for="read_time" class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2 uppercase tracking-wide">Estimasi Waktu Baca</label>
                                <input type="text" name="read_time" id="read_time" value="{{ old('read_time', $article->read_time) }}" required
                                       class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm"
                                       placeholder="Contoh: 5 min read">
                            </div>
                        </div>

                        <!-- Right Column: Visuals & Excerpt -->
                        <div class="space-y-6">
                            <div>
                                <label for="image" class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2 uppercase tracking-wide">URL Gambar Utama</label>
                                <input type="url" name="image" id="image" value="{{ old('image', $article->image) }}" required
                                       class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm"
                                       placeholder="https://images.unsplash.com/...">
                                @if($article->image)
                                    <div class="mt-3 relative w-full h-32 rounded-xl overflow-hidden border border-gray-200 shadow-inner">
                                        <img src="{{ $article->image }}" class="w-full h-full object-cover" id="image_preview">
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label for="excerpt" class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2 uppercase tracking-wide">Ringkasan (Excerpt)</label>
                                <textarea name="excerpt" id="excerpt" rows="3" required
                                          class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm"
                                          placeholder="Tuliskan ringkasan singkat artikel ini...">{{ old('excerpt', $article->excerpt) }}</textarea>
                            </div>

                            <div>
                                <label for="quote" class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2 uppercase tracking-wide">Kutipan Utama (Optional)</label>
                                <input type="text" name="quote" id="quote" value="{{ old('quote', $article->quote) }}"
                                       class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm font-italic"
                                       placeholder="Kutipan inspiratif...">
                            </div>
                        </div>
                    </div>

                    <!-- Full Width: Content -->
                    <div class="mb-8">
                        <label for="content" class="block text-sm font-bold text-slate-700 dark:text-slate-200 mb-2 uppercase tracking-wide">Isi Artikel (HTML Support)</label>
                        <textarea name="content" id="content" rows="15" required
                                  class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:border-blue-500 focus:ring-blue-500 transition shadow-sm font-mono text-sm">{{ old('content', $article->content) }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-4 border-t border-gray-100 dark:border-slate-700 pt-8">
                        <a href="{{ route('admin.articles.index') }}" class="px-6 py-3 text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200 font-bold transition">Batal</a>
                        <button type="submit" 
                                class="px-10 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition duration-150 ease-in-out shadow-lg shadow-blue-500/30">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

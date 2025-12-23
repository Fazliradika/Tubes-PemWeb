<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    {{ __('Kelola Artikel Kesehatan') }}
                </h2>
                <p class="text-blue-100 text-sm mt-1">Kelola publikasi artikel kesehatan untuk pasien.</p>
            </div>
            <div>
                <a href="{{ route('admin.articles.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-white text-blue-600 hover:bg-blue-50 font-bold rounded-xl transition duration-150 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 border border-transparent">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tulis Artikel Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl sm:rounded-2xl border border-blue-100 dark:border-blue-900/50">
                <div class="p-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 rounded-r-xl flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(isset($error))
                        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border-l-4 border-red-500 rounded-r-xl flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="text-red-800 dark:text-red-200 font-medium">{{ $error }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100 dark:border-slate-700">
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Artikel</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Kategori</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Penulis</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Tanggal</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-slate-700">
                                @forelse ($articles as $article)
                                    <tr class="hover:bg-blue-50/50 dark:hover:bg-slate-700/50 transition duration-150">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-4">
                                                <div class="shrink-0 w-16 h-12 rounded-lg overflow-hidden border border-gray-100 dark:border-slate-600 shadow-sm">
                                                    @if($article->image)
                                                        <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full bg-blue-100 dark:bg-slate-600 flex items-center justify-center text-blue-500">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-slate-800 dark:text-slate-100 leading-tight mb-1">{{ Str::limit($article->title, 50) }}</h4>
                                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $article->read_time }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-sm font-medium">
                                            <span class="px-3 py-1 bg-{{ $article->category_color }}-100 text-{{ $article->category_color }}-700 dark:bg-{{ $article->category_color }}-900/40 dark:text-{{ $article->category_color }}-400 rounded-full text-xs">
                                                {{ $article->category }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-sm text-slate-600 dark:text-slate-400 font-medium italic">
                                            {{ $article->author }}
                                        </td>
                                        <td class="py-4 px-4 text-sm text-slate-500 dark:text-slate-400">
                                            {{ $article->created_at->format('d M Y') }}
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('articles.show', $article->slug) }}" target="_blank" 
                                                   class="p-2 text-blue-600 hover:bg-blue-100 dark:text-blue-400 dark:hover:bg-blue-900/30 rounded-lg transition"
                                                   title="Pratinjau">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.articles.edit', $article->slug) }}" 
                                                   class="p-2 text-yellow-600 hover:bg-yellow-100 dark:text-yellow-400 dark:hover:bg-yellow-900/30 rounded-lg transition"
                                                   title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.articles.destroy', $article->slug) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="p-2 text-red-600 hover:bg-red-100 dark:text-red-400 dark:hover:bg-red-900/30 rounded-lg transition"
                                                            title="Hapus">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-16 h-16 text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l5 5v11a2 2 0 01-2 2z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v6h6" />
                                                </svg>
                                                <p class="text-slate-500 dark:text-slate-400 text-lg font-medium">Belum ada artikel yang diterbitkan.</p>
                                                <a href="{{ route('admin.articles.create') }}" class="mt-4 text-blue-600 dark:text-blue-400 font-bold hover:underline">Tulis artikel pertama Anda sekarang!</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

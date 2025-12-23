<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    {{ __('Kelola FAQ') }}
                </h2>
                <p class="text-blue-100 text-sm mt-1">Kelola pertanyaan yang sering diajukan oleh pengguna.</p>
            </div>
            <div>
                <a href="{{ route('admin.faqs.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-white text-blue-600 hover:bg-blue-50 font-bold rounded-xl transition duration-150 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 border border-transparent">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah FAQ
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total FAQ</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['total'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Aktif</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['active'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Non-Aktif</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['inactive'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-xl">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Kategori</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ count($stats['categories']) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl sm:rounded-2xl border border-slate-200 dark:border-slate-700 mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.faqs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Cari</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pertanyaan..."
                                   class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Kategori</label>
                            <select name="category" class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Kategori</option>
                                <option value="general" {{ request('category') == 'general' ? 'selected' : '' }}>Umum</option>
                                <option value="appointment" {{ request('category') == 'appointment' ? 'selected' : '' }}>Janji Temu</option>
                                <option value="payment" {{ request('category') == 'payment' ? 'selected' : '' }}>Pembayaran</option>
                                <option value="technical" {{ request('category') == 'technical' ? 'selected' : '' }}>Teknis</option>
                                <option value="account" {{ request('category') == 'account' ? 'selected' : '' }}>Akun</option>
                                <option value="other" {{ request('category') == 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status</label>
                            <select name="status" class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>
                        <div class="flex items-end gap-2">
                            <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-semibold">
                                <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('admin.faqs.index') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition font-semibold">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 rounded-r-xl flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- FAQ Table -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl sm:rounded-2xl border border-slate-200 dark:border-slate-700">
                <div class="p-8">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 dark:border-slate-700">
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider w-12">#</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Pertanyaan</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Kategori</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Status</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Urutan</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                                @forelse ($faqs as $index => $faq)
                                    <tr class="hover:bg-blue-50/50 dark:hover:bg-slate-700/50 transition duration-150">
                                        <td class="py-4 px-4 text-slate-500 dark:text-slate-400">
                                            {{ $faqs->firstItem() + $index }}
                                        </td>
                                        <td class="py-4 px-4">
                                            <div>
                                                <h4 class="font-semibold text-slate-800 dark:text-slate-100 leading-tight mb-1">
                                                    {{ Str::limit($faq->question, 70) }}
                                                </h4>
                                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                                    {{ Str::limit(strip_tags($faq->answer), 80) }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="px-3 py-1 bg-{{ $faq->category_color }}-100 text-{{ $faq->category_color }}-700 dark:bg-{{ $faq->category_color }}-900/40 dark:text-{{ $faq->category_color }}-400 rounded-full text-xs font-medium">
                                                {{ $faq->category_label }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <form action="{{ route('admin.faqs.toggle-status', $faq) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-3 py-1 rounded-full text-xs font-medium transition {{ $faq->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400 hover:bg-green-200' : 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400 hover:bg-red-200' }}">
                                                    {{ $faq->is_active ? 'Aktif' : 'Non-Aktif' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="py-4 px-4 text-slate-600 dark:text-slate-400 font-medium">
                                            {{ $faq->order }}
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.faqs.edit', $faq) }}" 
                                                   class="p-2 text-blue-600 hover:bg-blue-100 dark:text-blue-400 dark:hover:bg-blue-900/30 rounded-lg transition"
                                                   title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
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
                                        <td colspan="6" class="py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-16 h-16 text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="text-slate-500 dark:text-slate-400 text-lg font-medium">Belum ada FAQ yang tersedia.</p>
                                                <a href="{{ route('admin.faqs.create') }}" class="mt-4 text-blue-600 dark:text-blue-400 font-bold hover:underline">Tambahkan FAQ pertama!</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8">
                        {{ $faqs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

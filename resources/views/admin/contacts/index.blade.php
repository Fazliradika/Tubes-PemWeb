<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight">
                    {{ __('Pesan Masuk') }}
                </h2>
                <p class="text-gray-600 dark:text-blue-100 text-sm mt-1">Kelola pesan dari formulir hubungi kami.</p>
            </div>
            <div class="flex items-center gap-3">
                @if($stats['unread'] > 0)
                <span class="inline-flex items-center px-4 py-2 bg-red-500 text-white font-bold rounded-xl animate-pulse">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    {{ $stats['unread'] }} Pesan Baru
                </span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-8">
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">{{ $stats['total'] }}</p>
                        </div>
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Belum Dibaca</p>
                            <p class="text-2xl font-bold text-red-600 dark:text-red-400 mt-1">{{ $stats['unread'] }}</p>
                        </div>
                        <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sudah Dibaca</p>
                            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 mt-1">{{ $stats['read'] }}</p>
                        </div>
                        <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sudah Dibalas</p>
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-1">{{ $stats['replied'] }}</p>
                        </div>
                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Hari Ini</p>
                            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400 mt-1">{{ $stats['today'] }}</p>
                        </div>
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 shadow-sm border border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Minggu Ini</p>
                            <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mt-1">{{ $stats['this_week'] }}</p>
                        </div>
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl sm:rounded-2xl border border-slate-200 dark:border-slate-700 mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('admin.contacts.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Cari</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama, email, atau pesan..."
                                   class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status</label>
                            <select name="status" class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                                <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Sudah Dibalas</option>
                                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Diarsipkan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Subjek</label>
                            <select name="subject" class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Subjek</option>
                                <option value="general" {{ request('subject') == 'general' ? 'selected' : '' }}>Pertanyaan Umum</option>
                                <option value="appointment" {{ request('subject') == 'appointment' ? 'selected' : '' }}>Janji Temu</option>
                                <option value="payment" {{ request('subject') == 'payment' ? 'selected' : '' }}>Pembayaran</option>
                                <option value="technical" {{ request('subject') == 'technical' ? 'selected' : '' }}>Masalah Teknis</option>
                                <option value="complaint" {{ request('subject') == 'complaint' ? 'selected' : '' }}>Keluhan</option>
                                <option value="other" {{ request('subject') == 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="flex items-end gap-2">
                            <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-semibold">
                                <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('admin.contacts.index') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition font-semibold">
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

            <!-- Messages Table -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl sm:rounded-2xl border border-slate-200 dark:border-slate-700">
                <div class="p-8">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 dark:border-slate-700">
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Pengirim</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Subjek</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Pesan</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Status</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Tanggal</th>
                                    <th class="py-4 px-4 font-bold text-slate-700 dark:text-slate-200 uppercase text-xs tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                                @forelse ($messages as $message)
                                    <tr class="hover:bg-blue-50/50 dark:hover:bg-slate-700/50 transition duration-150 {{ $message->status === 'unread' ? 'bg-blue-50/30 dark:bg-blue-900/10' : '' }}">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold">
                                                    {{ strtoupper(substr($message->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-slate-800 dark:text-slate-100 {{ $message->status === 'unread' ? 'font-bold' : '' }}">
                                                        {{ $message->name }}
                                                    </h4>
                                                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ $message->email }}</p>
                                                    @if($message->phone)
                                                        <p class="text-xs text-slate-400 dark:text-slate-500">{{ $message->phone }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="px-3 py-1 bg-{{ $message->subject_color }}-100 text-{{ $message->subject_color }}-700 dark:bg-{{ $message->subject_color }}-900/40 dark:text-{{ $message->subject_color }}-400 rounded-full text-xs font-medium">
                                                {{ $message->subject_label }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <p class="text-sm text-slate-600 dark:text-slate-400 {{ $message->status === 'unread' ? 'font-medium text-slate-800 dark:text-slate-200' : '' }}">
                                                {{ Str::limit($message->message, 60) }}
                                            </p>
                                        </td>
                                        <td class="py-4 px-4">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $message->status_badge_class }}">
                                                {{ $message->status_label }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 text-sm text-slate-500 dark:text-slate-400">
                                            <div>{{ $message->created_at->format('d M Y') }}</div>
                                            <div class="text-xs">{{ $message->created_at->format('H:i') }}</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.contacts.show', $message) }}" 
                                                   class="p-2 text-blue-600 hover:bg-blue-100 dark:text-blue-400 dark:hover:bg-blue-900/30 rounded-lg transition"
                                                   title="Lihat Detail">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.contacts.destroy', $message) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
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
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                <p class="text-slate-500 dark:text-slate-400 text-lg font-medium">Belum ada pesan masuk.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

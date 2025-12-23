<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.contacts.index') }}" class="p-2 bg-white/10 hover:bg-white/20 rounded-xl text-white transition-all backdrop-blur-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-white leading-tight">
                    {{ __('Detail Pesan') }}
                </h2>
                <p class="text-blue-100 text-sm mt-1">Pesan dari {{ $contact->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 rounded-r-xl flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-xl sm:rounded-2xl border border-slate-200 dark:border-slate-700">
                <div class="p-8">
                    <!-- Sender Info -->
                    <div class="flex items-start gap-4 pb-6 border-b border-slate-100 dark:border-slate-700">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $contact->name }}</h3>
                            <div class="flex flex-wrap items-center gap-4 mt-2 text-sm text-slate-600 dark:text-slate-400">
                                <a href="mailto:{{ $contact->email }}" class="flex items-center gap-1 hover:text-blue-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $contact->email }}
                                </a>
                                @if($contact->phone)
                                    <a href="tel:{{ $contact->phone }}" class="flex items-center gap-1 hover:text-blue-600 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $contact->phone }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $contact->status_badge_class }}">
                                {{ $contact->status_label }}
                            </span>
                            <div class="text-sm text-slate-500 dark:text-slate-400 mt-2">
                                {{ $contact->created_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="py-4 border-b border-slate-100 dark:border-slate-700">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Subjek:</span>
                            <span class="px-3 py-1 bg-{{ $contact->subject_color }}-100 text-{{ $contact->subject_color }}-700 dark:bg-{{ $contact->subject_color }}-900/40 dark:text-{{ $contact->subject_color }}-400 rounded-full text-sm font-medium">
                                {{ $contact->subject_label }}
                            </span>
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="py-6 border-b border-slate-100 dark:border-slate-700">
                        <h4 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-3">Isi Pesan</h4>
                        <div class="bg-slate-50 dark:bg-slate-900 rounded-xl p-6">
                            <p class="text-slate-700 dark:text-slate-300 whitespace-pre-wrap leading-relaxed">{{ $contact->message }}</p>
                        </div>
                    </div>

                    <!-- Admin Notes & Status Update -->
                    <div class="py-6">
                        <h4 class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-3">Update Status & Catatan Admin</h4>
                        <form action="{{ route('admin.contacts.update', $contact) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status</label>
                                <select name="status" id="status" class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                    <option value="unread" {{ $contact->status == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                                    <option value="read" {{ $contact->status == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                                    <option value="replied" {{ $contact->status == 'replied' ? 'selected' : '' }}>Sudah Dibalas</option>
                                    <option value="archived" {{ $contact->status == 'archived' ? 'selected' : '' }}>Diarsipkan</option>
                                </select>
                            </div>

                            <div>
                                <label for="admin_notes" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Catatan Admin</label>
                                <textarea name="admin_notes" id="admin_notes" rows="3" 
                                    class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Tambahkan catatan internal...">{{ old('admin_notes', $contact->admin_notes) }}</textarea>
                            </div>

                            <div class="flex justify-end gap-3">
                                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject_label }}" 
                                   class="px-6 py-2.5 rounded-xl border border-blue-600 text-blue-600 dark:text-blue-400 font-semibold hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all">
                                    <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Balas via Email
                                </a>
                                <button type="submit" class="px-8 py-2.5 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition-all">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    @if($contact->replied_at)
                    <div class="pt-4 border-t border-slate-100 dark:border-slate-700">
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Dibalas pada {{ $contact->replied_at->format('d M Y, H:i') }}
                            @if($contact->repliedByAdmin)
                                oleh {{ $contact->repliedByAdmin->name }}
                            @endif
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pesan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-gray-700">
                    @if($conversations->count() > 0)
                        <div class="grid grid-cols-1 gap-4">
                            @foreach($conversations as $conversation)
                                <a href="{{ auth()->user()->isDoctor() ? route('doctor.chat.show', $conversation) : route('chat.show', $conversation) }}" 
                                   class="block border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-lg hover:border-blue-500 dark:hover:border-blue-400 transition">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start space-x-4 flex-1">
                                            <div class="flex-shrink-0">
                                                <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-500 to-green-500 flex items-center justify-center text-white font-semibold text-lg">
                                                    @if(auth()->user()->isPatient())
                                                        {{ substr($conversation->doctor->user->name, 0, 1) }}
                                                    @else
                                                        {{ substr($conversation->patient->name, 0, 1) }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between">
                                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        @if(auth()->user()->isPatient())
                                                            Dr. {{ $conversation->doctor->user->name }}
                                                        @else
                                                            {{ $conversation->patient->name }}
                                                        @endif
                                                    </p>
                                                    @if($conversation->last_message_at)
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                                            {{ $conversation->last_message_at->diffForHumans() }}
                                                        </p>
                                                    @endif
                                                </div>
                                                @if(auth()->user()->isPatient())
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $conversation->doctor->specialization }}</p>
                                                @endif
                                                @if($conversation->latestMessage)
                                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 truncate">
                                                        {{ $conversation->latestMessage->message ?? 'Media' }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                                {{ $conversation->status }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $conversations->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Belum ada percakapan</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                @if(auth()->user()->isPatient())
                                    Mulai percakapan dengan dokter setelah appointment Anda dikonfirmasi.
                                @else
                                    Percakapan dengan pasien akan muncul di sini.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

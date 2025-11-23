<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('articles.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Artikel Kesehatan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Article Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="relative">
                    <img src="{{ $article['image'] }}" 
                         alt="{{ $article['title'] }}" 
                         class="w-full h-96 object-cover">
                    <div class="absolute top-6 left-6">
                        <span class="bg-{{ $article['category_color'] }}-500 text-white text-sm font-semibold px-4 py-2 rounded-full">
                            {{ $article['category'] }}
                        </span>
                    </div>
                </div>
                
                <div class="p-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $article['title'] }}</h1>
                    
                    <div class="flex items-center justify-between text-sm text-gray-600 mb-6 pb-6 border-b">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ $article['author'] }}</span>
                            </div>
                            <span>•</span>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $article['read_time'] }}</span>
                            </div>
                            <span>•</span>
                            <span>{{ $article['published_at'] }}</span>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <button class="p-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-full transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                            <button class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-full transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none">
                        {!! $article['content'] !!}
                    </div>

                    <!-- Tags -->
                    <div class="mt-8 pt-6 border-t">
                        <div class="flex flex-wrap gap-2">
                            <span class="text-sm font-medium text-gray-600 mr-2">Tags:</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full">#kesehatan</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full">#{{ strtolower(str_replace(' ', '', $article['category'])) }}</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-sm rounded-full">#tipskesehatan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Artikel Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                    <a href="{{ route('articles.show', $related['slug']) }}" class="block group">
                        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-all duration-300">
                            <img src="{{ $related['image'] }}" 
                                 alt="{{ $related['title'] }}" 
                                 class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="p-4">
                                <span class="inline-block bg-{{ $related['category_color'] }}-100 text-{{ $related['category_color'] }}-800 text-xs font-semibold px-2 py-1 rounded mb-2">
                                    {{ $related['category'] }}
                                </span>
                                <h3 class="font-bold text-gray-800 text-sm mb-2 group-hover:text-green-600 transition-colors line-clamp-2">
                                    {{ $related['title'] }}
                                </h3>
                                <p class="text-xs text-gray-500">{{ $related['read_time'] }}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    @push('styles')
    <style>
        .prose h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #1f2937;
        }
        .prose h3 {
            font-size: 1.375rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            color: #374151;
        }
        .prose p {
            margin-bottom: 1.25rem;
            line-height: 1.75;
            color: #4b5563;
        }
        .prose ul {
            margin-top: 1rem;
            margin-bottom: 1.25rem;
            padding-left: 1.5rem;
            list-style-type: disc;
        }
        .prose li {
            margin-bottom: 0.5rem;
            color: #4b5563;
        }
        .prose strong {
            font-weight: 600;
            color: #1f2937;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @endpush
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artikel Kesehatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-500 to-teal-600 overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-8 text-white">
                    <h1 class="text-3xl font-bold mb-2">Artikel Kesehatan Terkini</h1>
                    <p class="text-green-100">Temukan informasi kesehatan terpercaya untuk hidup lebih sehat</p>
                </div>
            </div>

            <!-- Article Categories -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-2">
                    <button class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-green-600 rounded-full hover:bg-green-700 transition">
                        Semua
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition">
                        Nutrisi
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition">
                        Diabetes
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition">
                        Jantung
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition">
                        Kesehatan Mental
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition">
                        Olahraga
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition">
                        Kecantikan
                    </button>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($articles as $article)
                <a href="{{ route('articles.show', $article['slug']) }}" class="block">
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative">
                            <img src="{{ $article['image'] }}" 
                                 alt="{{ $article['title'] }}" 
                                 class="w-full h-48 object-cover">
                            <span class="absolute top-3 left-3 bg-{{ $article['category_color'] }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $article['category'] }}
                            </span>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-800 mb-2 hover:text-green-600 transition-colors">
                                {{ $article['title'] }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                {{ $article['excerpt'] }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $article['read_time'] }}</span>
                                <span>• {{ $article['published_at'] }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

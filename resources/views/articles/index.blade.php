<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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
                    <button onclick="filterArticles('all')" class="category-btn px-4 py-2 text-sm font-medium text-white bg-green-600 border border-green-600 rounded-full hover:bg-green-700 transition active" data-category="all">
                        Semua
                    </button>
                    <button onclick="filterArticles('Nutrisi')" class="category-btn px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-full hover:bg-gray-50 dark:hover:bg-slate-600 transition" data-category="Nutrisi">
                        Nutrisi
                    </button>
                    <button onclick="filterArticles('Diabetes')" class="category-btn px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-full hover:bg-gray-50 dark:hover:bg-slate-600 transition" data-category="Diabetes">
                        Diabetes
                    </button>
                    <button onclick="filterArticles('Olahraga')" class="category-btn px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-full hover:bg-gray-50 dark:hover:bg-slate-600 transition" data-category="Olahraga">
                        Olahraga
                    </button>
                    <button onclick="filterArticles('Kesehatan Mental')" class="category-btn px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-full hover:bg-gray-50 dark:hover:bg-slate-600 transition" data-category="Kesehatan Mental">
                        Kesehatan Mental
                    </button>
                    <button onclick="filterArticles('Hidup Sehat')" class="category-btn px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-full hover:bg-gray-50 dark:hover:bg-slate-600 transition" data-category="Hidup Sehat">
                        Hidup Sehat
                    </button>
                    <button onclick="filterArticles('Kecantikan')" class="category-btn px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-full hover:bg-gray-50 dark:hover:bg-slate-600 transition" data-category="Kecantikan">
                        Kecantikan
                    </button>
                </div>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($articles as $article)
                <a href="{{ route('articles.show', $article['slug']) }}" class="block article-card" data-category="{{ $article['category'] }}">
                    <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative">
                            <img src="{{ $article['image'] }}" 
                                 alt="{{ $article['title'] }}" 
                                 class="w-full h-48 object-cover">
                            <span class="absolute top-3 left-3 bg-{{ $article['category_color'] }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $article['category'] }}
                            </span>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2 hover:text-green-600 dark:hover:text-green-400 transition-colors">
                                {{ $article['title'] }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                                {{ $article['excerpt'] }}
                            </p>
                            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
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

    <script>
        function filterArticles(category) {
            // Get all article cards
            const articles = document.querySelectorAll('.article-card');
            const buttons = document.querySelectorAll('.category-btn');
            
            // Update button styles
            buttons.forEach(btn => {
                if (btn.dataset.category === category) {
                    btn.classList.remove('text-gray-700', 'bg-white', 'border-gray-300');
                    btn.classList.add('text-white', 'bg-green-600', 'border-green-600', 'active');
                } else {
                    btn.classList.remove('text-white', 'bg-green-600', 'border-green-600', 'active');
                    btn.classList.add('text-gray-700', 'bg-white', 'border-gray-300');
                }
            });
            
            // Filter articles
            articles.forEach(article => {
                if (category === 'all' || article.dataset.category === category) {
                    article.style.display = 'block';
                    // Add fade-in animation
                    article.style.animation = 'fadeIn 0.3s ease-in';
                } else {
                    article.style.display = 'none';
                }
            });
        }
        
        // Add CSS animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(style);
    </script>
</x-app-layout>


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

            <!-- Search Bar -->
            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="searchInput"
                        placeholder="Cari artikel berdasarkan judul, kategori, atau kata kunci..." 
                        class="w-full pl-12 pr-4 py-3 border border-gray-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all shadow-sm"
                        oninput="searchArticles(this.value)"
                    >
                    <button 
                        id="clearSearch" 
                        onclick="clearSearch()"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hidden"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- Search Results Count -->
                <p id="searchResultsCount" class="mt-2 text-sm text-gray-500 dark:text-gray-400 hidden">
                    Menampilkan <span id="resultsCount">0</span> artikel
                </p>
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
        let currentCategory = 'all';
        let currentSearch = '';

        // Store article data for search
        const articlesData = [
            @foreach($articles as $article)
            {
                slug: "{{ $article['slug'] }}",
                title: "{{ addslashes($article['title']) }}",
                excerpt: "{{ addslashes($article['excerpt']) }}",
                category: "{{ $article['category'] }}",
                author: "{{ addslashes($article['author']) }}"
            },
            @endforeach
        ];

        function searchArticles(query) {
            currentSearch = query.toLowerCase().trim();
            const clearBtn = document.getElementById('clearSearch');
            const resultsCountEl = document.getElementById('searchResultsCount');
            
            // Show/hide clear button
            if (currentSearch.length > 0) {
                clearBtn.classList.remove('hidden');
                resultsCountEl.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
                resultsCountEl.classList.add('hidden');
            }
            
            applyFilters();
        }

        function clearSearch() {
            const searchInput = document.getElementById('searchInput');
            searchInput.value = '';
            currentSearch = '';
            document.getElementById('clearSearch').classList.add('hidden');
            document.getElementById('searchResultsCount').classList.add('hidden');
            applyFilters();
        }

        function filterArticles(category) {
            currentCategory = category;
            const buttons = document.querySelectorAll('.category-btn');
            
            // Update button styles
            buttons.forEach(btn => {
                if (btn.dataset.category === category) {
                    btn.classList.remove('text-gray-700', 'dark:text-gray-300', 'bg-white', 'dark:bg-slate-700', 'border-gray-300', 'dark:border-slate-600');
                    btn.classList.add('text-white', 'bg-green-600', 'border-green-600', 'active');
                } else {
                    btn.classList.remove('text-white', 'bg-green-600', 'border-green-600', 'active');
                    btn.classList.add('text-gray-700', 'dark:text-gray-300', 'bg-white', 'dark:bg-slate-700', 'border-gray-300', 'dark:border-slate-600');
                }
            });
            
            applyFilters();
        }

        function applyFilters() {
            const articles = document.querySelectorAll('.article-card');
            let visibleCount = 0;
            
            articles.forEach((article, index) => {
                const articleData = articlesData[index];
                const matchesCategory = currentCategory === 'all' || article.dataset.category === currentCategory;
                
                let matchesSearch = true;
                if (currentSearch.length > 0) {
                    const searchableText = (articleData.title + ' ' + articleData.excerpt + ' ' + articleData.category + ' ' + articleData.author).toLowerCase();
                    matchesSearch = searchableText.includes(currentSearch);
                }
                
                if (matchesCategory && matchesSearch) {
                    article.style.display = 'block';
                    article.style.animation = 'fadeIn 0.3s ease-in';
                    visibleCount++;
                } else {
                    article.style.display = 'none';
                }
            });
            
            // Update results count
            document.getElementById('resultsCount').textContent = visibleCount;
            
            // Show no results message if needed
            showNoResultsMessage(visibleCount === 0 && (currentSearch.length > 0 || currentCategory !== 'all'));
        }

        function showNoResultsMessage(show) {
            let noResultsEl = document.getElementById('noResultsMessage');
            
            if (show) {
                if (!noResultsEl) {
                    noResultsEl = document.createElement('div');
                    noResultsEl.id = 'noResultsMessage';
                    noResultsEl.className = 'col-span-full text-center py-12';
                    noResultsEl.innerHTML = `
                        <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Tidak ada artikel ditemukan</h3>
                        <p class="text-gray-500 dark:text-gray-400">Coba kata kunci lain atau hapus filter kategori</p>
                        <button onclick="resetAllFilters()" class="mt-4 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                            Reset Filter
                        </button>
                    `;
                    document.querySelector('.grid').appendChild(noResultsEl);
                }
                noResultsEl.style.display = 'block';
            } else if (noResultsEl) {
                noResultsEl.style.display = 'none';
            }
        }

        function resetAllFilters() {
            clearSearch();
            filterArticles('all');
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


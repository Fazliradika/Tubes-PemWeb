<x-app-layout>
    <!-- Reading Progress Bar -->
    <div id="reading-progress-bar" class="fixed top-0 left-0 h-1 bg-green-600 z-50 transition-all duration-150" style="width: 0%"></div>

    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('articles.index') }}" class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Artikel Kesehatan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Article Header -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
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
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ $article['title'] }}</h1>
                    
                    <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400 mb-6 pb-6 border-b dark:border-slate-600">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ $article['author'] }}</span>
                            </div>
                            <span>•</span>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $article['read_time'] }}</span>
                            </div>
                            <span>•</span>
                            <span>{{ $article['published_at'] }}</span>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <!-- Love Button -->
                            <form id="likeForm" method="POST" style="display: inline;">
                                @csrf
                                <input type="hidden" name="article_slug" value="{{ $article['slug'] }}">
                                <button 
                                    id="likeButton"
                                    type="button"
                                    onclick="handleLikeClick()"
                                    class="p-2 rounded-full transition duration-200 {{ $userHasLiked ? 'text-red-600 dark:text-red-500 bg-red-50 dark:bg-red-900/30' : 'text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30' }}"
                                    title="Suka artikel ini"
                                >
                                    <svg id="likeIcon" class="w-5 h-5 transition-all duration-200" fill="{{ $userHasLiked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </form>
                            <span id="likesCount" class="text-sm text-gray-600 dark:text-gray-400 font-medium">{{ $likesCount }}</span>
                            
                            <!-- Share Button -->
                            <button 
                                onclick="shareArticle()"
                                class="p-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition"
                                title="Bagikan artikel"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Article Content and Sidebar Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Article Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-8">
                            <!-- Article Content -->
                            <div class="max-w-none article-content" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 17px; line-height: 1.75;">
                                <style scoped>
                                    .article-content p {
                                        margin-bottom: 1.25rem;
                                        line-height: 1.75;
                                        font-size: 17px;
                                    }
                                    .article-content h2 {
                                        font-size: 24px;
                                        font-weight: 700;
                                        margin-top: 2rem;
                                        margin-bottom: 1rem;
                                    }
                                    .article-content h3 {
                                        font-size: 18px;
                                        font-weight: 600;
                                        margin-top: 1.5rem;
                                        margin-bottom: 0.75rem;
                                    }
                                    .article-content ul,
                                    .article-content ol {
                                        margin: 1rem 0 2rem 0;
                                        padding: 0;
                                        list-style: none;
                                    }
                                    .article-content ul li,
                                    .article-content ol li {
                                        margin-bottom: 0.5rem;
                                        line-height: 1.75;
                                        font-size: 17px;
                                        list-style: none;
                                    }
                                    .article-content strong {
                                        font-weight: 700;
                                    }
                                    /* Light mode colors */
                                    .article-content p,
                                    .article-content li { color: #374151; }
                                    .article-content h2 { color: #111827; }
                                    .article-content h3 { color: #1f2937; }
                                    .article-content strong { color: #111827; }
                                    /* Dark mode colors */
                                    .dark .article-content,
                                    .dark .article-content p,
                                    .dark .article-content li { color: #d1d5db !important; }
                                    .dark .article-content h2 { color: #f9fafb !important; }
                                    .dark .article-content h3 { color: #e5e7eb !important; }
                                    .dark .article-content strong { color: #f9fafb !important; }
                                    
                                    /* Quote box styling - Override inline classes */
                                    .article-content .article-quote,
                                    .article-content blockquote,
                                    .article-content [class*="bg-green-50"] {
                                        background: #ecfdf5 !important;
                                        border-left: 4px solid #10b981 !important;
                                        padding: 1.5rem !important;
                                        margin: 1.5rem 0 !important;
                                        border-radius: 0.5rem !important;
                                        font-style: italic;
                                        color: #374151 !important;
                                    }
                                    .dark .article-content .article-quote,
                                    .dark .article-content blockquote,
                                    .dark .article-content [class*="bg-green-50"] {
                                        background: rgba(16, 185, 129, 0.15) !important;
                                        border-left-color: #34d399 !important;
                                        color: #d1d5db !important;
                                    }
                                    
                                    /* TOC styling - Override inline classes */
                                    .article-content .toc,
                                    .article-content .toc-container,
                                    .article-content [class*="bg-gray-50"] {
                                        background: #f9fafb !important;
                                        border: 1px solid #e5e7eb !important;
                                        border-radius: 0.5rem !important;
                                        padding: 1.5rem !important;
                                        margin-bottom: 2rem !important;
                                    }
                                    .dark .article-content .toc,
                                    .dark .article-content .toc-container,
                                    .dark .article-content [class*="bg-gray-50"] {
                                        background: #1e293b !important;
                                        border-color: #475569 !important;
                                    }
                                    
                                    /* TOC links */
                                    .article-content .toc a,
                                    .article-content .toc-container a,
                                    .article-content [class*="text-blue-600"] {
                                        color: #059669 !important;
                                    }
                                    .dark .article-content .toc a,
                                    .dark .article-content .toc-container a,
                                    .dark .article-content [class*="text-blue-600"] {
                                        color: #34d399 !important;
                                    }
                                    
                                    /* TOC heading */
                                    .article-content .toc h2,
                                    .article-content .toc-container h2 {
                                        font-size: 1.25rem !important;
                                        margin-bottom: 1rem !important;
                                    }
                                </style>
                                {!! $article['content'] !!}
                            </div>

                            <!-- Interactive Calculators -->
                            @if(!empty($calculators))
                            <div class="mt-8 pt-6 border-t dark:border-slate-600">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">🧮 Kalkulator Interaktif</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-6">Gunakan kalkulator di bawah untuk mendapatkan rekomendasi yang dipersonalisasi sesuai kondisi Anda:</p>
                                
                                @foreach($calculators as $calculator)
                                    @if($calculator === 'bmi')
                                        @include('components.calculators.bmi-calculator')
                                    @elseif($calculator === 'calorie')
                                        @include('components.calculators.calorie-calculator')
                                    @elseif($calculator === 'water')
                                        @include('components.calculators.water-calculator')
                                    @endif
                                @endforeach
                            </div>
                            @endif

                            <!-- Tags -->
                            <div class="mt-8 pt-6 border-t dark:border-slate-600">
                                <div class="flex flex-wrap gap-2">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400 mr-2">Tags:</span>
                                    <span class="px-3 py-1 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300 text-sm rounded-full">#kesehatan</span>
                                    <span class="px-3 py-1 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300 text-sm rounded-full">#{{ strtolower(str_replace(' ', '', $article['category'])) }}</span>
                                    <span class="px-3 py-1 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-gray-300 text-sm rounded-full">#tipskesehatan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (Right Side) -->
                <div class="lg:col-span-1">
                    <!-- Topik Terkini -->
                    <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 sticky top-6">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Topik Terkini</h3>
                                <a href="{{ route('articles.index') }}" class="text-sm text-red-600 hover:text-red-700 font-medium">
                                    Lihat Semua
                                </a>
                            </div>
                            
                            @php
                                // Define relevant topics based on specific article content
                                $topicsBySlug = [
                                    '7-makanan-yang-bikin-kurus-cocok-untuk-menu-diet-harian' => ['Diet', 'Diabetes', 'Jantung', 'Stroke', 'Kolesterol', 'Hipertensi'],
                                    'tips-olahraga-efektif-untuk-kesehatan-jantung' => ['Jantung', 'Stroke', 'Hipertensi', 'Kolesterol', 'Diabetes', 'Anemia'],
                                    'mengelola-diabetes-dengan-pola-makan-sehat' => ['Diabetes', 'Jantung', 'Hipertensi', 'Kolesterol', 'Stroke', 'Anemia'],
                                    'pentingnya-vitamin-dan-mineral-untuk-tubuh' => ['Anemia', 'Reproduksi', 'Hipertensi', 'Diabetes', 'Jantung', 'Kanker'],
                                    'cara-mengatasi-stres-dan-menjaga-kesehatan-mental' => ['Insecure', 'Relationship', 'Anemia', 'Reproduksi', 'Hipertensi', 'Kanker'],
                                    'tips-tidur-berkualitas-untuk-kulit-sehat-dan-bercahaya' => ['Anemia', 'Reproduksi', 'Hipertensi', 'Diabetes', 'Jantung', 'Kanker'],
                                    'bahaya-hipertensi-dan-cara-mencegahnya' => ['Hipertensi', 'Jantung', 'Stroke', 'Diabetes', 'Kolesterol', 'Anemia'],
                                    'manfaat-yoga-untuk-kesehatan-fisik-dan-mental' => ['Jantung', 'Hipertensi', 'Diabetes', 'Stroke', 'Kolesterol', 'Anemia'],
                                    'makanan-super-untuk-meningkatkan-imun-tubuh' => ['Diabetes', 'Jantung', 'Hipertensi', 'Anemia', 'Kolesterol', 'Kanker'],
                                    'panduan-lengkap-kesehatan-mata-di-era-digital' => ['Diabetes', 'Hipertensi', 'Anemia', 'Jantung', 'Stroke', 'Kanker'],
                                    'detoksifikasi-tubuh-secara-alami-dan-aman' => ['Hipertensi', 'Diabetes', 'Jantung', 'Kolesterol', 'Stroke', 'Kanker'],
                                    'manajemen-nyeri-punggung-untuk-pekerja-kantoran' => ['Hipertensi', 'Diabetes', 'Jantung', 'Stroke', 'Kolesterol', 'Anemia'],
                                    'panduan-lengkap-diet-mediterania-untuk-jantung-sehat' => ['Jantung', 'Diabetes', 'Hipertensi', 'Kolesterol', 'Stroke', 'Anemia'],
                                    'terapi-musik-untuk-kesehatan-mental-dan-relaksasi' => ['Relationship', 'Insecure', 'Anemia', 'Reproduksi', 'Hipertensi', 'Diabetes'],
                                    'manfaat-puasa-intermittent-untuk-kesehatan-dan-berat-badan' => ['Diabetes', 'Jantung', 'Hipertensi', 'Kolesterol', 'Stroke', 'Anemia'],
                                    'olahraga-hiit-untuk-membakar-lemak-maksimal' => ['Jantung', 'Diabetes', 'Hipertensi', 'Stroke', 'Kolesterol', 'Anemia'],
                                    'makanan-penurun-kolesterol-tinggi-secara-alami' => ['Kolesterol', 'Jantung', 'Diabetes', 'Hipertensi', 'Stroke', 'Anemia'],
                                    'cara-mengatasi-insomnia-dan-gangguan-tidur' => ['Insecure', 'Relationship', 'Anemia', 'Reproduksi', 'Hipertensi', 'Diabetes'],
                                    'rahasia-kulit-glowing-dengan-perawatan-alami' => ['Anemia', 'Reproduksi', 'Hipertensi', 'Diabetes', 'Jantung', 'Kanker'],
                                    'panduan-hidup-sehat-untuk-penderita-asma' => ['Hipertensi', 'Diabetes', 'Jantung', 'Stroke', 'Kolesterol', 'Anemia'],
                                ];
                                
                                // Get relevant topics based on article slug or use default
                                $relevantTopics = $topicsBySlug[$article['slug']] ?? ['Diabetes', 'Jantung', 'Stroke', 'Kehamilan', 'Kolesterol', 'Hipertensi'];
                            @endphp
                            
                            <div class="flex flex-wrap gap-2 mb-6">
                                @foreach($relevantTopics as $topic)
                                <a href="{{ route('articles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 rounded-md hover:bg-gray-50 dark:hover:bg-slate-600 transition">
                                    {{ $topic }}
                                </a>
                                @endforeach
                            </div>

                            <div class="border-t dark:border-slate-600 pt-6">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Artikel Terkait</h4>
                                <div class="space-y-4">
                                    @php
                                        $sidebarArticles = collect($relatedArticles)->take(5);
                                        if($sidebarArticles->count() == 0) {
                                            $allArticles = app('App\Http\Controllers\ArticleController')->getArticles();
                                            $sidebarArticles = collect($allArticles)
                                                ->where('slug', '!=', $article['slug'])
                                                ->take(5);
                                        }
                                    @endphp
                                    
                                    @foreach($sidebarArticles as $sidebar)
                                    <a href="{{ route('articles.show', $sidebar['slug']) }}" class="block group hover:bg-gray-50 dark:hover:bg-slate-700 rounded-lg transition p-2 -mx-2">
                                        <div class="flex gap-3">
                                            <img src="{{ $sidebar['image'] }}" 
                                                 alt="{{ $sidebar['title'] }}" 
                                                 class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                            <div class="flex-1 min-w-0">
                                                <h5 class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition line-clamp-2 mb-2 leading-tight">
                                                    {{ $sidebar['title'] }}
                                                </h5>
                                                <div class="flex items-center gap-2 text-xs">
                                                    <span class="text-teal-600 dark:text-teal-400 font-medium">{{ $sidebar['category'] }}</span>
                                                    <span class="text-gray-400">•</span>
                                                    <span class="text-gray-500 dark:text-gray-400">{{ $sidebar['read_time'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Related Doctors Section (Full Width) -->
            @if($relatedDoctors->count() > 0)
            <div class="mt-8 bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Dokter Terkait</h3>
                        <a href="{{ route('appointments.index') }}" class="text-sm text-green-600 hover:text-green-700 font-medium flex items-center gap-1">
                            Lihat Semua Dokter
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedDoctors as $doctor)
                        <div class="bg-white dark:bg-slate-700 rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden border border-gray-200 dark:border-slate-600">
                            <div class="p-6">
                                <div class="flex flex-col items-center text-center">
                                    <!-- Doctor Photo -->
                                    <div class="w-24 h-24 rounded-full overflow-hidden mb-4 border-4 border-green-500">
                                        <img src="{{ $doctor->photo }}" 
                                             alt="{{ $doctor->user->name }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                    
                                    <!-- Doctor Name -->
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">
                                        {{ $doctor->user->name }}
                                    </h4>
                                    
                                    <!-- Specialization -->
                                    <p class="text-sm font-medium text-green-600 dark:text-green-400 mb-3">
                                        {{ $doctor->specialization }}
                                    </p>
                                    
                                    <!-- Bio -->
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
                                        {{ $doctor->bio }}
                                    </p>
                                    
                                    <!-- Experience and Price -->
                                    <div class="w-full space-y-2 mb-4">
                                        <div class="flex items-center justify-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <span>{{ $doctor->years_of_experience }} tahun pengalaman</span>
                                        </div>
                                        <div class="flex items-center justify-center gap-2 text-sm">
                                            <span class="text-gray-600 dark:text-gray-400">Mulai dari</span>
                                            <span class="text-lg font-bold text-green-600 dark:text-green-400">
                                                Rp {{ number_format($doctor->price_per_session, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Button -->
                                    <a href="{{ route('appointments.create', $doctor->id) }}" 
                                       class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 text-center">
                                        Buat Janji
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Comments Section (Full Width Below) -->
            <div class="mt-8 bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Diskusi & Pertanyaan ({{ $comments->count() }})</h3>
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <!-- Comment Form -->
                    <form action="{{ route('comments.store') }}" method="POST" class="mb-8">
                        @csrf
                        <input type="hidden" name="article_slug" value="{{ $article['slug'] }}">
                        
                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tulis komentar atau pertanyaan Anda
                            </label>
                            <textarea 
                                name="comment" 
                                id="comment" 
                                rows="4" 
                                required
                                maxlength="1000"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"
                                placeholder="Bagikan pemikiran atau pertanyaan Anda tentang artikel ini..."
                            >{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 1000 karakter</p>
                        </div>
                        
                        <button 
                            type="submit" 
                            class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-200 flex items-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Kirim Komentar
                        </button>
                    </form>
                    
                    <!-- Comments List -->
                    <div class="space-y-6">
                        @forelse($comments as $comment)
                            <div class="border-b border-gray-200 dark:border-slate-600 pb-6 last:border-b-0">
                                <!-- Main Comment -->
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold">
                                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</h4>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                            
                                            @if($comment->user_id === auth()->id())
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        
                                        <p class="text-gray-700 leading-relaxed mb-3">{{ $comment->comment }}</p>
                                        
                                        <!-- Reply Button -->
                                        <button 
                                            onclick="toggleReplyForm({{ $comment->id }})" 
                                            class="text-green-600 hover:text-green-700 text-sm font-medium flex items-center gap-1"
                                        >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                            </svg>
                                            Balas
                                        </button>
                                        
                                        <!-- Reply Form (Hidden by default) -->
                                        <div id="reply-form-{{ $comment->id }}" class="mt-4 hidden">
                                            <form action="{{ route('comments.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="article_slug" value="{{ $article['slug'] }}">
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                
                                                <textarea 
                                                    name="comment" 
                                                    rows="3" 
                                                    required
                                                    maxlength="1000"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none mb-2"
                                                    placeholder="Tulis balasan Anda..."
                                                ></textarea>
                                                
                                                <div class="flex gap-2">
                                                    <button 
                                                        type="submit" 
                                                        class="px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition"
                                                    >
                                                        Kirim Balasan
                                                    </button>
                                                    <button 
                                                        type="button" 
                                                        onclick="toggleReplyForm({{ $comment->id }})" 
                                                        class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-300 transition"
                                                    >
                                                        Batal
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <!-- Replies -->
                                        @if($comment->replies->count() > 0)
                                            <div class="mt-4 space-y-4 pl-4 border-l-2 border-gray-200">
                                                @foreach($comment->replies as $reply)
                                                    <div class="flex gap-3">
                                                        <div class="flex-shrink-0">
                                                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                                                {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="flex-1">
                                                            <div class="flex items-center justify-between mb-1">
                                                                <div>
                                                                    <h5 class="font-semibold text-gray-900 text-sm">{{ $reply->user->name }}</h5>
                                                                    <p class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                                                </div>
                                                                
                                                                @if($reply->user_id === auth()->id())
                                                                    <form action="{{ route('comments.destroy', $reply) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus balasan ini?')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="text-red-600 hover:text-red-800 text-xs">
                                                                            Hapus
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                            
                                                            <p class="text-gray-700 text-sm leading-relaxed">{{ $reply->comment }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada komentar</h3>
                                <p class="text-gray-600">Jadilah yang pertama untuk berkomentar atau bertanya!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle reply form
        function toggleReplyForm(commentId) {
            const form = document.getElementById(`reply-form-${commentId}`);
            form.classList.toggle('hidden');
        }
        
        // Handle like button click
        function handleLikeClick() {
            console.log('=== LIKE BUTTON CLICKED ===');
            
            const button = document.getElementById('likeButton');
            const icon = document.getElementById('likeIcon');
            const countElement = document.getElementById('likesCount');
            
            // Prevent double clicks
            if (button.disabled) {
                console.log('Button already processing...');
                return;
            }
            
            button.disabled = true;
            console.log('Button disabled, starting request...');
            
            // Get CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log('CSRF Token:', token ? 'Found' : 'NOT FOUND');
            
            const url = '{{ route("articles.like.toggle") }}';
            const articleSlug = '{{ $article["slug"] }}';
            
            console.log('Request URL:', url);
            console.log('Article Slug:', articleSlug);
            
            // Make request using XMLHttpRequest for better compatibility
            const xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', token);
            xhr.setRequestHeader('Accept', 'application/json');
            
            xhr.onload = function() {
                console.log('Response received. Status:', xhr.status);
                console.log('Response text:', xhr.responseText);
                
                button.disabled = false;
                
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        const data = JSON.parse(xhr.responseText);
                        console.log('Parsed data:', data);
                        
                        // Update count
                        countElement.textContent = data.likes_count;
                        console.log('Updated count to:', data.likes_count);
                        
                        // Update button appearance
                        if (data.liked) {
                            console.log('Setting LIKED state (RED)');
                            button.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:text-red-600', 'dark:hover:text-red-500');
                            button.classList.add('text-red-600', 'dark:text-red-500', 'bg-red-50', 'dark:bg-red-900/30');
                            icon.setAttribute('fill', 'currentColor');
                            showMessage('❤️ Artikel disukai!', 'success');
                        } else {
                            console.log('Setting UNLIKED state (GRAY)');
                            button.classList.remove('text-red-600', 'dark:text-red-500', 'bg-red-50', 'dark:bg-red-900/30');
                            button.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:text-red-600', 'dark:hover:text-red-500');
                            icon.setAttribute('fill', 'none');
                            showMessage('Batal menyukai artikel', 'info');
                        }
                    } catch (e) {
                        console.error('Error parsing response:', e);
                        showMessage('Terjadi kesalahan', 'error');
                    }
                } else {
                    console.error('HTTP Error:', xhr.status);
                    showMessage('Gagal menyimpan. Coba lagi!', 'error');
                }
            };
            
            xhr.onerror = function() {
                console.error('Network error occurred');
                button.disabled = false;
                showMessage('Koneksi gagal. Periksa internet Anda!', 'error');
            };
            
            const payload = JSON.stringify({ article_slug: articleSlug });
            console.log('Sending payload:', payload);
            xhr.send(payload);
        }
        
        // Show message notification
        function showMessage(message, type = 'info') {
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                info: 'bg-blue-500'
            };
            
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300`;
            notification.style.opacity = '0';
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Fade in
            setTimeout(() => notification.style.opacity = '1', 10);
            
            // Fade out and remove
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
        
        // Share article
        async function shareArticle() {
            const url = window.location.href;
            const title = decodeHtmlEntities('{{ addslashes($article["title"]) }}');
            const text = decodeHtmlEntities('{{ addslashes(Str::limit($article["excerpt"], 100)) }}');
            
            // Check if Web Share API is supported
            if (navigator.share) {
                try {
                    await navigator.share({
                        title: title,
                        text: text,
                        url: url
                    });
                    showNotification('Artikel berhasil dibagikan!', 'success');
                } catch (error) {
                    if (error.name !== 'AbortError') {
                        fallbackShare(url, title);
                    }
                }
            } else {
                fallbackShare(url, title);
            }
        }
        
        // Decode HTML entities
        function decodeHtmlEntities(str) {
            const textarea = document.createElement('textarea');
            textarea.innerHTML = str;
            return textarea.value;
        }
        
        // Fallback share (copy to clipboard)
        function fallbackShare(url, title) {
            showShareModal(url, title);
        }
        
        // Show share modal with options
        function showShareModal(url, title) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
            modal.onclick = (e) => {
                if (e.target === modal) modal.remove();
            };
            
            modal.innerHTML = `
                <div class="bg-white dark:bg-slate-800 rounded-lg p-6 max-w-md w-full" onclick="event.stopPropagation()">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Bagikan Artikel</h3>
                    
                    <div class="space-y-2 mb-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}" 
                           target="_blank"
                           onclick="showNotification('Membuka Facebook...', 'info')"
                           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Bagikan ke Facebook</span>
                        </a>
                        
                        <a href="https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}" 
                           target="_blank"
                           onclick="showNotification('Membuka Twitter...', 'info')"
                           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-10 h-10 bg-sky-500 rounded-full flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Bagikan ke Twitter</span>
                        </a>
                        
                        <a href="https://wa.me/?text=${encodeURIComponent(title + ' - ' + url)}" 
                           target="_blank"
                           onclick="showNotification('Membuka WhatsApp...', 'info')"
                           class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Bagikan ke WhatsApp</span>
                        </a>
                        
                        <button onclick="copyToClipboard('${url}'); this.closest('.fixed').remove();" 
                                class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                            <div class="w-10 h-10 bg-gray-600 rounded-full flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Salin Link</span>
                        </button>
                    </div>
                    
                    <button onclick="this.closest('.fixed').remove()" 
                            class="w-full px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                        Tutup
                    </button>
                </div>
            `;
            document.body.appendChild(modal);
        }
        
        // Copy to clipboard
        function copyToClipboard(text) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(() => {
                    showNotification('Link berhasil disalin!', 'success');
                }).catch(() => {
                    fallbackCopy(text);
                });
            } else {
                fallbackCopy(text);
            }
        }
        
        // Fallback copy method
        function fallbackCopy(text) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();
            try {
                document.execCommand('copy');
                showNotification('Link berhasil disalin!', 'success');
            } catch (err) {
                showNotification('Gagal menyalin link', 'error');
            }
            document.body.removeChild(textarea);
        }
        
        // Show notification
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
            
            notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-300`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    </script>

    <style>
        /* Article Content Styling */
        .article-content {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', sans-serif !important;
            font-size: 1.0625rem !important;
            line-height: 1.75 !important;
            color: #1f2937 !important;
        }        /* Quote Styling */
        .article-quote {
            font-size: 1.125rem !important;
            line-height: 1.8 !important;
            padding: 1.5rem 1.25rem !important;
            margin: 2rem 0 !important;
            border-radius: 0.5rem !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1) !important;
        }

        /* Table of Contents */
        .toc {
            background: linear-gradient(to right, #f9fafb, #f3f4f6) !important;
            padding: 1.25rem !important;
            border-radius: 0.75rem !important;
            margin: 2rem 0 !important;
            border: 1px solid #e5e7eb !important;
        }

        .toc li {
            padding: 0.5rem 0 !important;
            border-bottom: 1px solid #e5e7eb !important;
            list-style: none !important;
        }

        .toc li:last-child {
            border-bottom: none !important;
        }

        .toc a {
            font-size: 1.0625rem !important;
            font-weight: 500 !important;
            transition: all 0.2s !important;
            display: block !important;
            padding-left: 1rem !important;
        }

        .toc a:hover {
            color: #059669 !important;
            padding-left: 1.5rem !important;
        }

        /* Headings */
        .article-content h2 {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            margin-top: 2rem !important;
            margin-bottom: 1rem !important;
            color: #111827 !important;
            padding-bottom: 0 !important;
            border-bottom: none !important;
            line-height: 1.3 !important;
        }

        .article-content h3 {
            font-size: 1.125rem !important;
            font-weight: 600 !important;
            margin-top: 1.5rem !important;
            margin-bottom: 0.75rem !important;
            color: #1f2937 !important;
            line-height: 1.4 !important;
        }

        /* Paragraphs */
        .article-content p {
            margin-bottom: 1.25rem !important;
            line-height: 1.75 !important;
            color: #374151 !important;
            text-align: left !important;
            font-size: 1.0625rem !important;
        }

        .article-content p:first-of-type {
            font-size: 1.0625rem !important;
            color: #1f2937 !important;
            line-height: 1.75 !important;
            margin-bottom: 1.25rem !important;
        }

        /* Lists */
        .article-content ul {
            margin-top: 1rem !important;
            margin-bottom: 2rem !important;
            padding-left: 0 !important;
            list-style-type: none !important;
        }

        .article-content ul li {
            margin-bottom: 0.5rem !important;
            color: #374151 !important;
            font-size: 1.0625rem !important;
            line-height: 1.75 !important;
            position: relative !important;
            padding-left: 0 !important;
            list-style: none !important;
        }

        .article-content ul li:before {
            content: "" !important;
            display: none !important;
        }

        .article-content ol {
            margin-top: 1rem !important;
            margin-bottom: 2rem !important;
            padding-left: 0 !important;
            counter-reset: item !important;
            list-style-type: none !important;
        }

        .article-content ol li {
            margin-bottom: 0.5rem !important;
            color: #374151 !important;
            font-size: 1.0625rem !important;
            line-height: 1.75 !important;
            counter-increment: item !important;
            padding-left: 0 !important;
            position: relative !important;
            list-style: none !important;
        }

        .article-content ol li:before {
            content: "" !important;
            display: none !important;
        }

        /* Strong/Bold text */
        .article-content strong {
            font-weight: 700 !important;
            color: #111827 !important;
            font-size: 1.0625rem !important;
        }

        /* Links */
        .article-content a {
            color: #2563eb;
            text-decoration: none;
            border-bottom: 1px solid transparent;
            transition: all 0.2s;
        }

        .article-content a:hover {
            color: #1d4ed8;
            border-bottom-color: #2563eb;
        }

        /* First letter styling - DISABLED for cleaner look */
        .article-content > p:first-of-type:first-letter {
            /* Disabled drop cap for cleaner appearance */
        }

        /* Sections spacing */
        .article-content > * + * {
            margin-top: 1rem;
        }

        /* Related articles */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Sidebar sticky */
        .sticky {
            position: sticky;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .article-content {
                font-size: 1rem;
            }
            
            .article-content h2 {
                font-size: 1.5rem;
                margin-top: 2rem;
            }
            
            .article-content h3 {
                font-size: 1.25rem;
            }
            
            .article-content p {
                font-size: 1rem;
            }
            
            .article-quote {
                font-size: 1.125rem;
                padding: 1.5rem 1rem;
            }
            
            .article-content > p:first-of-type:first-letter {
                font-size: 3rem;
                line-height: 2.5rem;
            }
        }

        /* Print styles */
        @media print {
            .article-content {
                font-size: 12pt;
                line-height: 1.6;
            }
            
            .article-content h2 {
                page-break-after: avoid;
            }
        }

        /* Reading Progress Bar */
        #reading-progress-bar {
            box-shadow: 0 2px 4px rgba(22, 163, 74, 0.3);
        }
    </style>

    <script>
        // Reading Progress Bar
        window.addEventListener('scroll', function() {
            const progressBar = document.getElementById('reading-progress-bar');
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Calculate scroll percentage
            const scrollPercentage = (scrollTop / (documentHeight - windowHeight)) * 100;
            
            // Update progress bar width
            progressBar.style.width = Math.min(scrollPercentage, 100) + '%';
        });

        // Initialize on page load
        window.addEventListener('load', function() {
            window.dispatchEvent(new Event('scroll'));
        });
    </script>
</x-app-layout>

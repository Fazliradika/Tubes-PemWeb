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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                </div>
            </div>
            
            <!-- Article Content and Sidebar Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Article Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-8">
                            <!-- Article Content -->
                            <div class="max-w-none" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; font-size: 17px; line-height: 1.75; color: #374151;">
                                <style scoped>
                                    div.max-w-none p {
                                        margin-bottom: 1.25rem;
                                        line-height: 1.75;
                                        color: #374151;
                                        font-size: 17px;
                                    }
                                    div.max-w-none h2 {
                                        font-size: 24px;
                                        font-weight: 700;
                                        margin-top: 2rem;
                                        margin-bottom: 1rem;
                                        color: #111827;
                                    }
                                    div.max-w-none h3 {
                                        font-size: 18px;
                                        font-weight: 600;
                                        margin-top: 1.5rem;
                                        margin-bottom: 0.75rem;
                                        color: #1f2937;
                                    }
                                    div.max-w-none ul,
                                    div.max-w-none ol {
                                        margin: 1rem 0 2rem 0;
                                        padding: 0;
                                        list-style: none;
                                    }
                                    div.max-w-none ul li,
                                    div.max-w-none ol li {
                                        margin-bottom: 0.5rem;
                                        line-height: 1.75;
                                        color: #374151;
                                        font-size: 17px;
                                        list-style: none;
                                    }
                                    div.max-w-none strong {
                                        font-weight: 700;
                                        color: #111827;
                                    }
                                </style>
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
                </div>

                <!-- Sidebar (Right Side) -->
                <div class="lg:col-span-1">
                    <!-- Topik Terkini -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 sticky top-6">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-900">Topik Terkini</h3>
                                <a href="{{ route('articles.index') }}" class="text-sm text-red-600 hover:text-red-700 font-medium">
                                    Lihat Semua
                                </a>
                            </div>
                            
                            @php
                                // Define relevant topics based on article category
                                $topicsByCategory = [
                                    'Nutrisi' => ['Diabetes', 'Jantung', 'Hipertensi', 'Anemia', 'Kolesterol', 'Kanker'],
                                    'Olahraga' => ['Jantung', 'Diabetes', 'Hipertensi', 'Stroke', 'Kolesterol', 'Anemia'],
                                    'Diabetes' => ['Diabetes', 'Jantung', 'Hipertensi', 'Kolesterol', 'Stroke', 'Anemia'],
                                    'Kesehatan Mental' => ['Relationship', 'Insecure', 'Anemia', 'Reproduksi', 'Hipertensi', 'Kanker'],
                                    'Hidup Sehat' => ['Hipertensi', 'Diabetes', 'Jantung', 'Kolesterol', 'Stroke', 'Kanker'],
                                    'Kecantikan' => ['Anemia', 'Reproduksi', 'Hipertensi', 'Diabetes', 'Jantung', 'Kanker'],
                                ];
                                
                                // Get relevant topics or use default
                                $relevantTopics = $topicsByCategory[$article['category']] ?? ['Diabetes', 'Jantung', 'Stroke', 'Kehamilan', 'Kolesterol', 'Hipertensi'];
                            @endphp
                            
                            <div class="flex flex-wrap gap-2 mb-6">
                                @foreach($relevantTopics as $topic)
                                <a href="{{ route('articles.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                                    {{ $topic }}
                                </a>
                                @endforeach
                            </div>

                            <div class="border-t pt-6">
                                <h4 class="text-lg font-bold text-gray-900 mb-4">Artikel Terkait</h4>
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
                                    <a href="{{ route('articles.show', $sidebar['slug']) }}" class="block group hover:bg-gray-50 rounded-lg transition p-2 -mx-2">
                                        <div class="flex gap-3">
                                            <img src="{{ $sidebar['image'] }}" 
                                                 alt="{{ $sidebar['title'] }}" 
                                                 class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                                            <div class="flex-1 min-w-0">
                                                <h5 class="text-sm font-semibold text-gray-900 group-hover:text-green-600 transition line-clamp-2 mb-2 leading-tight">
                                                    {{ $sidebar['title'] }}
                                                </h5>
                                                <div class="flex items-center gap-2 text-xs">
                                                    <span class="text-teal-600 font-medium">{{ $sidebar['category'] }}</span>
                                                    <span class="text-gray-400">•</span>
                                                    <span class="text-gray-500">{{ $sidebar['read_time'] }}</span>
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
        </div>
    </div>

    @push('styles')
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
    </style>
    @endpush
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Produk Kesehatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('products.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Search -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cari Produk</label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Nama produk...">
                            </div>

                            <!-- Category Filter -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                                <select name="category" id="category" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Sort -->
                            <div>
                                <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Urutkan</label>
                                <select name="sort" id="sort" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                                Reset
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Terapkan Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($products as $product)
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <div class="aspect-square bg-white dark:bg-slate-700 flex items-center justify-center p-4">
                                <img src="{{ $product->image ?: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400&h=400&fit=crop' }}" alt="{{ $product->name }}" 
                                    class="max-w-full max-h-full object-contain">
                            </div>
                        </a>

                        <div class="p-4">
                            <div class="text-sm text-blue-600 dark:text-blue-400 mb-1">{{ $product->category->name }}</div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                <a href="{{ route('products.show', $product->slug) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-3 line-clamp-2">{{ Str::limit($product->description, 80) }}</p>
                            
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Stok: {{ $product->stock }}</div>
                                </div>
                            </div>

                            @if($product->stock > 0)
                                <div class="mt-4 flex gap-2">
                                    {{-- Add to Cart Button --}}
                                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" 
                                            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-colors text-sm">
                                            <i class="fas fa-cart-plus mr-1"></i>Keranjang
                                        </button>
                                    </form>
                                    
                                    {{-- Buy Now Button --}}
                                    <form action="{{ route('cart.buyNow', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" 
                                            class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition-colors text-sm">
                                            <i class="fas fa-bolt mr-1"></i>Beli Langsung
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="mt-4">
                                    <button type="button" disabled
                                        class="w-full bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 py-2 rounded-md cursor-not-allowed">
                                        Stok Habis
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Tidak ada produk</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Coba ubah filter atau kata kunci pencarian Anda.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

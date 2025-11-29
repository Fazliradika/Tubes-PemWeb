<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $product->name }}
            </h2>
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Katalog
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div>
                            @if($product->image)
                                <img src="https://via.placeholder.com/600x600/4F46E5/FFFFFF?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" 
                                    class="w-full h-auto rounded-lg shadow-md">
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div>
                            <div class="mb-4">
                                <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                                    {{ $product->category->name }}
                                </span>
                            </div>

                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                            <div class="text-4xl font-bold text-blue-600 mb-6">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi Produk</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                            </div>

                            <div class="mb-6">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <span class="text-sm text-gray-600">Ketersediaan:</span>
                                        @if($product->stock > 0)
                                            <span class="text-green-600 font-semibold">Tersedia ({{ $product->stock }} unit)</span>
                                        @else
                                            <span class="text-red-600 font-semibold">Stok Habis</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-6">
                                    @csrf
                                    <div class="flex items-center space-x-4 mb-4">
                                        <label for="quantity" class="text-sm font-medium text-gray-700">Jumlah:</label>
                                        <input type="number" name="quantity" id="quantity" min="1" max="{{ $product->stock }}" value="1" 
                                            class="w-24 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>

                                    <button type="submit" 
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-cart-plus mr-2"></i>Tambah ke Keranjang
                                    </button>
                                </form>
                            @else
                                <button disabled
                                    class="w-full bg-gray-300 text-gray-500 py-3 px-6 rounded-lg font-semibold cursor-not-allowed">
                                    Stok Habis
                                </button>
                            @endif

                            <div class="border-t pt-6 mt-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Informasi Tambahan</h3>
                                <ul class="space-y-2 text-gray-600">
                                    <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Produk Original</li>
                                    <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Tersedia Konsultasi Gratis</li>
                                    <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Pengiriman Cepat</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <a href="{{ route('products.show', $relatedProduct->slug) }}">
                                    @if($relatedProduct->image)
                                        <img src="https://via.placeholder.com/300x300/4F46E5/FFFFFF?text={{ urlencode($relatedProduct->name) }}" alt="{{ $relatedProduct->name }}" 
                                            class="w-full h-48 object-cover">
                                    @else
                                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </a>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                        <a href="{{ route('products.show', $relatedProduct->slug) }}" class="hover:text-blue-600">
                                            {{ $relatedProduct->name }}
                                        </a>
                                    </h3>
                                    <div class="text-xl font-bold text-blue-600">
                                        Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

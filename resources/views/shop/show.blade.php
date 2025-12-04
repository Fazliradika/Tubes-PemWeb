<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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

            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div>
                            <img src="{{ $product->image ?: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=600&h=600&fit=crop' }}" alt="{{ $product->name }}" 
                                class="w-full h-auto rounded-lg shadow-md">
                        </div>

                        <!-- Product Info -->
                        <div>
                            <div class="mb-4">
                                <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">
                                    {{ $product->category->name }}
                                </span>
                            </div>

                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $product->name }}</h1>

                            <div class="text-4xl font-bold text-blue-600 mb-6">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Deskripsi Produk</h3>
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $product->description }}</p>
                            </div>

                            <div class="mb-6">
                                <div class="flex items-center space-x-4">
                                    <div>
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Ketersediaan:</span>
                                        @if($product->stock > 0)
                                            <span class="text-green-600 font-semibold">Tersedia ({{ $product->stock }} unit)</span>
                                        @else
                                            <span class="text-red-600 font-semibold">Stok Habis</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-6" x-data="{ 
                                    quantity: 1, 
                                    maxStock: {{ $product->stock }},
                                    price: {{ $product->price }},
                                    increment() { if(this.quantity < this.maxStock) this.quantity++ },
                                    decrement() { if(this.quantity > 1) this.quantity-- },
                                    get subtotal() { return this.quantity * this.price }
                                }">
                                    @csrf
                                    
                                    <!-- Quantity Selector -->
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Jumlah:</label>
                                        <div class="flex items-center space-x-4">
                                            <!-- Minus Button -->
                                            <button type="button" @click="decrement()" 
                                                :class="quantity <= 1 ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-slate-600 dark:hover:bg-slate-500 dark:text-white'"
                                                class="w-12 h-12 rounded-lg flex items-center justify-center transition-colors border border-gray-300 dark:border-slate-500">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            
                                            <!-- Quantity Input -->
                                            <input type="number" name="quantity" x-model.number="quantity" 
                                                min="1" max="{{ $product->stock }}" 
                                                @input="quantity = Math.min(Math.max(1, quantity), maxStock)"
                                                class="w-20 h-12 text-center text-xl font-bold rounded-lg border-gray-300 dark:border-slate-500 dark:bg-slate-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            
                                            <!-- Plus Button -->
                                            <button type="button" @click="increment()" 
                                                :class="quantity >= maxStock ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700 text-white'"
                                                class="w-12 h-12 rounded-lg flex items-center justify-center transition-colors">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            
                                            <!-- Max Stock Info -->
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                (Maks: {{ $product->stock }} unit)
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <!-- Subtotal Preview -->
                                    <div class="bg-gray-50 dark:bg-slate-700 rounded-lg p-4 mb-6">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600 dark:text-gray-300">Subtotal:</span>
                                            <span class="text-2xl font-bold text-blue-600" x-text="'Rp ' + subtotal.toLocaleString('id-ID')"></span>
                                        </div>
                                    </div>

                                    <button type="submit" 
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center">
                                        <i class="fas fa-cart-plus mr-2"></i>Tambah <span x-text="quantity" class="mx-1"></span> Item ke Keranjang
                                    </button>
                                </form>
                            @else
                                <button disabled
                                    class="w-full bg-gray-300 text-gray-500 py-3 px-6 rounded-lg font-semibold cursor-not-allowed">
                                    Stok Habis
                                </button>
                            @endif

                            <div class="border-t pt-6 mt-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Informasi Tambahan</h3>
                                <ul class="space-y-2 text-gray-600 dark:text-gray-400">
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
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Produk Terkait</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <a href="{{ route('products.show', $relatedProduct->slug) }}">
                                    <img src="{{ $relatedProduct->image ?: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300&h=300&fit=crop' }}" alt="{{ $relatedProduct->name }}" 
                                        class="w-full h-48 object-cover">
                                </a>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
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

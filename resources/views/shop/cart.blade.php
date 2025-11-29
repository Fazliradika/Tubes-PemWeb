<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang Belanja') }}
        </h2>
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

            @if($cart && $cart->cartItems->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    Produk di Keranjang ({{ $cart->cartItems->count() }} item)
                                </h3>

                                <div class="space-y-4">
                                    @foreach($cart->cartItems as $item)
                                        <div class="flex items-center space-x-4 p-4 border rounded-lg">
                                            <!-- Product Image -->
                                            <div class="flex-shrink-0">
                                                <img src="https://via.placeholder.com/200x200/4F46E5/FFFFFF?text={{ urlencode($item->product->name) }}" 
                                                        alt="{{ $item->product->name }}" 
                                                        class="w-24 h-24 object-cover rounded">
                                                @else
                                                    <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Product Info -->
                                            <div class="flex-1">
                                                <h4 class="text-lg font-semibold text-gray-900">
                                                    <a href="{{ route('products.show', $item->product->slug) }}" class="hover:text-blue-600">
                                                        {{ $item->product->name }}
                                                    </a>
                                                </h4>
                                                <p class="text-sm text-gray-600">{{ $item->product->category->name }}</p>
                                                <p class="text-lg font-bold text-blue-600 mt-2">
                                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                                </p>
                                            </div>

                                            <!-- Quantity & Actions -->
                                            <div class="flex flex-col items-end space-y-2">
                                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                                        min="1" max="{{ $item->product->stock }}"
                                                        class="w-16 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                    <button type="submit" class="text-blue-600 hover:text-blue-800">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </form>

                                                <div class="text-right">
                                                    <div class="text-sm text-gray-600">Subtotal:</div>
                                                    <div class="text-lg font-bold text-gray-900">
                                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                    </div>
                                                </div>

                                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                                        <i class="fas fa-trash mr-1"></i>Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-6 pt-6 border-t flex justify-between items-center">
                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash-alt mr-2"></i>Kosongkan Keranjang
                                        </button>
                                    </form>

                                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-arrow-left mr-2"></i>Lanjut Belanja
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden sticky top-4">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>

                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between text-gray-600">
                                        <span>Subtotal ({{ $cart->itemsCount }} item)</span>
                                        <span>Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600">
                                        <span>Ongkos Kirim</span>
                                        <span class="text-green-600 font-semibold">GRATIS</span>
                                    </div>
                                    <div class="border-t pt-3 flex justify-between text-lg font-bold">
                                        <span>Total</span>
                                        <span class="text-blue-600">Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                @auth
                                    <a href="{{ route('checkout.index') }}" 
                                        class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                        Lanjut ke Pembayaran
                                    </a>
                                @else
                                    <div class="text-center">
                                        <p class="text-sm text-gray-600 mb-3">Silakan login untuk melanjutkan</p>
                                        <a href="{{ route('login') }}" 
                                            class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                            Login
                                        </a>
                                    </div>
                                @endauth

                                <div class="mt-6 pt-6 border-t">
                                    <h4 class="font-semibold text-gray-900 mb-3">Keuntungan Belanja di Sini:</h4>
                                    <ul class="space-y-2 text-sm text-gray-600">
                                        <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Produk Original & Terpercaya</li>
                                        <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Gratis Ongkir</li>
                                        <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Konsultasi Gratis</li>
                                        <li><i class="fas fa-check-circle text-green-500 mr-2"></i>Pengiriman Cepat</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Keranjang Belanja Kosong</h3>
                        <p class="text-gray-600 mb-6">Anda belum menambahkan produk ke keranjang</p>
                        <a href="{{ route('products.index') }}" 
                            class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            <i class="fas fa-shopping-bag mr-2"></i>Mulai Belanja
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

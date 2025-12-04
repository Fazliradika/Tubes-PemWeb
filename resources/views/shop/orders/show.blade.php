<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detail Pesanan #{{ $order->order_number }}
            </h2>
            <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Order Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Order Status -->
                    <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Pesanan</h3>
                            
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'processing' => 'bg-blue-100 text-blue-800',
                                    'shipped' => 'bg-purple-100 text-purple-800',
                                    'delivered' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $statusLabels = [
                                    'pending' => 'Menunggu Pembayaran',
                                    'processing' => 'Diproses',
                                    'shipped' => 'Dikirim',
                                    'delivered' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                            @endphp

                            <div class="text-center py-6">
                                <div class="inline-block px-6 py-3 text-lg font-semibold rounded-full {{ $statusColors[$order->status] }}">
                                    {{ $statusLabels[$order->status] }}
                                </div>
                                <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                                    Pesanan dibuat pada {{ $order->created_at->format('d F Y, H:i') }}
                                </div>
                            </div>

                            <!-- Status Timeline -->
                            <div class="mt-6">
                                <div class="relative">
                                    @foreach(['pending', 'processing', 'shipped', 'delivered'] as $index => $status)
                                        <div class="flex items-center mb-4 last:mb-0">
                                            <div class="flex-shrink-0">
                                                @php
                                                    $statuses = ['pending', 'processing', 'shipped', 'delivered'];
                                                    $currentIndex = array_search($order->status, $statuses);
                                                    $thisIndex = array_search($status, $statuses);
                                                    $isComplete = $currentIndex >= $thisIndex;
                                                @endphp
                                                @if($isComplete)
                                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-check text-white text-sm"></i>
                                                    </div>
                                                @else
                                                    <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium {{ $isComplete ? 'text-gray-900 dark:text-white' : 'text-gray-400' }}">
                                                    {{ $statusLabels[$status] }}
                                                </div>
                                            </div>
                                        </div>
                                        @if($index < 3)
                                            <div class="w-0.5 h-4 bg-gray-300 ml-4"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Produk yang Dipesan</h3>
                            
                            <div class="space-y-4">
                                @foreach($order->orderItems as $item)
                                    <div class="flex items-center space-x-4 p-4 border rounded-lg">
                                        <img src="{{ $item->product->image ?? 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=150&h=150&fit=crop' }}" 
                                            alt="{{ $item->product_name }}" 
                                                class="w-20 h-20 object-cover rounded">
                                        <div class="flex-1">
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $item->product_name }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-lg font-bold text-gray-900 dark:text-white">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t mt-6 pt-6">
                                <div class="space-y-2">
                                    <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                        <span>Subtotal</span>
                                        <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                        <span>Ongkos Kirim</span>
                                        <span class="text-green-600 font-semibold">GRATIS</span>
                                    </div>
                                    <div class="border-t pt-2 flex justify-between text-xl font-bold">
                                        <span>Total</span>
                                        <span class="text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Alamat Pengiriman
                            </h3>
                            <div class="text-gray-700 dark:text-gray-300">
                                <div class="mb-2">{{ $order->shipping_address }}</div>
                                <div>{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</div>
                                <div class="mt-3">
                                    <i class="fas fa-phone mr-2 text-gray-400"></i>{{ $order->shipping_phone }}
                                </div>
                            </div>
                            @if($order->notes)
                                <div class="mt-4 p-3 bg-gray-50 dark:bg-slate-700 rounded">
                                    <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Catatan:</div>
                                    <div class="text-gray-600 dark:text-gray-400">{{ $order->notes }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Payment Info -->
                    <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg overflow-hidden mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Pembayaran</h3>
                            
                            @if($order->payment)
                                <div class="space-y-3">
                                    <div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">Metode Pembayaran</div>
                                        <div class="font-medium text-gray-900 dark:text-white">
                                            @if($order->payment->payment_method == 'bank_transfer')
                                                <i class="fas fa-university mr-2"></i>Transfer Bank
                                            @elseif($order->payment->payment_method == 'credit_card')
                                                <i class="fas fa-credit-card mr-2"></i>Kartu Kredit
                                            @else
                                                <i class="fas fa-wallet mr-2"></i>E-Wallet
                                            @endif
                                        </div>
                                    </div>

                                    <div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400">Status Pembayaran</div>
                                        <div>
                                            @if($order->payment->payment_status == 'paid')
                                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                                    <i class="fas fa-check-circle mr-1"></i>Sudah Dibayar
                                                </span>
                                            @elseif($order->payment->payment_status == 'pending')
                                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    <i class="fas fa-clock mr-1"></i>Menunggu Pembayaran
                                                </span>
                                            @else
                                                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                                    {{ ucfirst($order->payment->payment_status) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($order->payment->transaction_id)
                                        <div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">ID Transaksi</div>
                                            <div class="font-mono text-sm text-gray-900 dark:text-white">{{ $order->payment->transaction_id }}</div>
                                        </div>
                                    @endif

                                    @if($order->payment->paid_at)
                                        <div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">Dibayar Pada</div>
                                            <div class="text-gray-900 dark:text-white">{{ $order->payment->paid_at->format('d F Y, H:i') }}</div>
                                        </div>
                                    @endif
                                </div>

                                @if($order->payment->payment_status == 'pending')
                                    <form action="{{ route('checkout.confirm-payment', $order) }}" method="POST" class="mt-6">
                                        @csrf
                                        <button type="submit" 
                                            class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                            <i class="fas fa-check-circle mr-2"></i>Konfirmasi Pembayaran
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Butuh Bantuan?</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                Hubungi customer service kami jika ada pertanyaan
                            </p>
                            <div class="space-y-2">
                                <a href="https://wa.me/6281234567890" target="_blank"
                                    class="block w-full bg-green-600 text-white text-center py-2 rounded-lg hover:bg-green-700 transition-colors">
                                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                                </a>
                                <a href="mailto:support@healthfirstmedical.com"
                                    class="block w-full bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-envelope mr-2"></i>Email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

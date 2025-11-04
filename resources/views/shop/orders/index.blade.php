<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    @if($orders->count() > 0)
                        <div class="space-y-4">
                            @foreach($orders as $order)
                                <div class="border rounded-lg p-6 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <div class="text-sm text-gray-600">Nomor Pesanan</div>
                                            <div class="text-lg font-bold text-blue-600">{{ $order->order_number }}</div>
                                            <div class="text-sm text-gray-500">{{ $order->created_at->format('d F Y, H:i') }}</div>
                                        </div>
                                        <div class="text-right">
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
                                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$order->status] }}">
                                                {{ $statusLabels[$order->status] }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="border-t border-b py-4 mb-4">
                                        <div class="space-y-2">
                                            @foreach($order->orderItems->take(2) as $item)
                                                <div class="flex items-center space-x-3">
                                                    @if($item->product && $item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                            alt="{{ $item->product_name }}" 
                                                            class="w-12 h-12 object-cover rounded">
                                                    @else
                                                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                                            <i class="fas fa-image text-gray-400"></i>
                                                        </div>
                                                    @endif
                                                    <div class="flex-1">
                                                        <div class="font-medium text-gray-900">{{ $item->product_name }}</div>
                                                        <div class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if($order->orderItems->count() > 2)
                                                <div class="text-sm text-gray-500 text-center">
                                                    +{{ $order->orderItems->count() - 2 }} produk lainnya
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-sm text-gray-600">Total Pembayaran</div>
                                            <div class="text-xl font-bold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                            @if($order->payment)
                                                <div class="text-sm">
                                                    @if($order->payment->payment_status == 'paid')
                                                        <span class="text-green-600">
                                                            <i class="fas fa-check-circle mr-1"></i>Sudah Dibayar
                                                        </span>
                                                    @else
                                                        <span class="text-yellow-600">
                                                            <i class="fas fa-clock mr-1"></i>Belum Dibayar
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        <a href="{{ route('orders.show', $order) }}" 
                                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $orders->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <h3 class="text-2xl font-semibold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                            <p class="text-gray-600 mb-6">Anda belum pernah melakukan pemesanan</p>
                            <a href="{{ route('products.index') }}" 
                                class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                <i class="fas fa-shopping-bag mr-2"></i>Mulai Belanja
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

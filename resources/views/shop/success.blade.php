<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran Berhasil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-8">
                    <!-- Success Icon -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                            <i class="fas fa-check text-green-600 text-4xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Pesanan Berhasil Dibuat!</h2>
                        <p class="text-gray-600">Terima kasih telah berbelanja di toko kami</p>
                    </div>

                    <!-- Order Number -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                        <div class="text-center">
                            <div class="text-sm text-gray-600 mb-1">Nomor Pesanan</div>
                            <div class="text-2xl font-bold text-blue-600">{{ $order->order_number }}</div>
                            <div class="text-sm text-gray-600 mt-2">{{ $order->created_at->format('d F Y, H:i') }}</div>
                        </div>
                    </div>

                    <!-- Payment Instructions -->
                    <div class="border rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-credit-card mr-2 text-blue-600"></i>Instruksi Pembayaran
                        </h3>

                        @if($order->payment->payment_method == 'bank_transfer')
                            <div class="space-y-4">
                                <p class="text-gray-700">Silakan transfer ke salah satu rekening berikut:</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="border rounded p-4">
                                        <div class="font-semibold text-gray-900">Bank BCA</div>
                                        <div class="text-gray-600">1234567890</div>
                                        <div class="text-sm text-gray-500">a.n. HealthCare Store</div>
                                    </div>
                                    <div class="border rounded p-4">
                                        <div class="font-semibold text-gray-900">Bank Mandiri</div>
                                        <div class="text-gray-600">0987654321</div>
                                        <div class="text-sm text-gray-500">a.n. HealthCare Store</div>
                                    </div>
                                </div>

                                <div class="bg-yellow-50 border border-yellow-200 rounded p-4">
                                    <div class="font-semibold text-yellow-800 mb-2">Jumlah Transfer:</div>
                                    <div class="text-2xl font-bold text-yellow-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                    <div class="text-sm text-yellow-700 mt-2">
                                        <i class="fas fa-info-circle mr-1"></i>Transfer sesuai nominal untuk memudahkan verifikasi
                                    </div>
                                </div>
                            </div>
                        @elseif($order->payment->payment_method == 'credit_card')
                            <div class="text-center py-6">
                                <p class="text-gray-700 mb-4">Anda akan diarahkan ke halaman pembayaran kartu kredit</p>
                                <p class="text-sm text-gray-600">Ini adalah simulasi pembayaran</p>
                            </div>
                        @elseif($order->payment->payment_method == 'e_wallet')
                            <div class="text-center py-6">
                                <p class="text-gray-700 mb-4">Scan QR Code berikut untuk membayar:</p>
                                <div class="inline-block bg-gray-100 p-8 rounded">
                                    <i class="fas fa-qrcode text-8xl text-gray-400"></i>
                                </div>
                                <p class="text-sm text-gray-600 mt-4">Ini adalah simulasi pembayaran</p>
                            </div>
                        @endif
                    </div>

                    <!-- Order Items -->
                    <div class="border rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-box mr-2 text-blue-600"></i>Detail Pesanan
                        </h3>

                        <div class="space-y-3">
                            @foreach($order->orderItems as $item)
                                <div class="flex items-center justify-between py-2 border-b last:border-b-0">
                                    <div class="flex items-center space-x-4">
                                        <img src="https://via.placeholder.com/150x150/4F46E5/FFFFFF?text={{ urlencode($item->product->name) }}"
                                                alt="{{ $item->product_name }}" 
                                                class="w-12 h-12 object-cover rounded">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $item->product_name }}</div>
                                            <div class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                    <div class="font-semibold text-gray-900">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t mt-4 pt-4">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span class="text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Info -->
                    <div class="border rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Alamat Pengiriman
                        </h3>
                        <div class="text-gray-700">
                            <div class="mb-2">{{ $order->shipping_address }}</div>
                            <div>{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</div>
                            <div class="mt-2">
                                <i class="fas fa-phone mr-2 text-gray-400"></i>{{ $order->shipping_phone }}
                            </div>
                        </div>
                    </div>

                    <!-- Simulate Payment Button (For demo purposes) -->
                    @if($order->payment->payment_status == 'pending')
                        <form action="{{ route('checkout.confirm-payment', $order) }}" method="POST" class="mb-6">
                            @csrf
                            <button type="submit" 
                                class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                <i class="fas fa-check-circle mr-2"></i>Simulasi: Konfirmasi Pembayaran
                            </button>
                            <p class="text-center text-sm text-gray-500 mt-2">
                                * Ini adalah tombol simulasi untuk demo. Klik untuk mensimulasikan pembayaran berhasil.
                            </p>
                        </form>
                    @endif

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('orders.show', $order) }}" 
                            class="flex-1 bg-blue-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            <i class="fas fa-receipt mr-2"></i>Lihat Detail Pesanan
                        </a>
                        <a href="{{ route('products.index') }}" 
                            class="flex-1 bg-gray-200 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                            <i class="fas fa-shopping-bag mr-2"></i>Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Shipping Information -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Shipping Address -->
                        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Alamat Pengiriman
                                </h3>

                                <div class="space-y-4">
                                    <div>
                                        <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">
                                            Alamat Lengkap *
                                        </label>
                                        <textarea name="shipping_address" id="shipping_address" rows="3" required
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Jalan, nomor rumah, RT/RW">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-1">
                                                Kota *
                                            </label>
                                            <input type="text" name="shipping_city" id="shipping_city" required
                                                value="{{ old('shipping_city') }}"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="Nama kota">
                                        </div>

                                        <div>
                                            <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700 mb-1">
                                                Kode Pos *
                                            </label>
                                            <input type="text" name="shipping_postal_code" id="shipping_postal_code" required
                                                value="{{ old('shipping_postal_code') }}"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="12345">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="shipping_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                            Nomor Telepon *
                                        </label>
                                        <input type="tel" name="shipping_phone" id="shipping_phone" required
                                            value="{{ old('shipping_phone', auth()->user()->phone) }}"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="08123456789">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    <i class="fas fa-credit-card mr-2"></i>Metode Pembayaran
                                </h3>

                                <div class="space-y-3">
                                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="bank_transfer" required
                                            class="mr-3" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                                        <div class="flex items-center flex-1">
                                            <i class="fas fa-university text-blue-600 text-2xl mr-3"></i>
                                            <div>
                                                <div class="font-semibold">Transfer Bank</div>
                                                <div class="text-sm text-gray-600">BCA, BNI, Mandiri, BRI</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="credit_card" required
                                            class="mr-3" {{ old('payment_method') == 'credit_card' ? 'checked' : '' }}>
                                        <div class="flex items-center flex-1">
                                            <i class="fas fa-credit-card text-blue-600 text-2xl mr-3"></i>
                                            <div>
                                                <div class="font-semibold">Kartu Kredit/Debit</div>
                                                <div class="text-sm text-gray-600">Visa, Mastercard, JCB</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="e_wallet" required
                                            class="mr-3" {{ old('payment_method') == 'e_wallet' ? 'checked' : '' }}>
                                        <div class="flex items-center flex-1">
                                            <i class="fas fa-wallet text-blue-600 text-2xl mr-3"></i>
                                            <div>
                                                <div class="font-semibold">E-Wallet</div>
                                                <div class="text-sm text-gray-600">GoPay, OVO, Dana, ShopeePay</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="payment_method" value="qris" required
                                            class="mr-3" {{ old('payment_method') == 'qris' ? 'checked' : '' }}>
                                        <div class="flex items-center flex-1">
                                            <i class="fas fa-qrcode text-blue-600 text-2xl mr-3"></i>
                                            <div>
                                                <div class="font-semibold">QRIS</div>
                                                <div class="text-sm text-gray-600">Scan QR Code untuk Bayar</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Method -->
                        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    <i class="fas fa-shipping-fast mr-2"></i>Pilih Kurir Pengiriman
                                </h3>

                                <div class="space-y-3">
                                    <label class="flex items-center justify-between p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="jne_reg" required
                                                class="mr-3" {{ old('courier') == 'jne_reg' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">JNE Regular</div>
                                                <div class="text-sm text-gray-600">2-3 hari</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 15.000</div>
                                        </div>
                                    </label>

                                    <label class="flex items-center justify-between p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="jne_yes" required
                                                class="mr-3" {{ old('courier') == 'jne_yes' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">JNE YES</div>
                                                <div class="text-sm text-gray-600">1 hari</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 25.000</div>
                                        </div>
                                    </label>

                                    <label class="flex items-center justify-between p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="jnt_reg" required
                                                class="mr-3" {{ old('courier') == 'jnt_reg' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">J&T Regular</div>
                                                <div class="text-sm text-gray-600">2-3 hari</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 12.000</div>
                                        </div>
                                    </label>

                                    <label class="flex items-center justify-between p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="sicepat" required
                                                class="mr-3" {{ old('courier') == 'sicepat' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">SiCepat BEST</div>
                                                <div class="text-sm text-gray-600">2-3 hari</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 13.000</div>
                                        </div>
                                    </label>

                                    <label class="flex items-center justify-between p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="anteraja" required
                                                class="mr-3" {{ old('courier') == 'anteraja' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">AnterAja Regular</div>
                                                <div class="text-sm text-gray-600">2-4 hari</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 10.000</div>
                                        </div>
                                    </label>

                                    <label class="flex items-center justify-between p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="gosend" required
                                                class="mr-3" {{ old('courier') == 'gosend' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">GoSend Instant</div>
                                                <div class="text-sm text-gray-600">Same day</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 20.000</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    <i class="fas fa-sticky-note mr-2"></i>Catatan (Opsional)
                                </h3>
                                <textarea name="notes" id="notes" rows="3"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Catatan untuk penjual atau kurir...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden sticky top-4">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Pesanan</h3>

                                <!-- Products -->
                                <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                                    @foreach($cart->cartItems as $item)
                                        <div class="flex items-start space-x-3 text-sm">
                                            <img src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=150&h=150&fit=crop" 
                                                alt="{{ $item->product->name }}" 
                                                class="w-12 h-12 object-cover rounded">
                                            <div class="flex-1">
                                                <div class="font-medium text-gray-900">{{ $item->product->name }}</div>
                                                <div class="text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                            </div>
                                            <div class="font-semibold text-gray-900">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Price Breakdown -->
                                <div class="border-t pt-4 space-y-2">
                                    <div class="flex justify-between text-gray-600">
                                        <span>Subtotal ({{ $cart->itemsCount }} item)</span>
                                        <span>Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600">
                                        <span>Ongkos Kirim</span>
                                        <span id="shipping-cost">Rp 0</span>
                                    </div>
                                    <div class="border-t pt-2 flex justify-between text-lg font-bold">
                                        <span>Total Pembayaran</span>
                                        <span class="text-blue-600" id="total-amount">Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" 
                                    class="w-full mt-6 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-lock mr-2"></i>Proses Pembayaran
                                </button>

                                <div class="mt-4 text-center text-sm text-gray-600">
                                    <i class="fas fa-shield-alt text-green-600 mr-1"></i>
                                    Transaksi Anda Aman & Terpercaya
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Courier pricing
        const courierPricing = {
            'jne_reg': 15000,
            'jne_yes': 25000,
            'jnt_reg': 12000,
            'sicepat': 13000,
            'anteraja': 10000,
            'gosend': 20000
        };

        const subtotal = {{ $cart->total }};

        // Update shipping cost when courier is selected
        document.querySelectorAll('input[name="courier"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const shippingCost = courierPricing[this.value] || 0;
                const total = subtotal + shippingCost;

                // Update display
                document.getElementById('shipping-cost').textContent = 'Rp ' + shippingCost.toLocaleString('id-ID');
                document.getElementById('total-amount').textContent = 'Rp ' + total.toLocaleString('id-ID');
            });
        });
    </script>
</x-app-layout>

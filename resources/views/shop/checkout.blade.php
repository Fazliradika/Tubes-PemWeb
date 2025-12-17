<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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
                        <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Alamat Pengiriman
                                </h3>

                                <div class="space-y-4">
                                    <div>
                                        <label for="shipping_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Alamat Lengkap *
                                        </label>
                                        <textarea name="shipping_address" id="shipping_address" rows="3" required
                                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Jalan, nomor rumah, RT/RW">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="shipping_city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Kota *
                                            </label>
                                            <input type="text" name="shipping_city" id="shipping_city" required
                                                value="{{ old('shipping_city') }}"
                                                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="Nama kota">
                                        </div>

                                        <div>
                                            <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Kode Pos *
                                            </label>
                                            <input type="text" name="shipping_postal_code" id="shipping_postal_code" required
                                                value="{{ old('shipping_postal_code') }}"
                                                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="12345">
                                        </div>
                                    </div>

                                    <div>
                                        <label for="shipping_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Nomor Telepon *
                                        </label>
                                        <input type="tel" name="shipping_phone" id="shipping_phone" required
                                            value="{{ old('shipping_phone', auth()->user()->phone) }}"
                                            class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="08123456789">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    <i class="fas fa-credit-card mr-2"></i>Metode Pembayaran
                                </h3>

                                <div class="space-y-3">
                                    <label class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <input type="radio" name="payment_method" value="bank_transfer" required
                                            class="mr-3" {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}>
                                        <div class="flex items-center flex-1">
                                            <i class="fas fa-university text-blue-600 text-2xl mr-3"></i>
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">Transfer Bank</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400">BCA, BNI, Mandiri, BRI</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <input type="radio" name="payment_method" value="credit_card" required
                                            class="mr-3" {{ old('payment_method') == 'credit_card' ? 'checked' : '' }}>
                                        <div class="flex items-center flex-1">
                                            <i class="fas fa-credit-card text-blue-600 text-2xl mr-3"></i>
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">Kartu Kredit/Debit</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400">Visa, Mastercard, JCB</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <input type="radio" name="payment_method" value="e_wallet" required
                                            class="mr-3" {{ old('payment_method') == 'e_wallet' ? 'checked' : '' }}>
                                        <div class="flex items-center flex-1">
                                            <i class="fas fa-wallet text-blue-600 text-2xl mr-3"></i>
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">E-Wallet</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400">GoPay, OVO, Dana, ShopeePay</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <input type="radio" name="payment_method" value="qris" required
                                            class="mr-3" {{ old('payment_method') == 'qris' ? 'checked' : '' }}
                                            onchange="toggleQrisCode()">
                                        <div class="flex items-center flex-1">
                                            <i class="fas fa-qrcode text-blue-600 text-2xl mr-3"></i>
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">QRIS</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400">Scan QR Code untuk Bayar</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                <!-- QRIS QR Code Display (Hidden by default) -->
                                <div id="qrisCodeSection" class="hidden mt-6 p-6 bg-blue-50 border-2 border-blue-200 rounded-lg">
                                    <div class="text-center">
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                            <i class="fas fa-qrcode mr-2 text-blue-600"></i>Scan QRIS untuk Bayar
                                        </h4>
                                        
                                        <div class="inline-block bg-white border-4 border-gray-800 p-4 rounded-lg shadow-lg mb-4">
                                            <img id="qrisImage" 
                                                 src="" 
                                                 alt="QRIS Code" 
                                                 class="w-64 h-64">
                                        </div>
                                        
                                        <div class="bg-white dark:bg-slate-700 border border-blue-300 dark:border-slate-600 rounded-lg p-4 max-w-md mx-auto">
                                            <div class="font-semibold text-blue-800 dark:text-blue-300 mb-2">Total Pembayaran:</div>
                                            <div id="qrisTotal" class="text-3xl font-bold text-blue-900 dark:text-blue-200"></div>
                                            <div class="text-sm text-blue-700 dark:text-blue-300 mt-3">
                                                <i class="fas fa-mobile-alt mr-1"></i>Gunakan aplikasi e-wallet (GoPay, OVO, Dana, ShopeePay, dll)
                                            </div>
                                        </div>
                                        
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-4">
                                            <i class="fas fa-shield-alt mr-1"></i>Pembayaran aman dengan QRIS Indonesia
                                        </p>
                                        
                                        <p class="text-xs text-gray-500 mt-2">
                                            Setelah scan, lanjutkan checkout untuk menyelesaikan pesanan
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Method -->
                        <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    <i class="fas fa-shipping-fast mr-2"></i>Pilih Pengiriman Instant
                                </h3>

                                <div class="space-y-3">
                                    <label class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="gosend_instant" required
                                                class="mr-3" {{ old('courier') == 'gosend_instant' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">GoSend Instant</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400">15-30 menit</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 20.000</div>
                                        </div>
                                    </label>

                                    <label class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="gosend_sameday" required
                                                class="mr-3" {{ old('courier') == 'gosend_sameday' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">GoSend Same Day</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400">40-60 menit</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 12.000</div>
                                        </div>
                                    </label>

                                    <label class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="grabexpress_instant" required
                                                class="mr-3" {{ old('courier') == 'grabexpress_instant' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">GrabExpress Instant</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400">15-30 menit</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 22.000</div>
                                        </div>
                                    </label>

                                    <label class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="grabexpress_sameday" required
                                                class="mr-3" {{ old('courier') == 'grabexpress_sameday' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">GrabExpress Same Day</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400">40-60 menit</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 13.000</div>
                                        </div>
                                    </label>

                                    <label class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="jne_instant" required
                                                class="mr-3" {{ old('courier') == 'jne_instant' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">JNE Instant</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400">15-30 menit</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 25.000</div>
                                        </div>
                                    </label>

                                    <label class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="anteraja_instant" required
                                                class="mr-3" {{ old('courier') == 'anteraja_instant' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">AnterAja Instant</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400">15-30 menit</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 18.000</div>
                                        </div>
                                    </label>

                                    <label class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <div class="flex items-center">
                                            <input type="radio" name="courier" value="anteraja_sameday" required
                                                class="mr-3" {{ old('courier') == 'anteraja_sameday' ? 'checked' : '' }}>
                                            <div>
                                                <div class="font-semibold">AnterAja Same Day</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-400">40-60 menit</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-semibold text-blue-600">Rp 10.000</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
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
                        <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg overflow-hidden sticky top-4">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Ringkasan Pesanan</h3>

                                <!-- Products -->
                                <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                                    @if($buyNow)
                                        {{-- Buy Now Mode - Single Product --}}
                                        <div class="flex items-start space-x-3 text-sm">
                                            <img src="{{ $buyNow['image'] ?: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=150&h=150&fit=crop' }}" 
                                                alt="{{ $buyNow['product_name'] }}" 
                                                class="w-12 h-12 object-cover rounded">
                                            <div class="flex-1">
                                                <div class="font-medium text-gray-900 dark:text-white">{{ $buyNow['product_name'] }}</div>
                                                <div class="text-gray-600 dark:text-gray-400">{{ $buyNow['quantity'] }} x Rp {{ number_format($buyNow['price'], 0, ',', '.') }}</div>
                                            </div>
                                            <div class="font-semibold text-gray-900 dark:text-white">
                                                Rp {{ number_format($buyNow['price'] * $buyNow['quantity'], 0, ',', '.') }}
                                            </div>
                                        </div>
                                    @else
                                        {{-- Cart Mode - Multiple Products --}}
                                        @foreach($cart->cartItems as $item)
                                            <div class="flex items-start space-x-3 text-sm">
                                                <img src="{{ $item->product->image ?: 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=150&h=150&fit=crop' }}" 
                                                    alt="{{ $item->product->name }}" 
                                                    class="w-12 h-12 object-cover rounded">
                                                <div class="flex-1">
                                                    <div class="font-medium text-gray-900 dark:text-white">{{ $item->product->name }}</div>
                                                    <div class="text-gray-600 dark:text-gray-400">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                                </div>
                                                <div class="font-semibold text-gray-900 dark:text-white">
                                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Price Breakdown -->
                                <div class="border-t pt-4 space-y-2">
                                    <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                        <span>Subtotal ({{ $buyNow ? $buyNow['quantity'] : $cart->itemsCount }} item)</span>
                                        <span>Rp {{ number_format($buyNow ? ($buyNow['price'] * $buyNow['quantity']) : $cart->total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                        <span>Ongkos Kirim</span>
                                        <span id="shipping-cost">Rp 0</span>
                                    </div>
                                    <div class="border-t pt-2 flex justify-between text-lg font-bold">
                                        <span>Total Pembayaran</span>
                                        <span class="text-blue-600" id="total-amount">Rp {{ number_format($buyNow ? ($buyNow['price'] * $buyNow['quantity']) : $cart->total, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" 
                                    class="w-full mt-6 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-lock mr-2"></i>Proses Pembayaran
                                </button>

                                <div class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
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
        // Courier pricing (instant 15-30 min vs same day 40-60 min)
        const courierPricing = {
            'gosend_instant': 20000,
            'gosend_sameday': 12000,
            'grabexpress_instant': 22000,
            'grabexpress_sameday': 13000,
            'jne_instant': 25000,
            'anteraja_instant': 18000,
            'anteraja_sameday': 10000
        };

        const subtotal = {{ $buyNow ? ($buyNow['price'] * $buyNow['quantity']) : $cart->total }};
        let currentTotal = subtotal;

        // Update shipping cost when courier is selected
        document.querySelectorAll('input[name="courier"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const shippingCost = courierPricing[this.value] || 0;
                currentTotal = subtotal + shippingCost;

                // Update display
                document.getElementById('shipping-cost').textContent = 'Rp ' + shippingCost.toLocaleString('id-ID');
                document.getElementById('total-amount').textContent = 'Rp ' + currentTotal.toLocaleString('id-ID');
                
                // Update QRIS total if visible
                updateQrisTotal();
            });
        });

        // Toggle QRIS QR Code display
        function toggleQrisCode() {
            const qrisRadio = document.querySelector('input[name="payment_method"][value="qris"]');
            const qrisSection = document.getElementById('qrisCodeSection');
            
            if (qrisRadio && qrisRadio.checked) {
                qrisSection.classList.remove('hidden');
                updateQrisCode();
            } else {
                qrisSection.classList.add('hidden');
            }
        }

        // Update QRIS QR Code
        function updateQrisCode() {
            const orderNumber = 'ORD-' + Date.now();
            const qrisData = `00020101021226670016COM.NOBUBANK.WWW01189360050300000898740214${orderNumber}0303UMI51440014ID.CO.QRIS.WWW0215ID10232995167140303UMI5204481253033605802ID5917HealthFirst Medical6007Jakarta61051234062070703A0163044C7D`;
            
            const qrisImage = document.getElementById('qrisImage');
            qrisImage.src = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(qrisData)}`;
            
            updateQrisTotal();
        }

        // Update QRIS total amount display
        function updateQrisTotal() {
            const qrisTotal = document.getElementById('qrisTotal');
            if (qrisTotal) {
                qrisTotal.textContent = 'Rp ' + currentTotal.toLocaleString('id-ID');
            }
        }

        // Add event listeners to all payment method radios
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', toggleQrisCode);
        });

        // Check on page load if QRIS was selected (from old() values)
        window.addEventListener('DOMContentLoaded', function() {
            const qrisRadio = document.querySelector('input[name="payment_method"][value="qris"]');
            if (qrisRadio && qrisRadio.checked) {
                toggleQrisCode();
            }
        });
    </script>
</x-app-layout>

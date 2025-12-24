<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show checkout form.
     */
    public function index()
    {
        // Check if this is a "buy now" checkout
        if (session()->has('buy_now')) {
            $buyNowData = session()->get('buy_now');
            return view('shop.checkout', [
                'cart' => null,
                'buyNow' => $buyNowData
            ]);
        }

        // Regular cart checkout
        $cart = Cart::where('user_id', Auth::id())->with('cartItems.product')->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }

        return view('shop.checkout', [
            'cart' => $cart,
            'buyNow' => null
        ]);
    }

    /**
     * Process checkout.
     */
    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_postal_code' => 'required|string',
            'shipping_phone' => 'required|string',
            'payment_method' => 'required|in:bank_transfer,credit_card,e_wallet,qris',
            'courier' => 'required|string',
            'shipping_cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'buy_now_quantity' => 'nullable|integer|min:1',
        ]);

        // Check if this is a Buy Now checkout
        if (session()->has('buy_now')) {
            return $this->processBuyNow($request);
        }

        // Regular cart checkout
        $cart = Cart::where('user_id', Auth::id())->with('cartItems.product')->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }

        // Check stock availability
        foreach ($cart->cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->with('error', "Stok {$item->product->name} tidak mencukupi");
            }
        }

        DB::beginTransaction();
        try {
            // Get shipping cost from request
            $shippingCost = $request->input('shipping_cost', 0);
            $totalWithShipping = $cart->total + $shippingCost;

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalWithShipping,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_postal_code' => $request->shipping_postal_code,
                'shipping_phone' => $request->shipping_phone,
                'courier' => $request->courier,
                'shipping_cost' => $shippingCost,
                'notes' => $request->notes,
            ]);

            // Create order items and update stock
            foreach ($cart->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);

                // Update product stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'amount' => $totalWithShipping,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            // Clear cart
            $cart->cartItems()->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Process Buy Now checkout
     */
    private function processBuyNow(Request $request)
    {
        $buyNowData = session()->get('buy_now');
        $quantity = $request->input('buy_now_quantity', $buyNowData['quantity']);

        // Validate stock
        $product = \App\Models\Product::findOrFail($buyNowData['product_id']);
        if ($quantity > $product->stock) {
            return back()->with('error', "Stok {$product->name} tidak mencukupi. Maksimal {$product->stock} item");
        }

        DB::beginTransaction();
        try {
            $subtotal = $product->price * $quantity;
            $shippingCost = $request->input('shipping_cost', 0);
            $totalAmount = $subtotal + $shippingCost;

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_postal_code' => $request->shipping_postal_code,
                'shipping_phone' => $request->shipping_phone,
                'courier' => $request->courier,
                'shipping_cost' => $shippingCost,
                'notes' => $request->notes,
            ]);

            // Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);

            // Update product stock
            $product->decrement('stock', $quantity);

            // Create payment record
            Payment::create([
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            // Clear buy_now session
            session()->forget('buy_now');

            DB::commit();

            return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show success page.
     */
    public function success(Order $order)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Allow owner or admin to view
        if ($order->user_id !== Auth::id() && !$user->isAdmin()) {
            abort(403);
        }

        $order->load(['orderItems.product', 'payment']);

        return view('shop.success', compact('order'));
    }

    /**
     * Simulate payment confirmation.
     */
    public function confirmPayment(Request $request, Order $order)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Allow owner or admin to confirm payment
        if ($order->user_id !== Auth::id() && !$user->isAdmin()) {
            abort(403);
        }

        // Validate payment proof upload
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048', // max 2MB
        ], [
            'payment_proof.required' => 'Bukti pembayaran harus diupload',
            'payment_proof.image' => 'File harus berupa gambar',
            'payment_proof.mimes' => 'Format gambar harus jpeg, jpg, png, atau gif',
            'payment_proof.max' => 'Ukuran file maksimal 2MB',
        ]);

        $payment = $order->payment;

        // Handle file upload
        $paymentProofPath = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = 'payment_' . $order->order_number . '_' . time() . '.' . $file->getClientOriginalExtension();
            $paymentProofPath = $file->storeAs('payment_proofs', $filename, 'public');
        }

        $payment->update([
            'payment_status' => 'paid',
            'transaction_id' => 'TRX-' . strtoupper(uniqid()),
            'payment_proof' => $paymentProofPath,
            'paid_at' => now(),
        ]);

        $order->update(['status' => 'processing']);

        return redirect()->route('orders.show', $order->id)->with('success', 'Pembayaran berhasil dikonfirmasi');
    }
}

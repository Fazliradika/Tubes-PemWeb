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
            'notes' => 'nullable|string',
        ]);

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
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $cart->total,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_postal_code' => $request->shipping_postal_code,
                'shipping_phone' => $request->shipping_phone,
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
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'amount' => $cart->total,
            ]);

            // Clear cart
            $cart->cartItems()->delete();

            DB::commit();

            return redirect()->route('checkout.success', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan');
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

        $payment = $order->payment;
        $payment->update([
            'payment_status' => 'paid',
            'transaction_id' => 'TRX-' . strtoupper(uniqid()),
            'paid_at' => now(),
        ]);

        $order->update(['status' => 'processing']);

        return redirect()->route('orders.show', $order->id)->with('success', 'Pembayaran berhasil dikonfirmasi');
    }
}

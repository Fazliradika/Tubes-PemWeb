<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of user's orders.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['orderItems.product', 'payment'])
            ->latest()
            ->paginate(10);

        return view('shop.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if ($order->user_id !== Auth::id() && !$user->isAdmin()) {
            abort(403);
        }

        $order->load(['orderItems.product', 'payment']);

        return view('shop.orders.show', compact('order'));
    }

    /**
     * Admin: Display all orders.
     */
    public function adminIndex(Request $request)
    {
        $query = Order::with(['user', 'orderItems', 'payment']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Admin: Update order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diupdate');
    }
}

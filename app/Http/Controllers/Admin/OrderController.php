<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('product');

        return view('admin.orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        if ($order->payment_proof) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        $order->delete();

        return redirect()->route('admin.orders.index')->with([
            'message' => 'Order deleted successfully.',
            'alert-type' => 'success',
        ]);
    }
}

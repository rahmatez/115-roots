<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function store(OrderRequest $request, Product $product)
    {
        if (! $product->is_published) {
            abort(404);
        }

        $paymentProof = $request->file('payment_proof')->store('orders/payment-proofs', 'public');

        Order::create([
            'product_id' => $product->id,
            'customer_name' => $request->customer_name,
            'customer_address' => $request->customer_address,
            'customer_phone' => $request->customer_phone,
            'payment_proof' => $paymentProof,
        ]);

        return redirect()
            ->route('shop.show', $product->slug)
            ->with('message', 'Order submitted successfully! Our team will process your order soon.');
    }
}

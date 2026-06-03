<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::published()->ordered()->get();

        return view('shop.index', compact('products'));
    }

    public function show(Product $product)
    {
        if (! $product->is_published) {
            abort(404);
        }

        return view('shop.show', compact('product'));
    }
}

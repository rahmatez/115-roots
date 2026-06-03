<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Support\SlugGenerator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::ordered()->paginate(12);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(ProductRequest $request)
    {
        $image = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'slug' => SlugGenerator::unique($request->name, Product::class),
            'category' => $request->category,
            'price' => $request->price,
            'currency' => $request->input('currency', 'IDR'),
            'image' => $image,
            'external_url' => $request->external_url,
            'description' => $request->description,
            'sort_order' => $request->input('sort_order', 0),
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.products.index')->with([
            'message' => 'Product created!',
            'alert-type' => 'success',
        ]);
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = [
            'name' => $request->name,
            'slug' => SlugGenerator::unique($request->name, Product::class, $product->id),
            'category' => $request->category,
            'price' => $request->price,
            'currency' => $request->input('currency', 'IDR'),
            'external_url' => $request->external_url,
            'description' => $request->description,
            'sort_order' => $request->input('sort_order', 0),
            'is_published' => $request->boolean('is_published', true),
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with([
            'message' => 'Product updated!',
            'alert-type' => 'info',
        ]);
    }

    public function destroy(Product $product)
    {
        if (! str_starts_with($product->image, 'frontend/')) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->back()->with([
            'message' => 'Product deleted!',
            'alert-type' => 'danger',
        ]);
    }
}

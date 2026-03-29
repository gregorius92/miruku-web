<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                => 'required|string|max:255',
            'name_en'             => 'nullable|string|max:255',
            'description'         => 'nullable|string',
            'description_en'      => 'nullable|string',
            'body'                => 'nullable|string',
            'body_en'             => 'nullable|string',
            'price'               => 'required|numeric|min:0',
            'variant'             => 'required|in:original,chocolate,banana',
            'stock'               => 'required|integer|min:0',
            'meta_title'          => 'nullable|string|max:255',
            'meta_title_en'       => 'nullable|string|max:255',
            'meta_description'    => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'                => 'required|string|max:255',
            'name_en'             => 'nullable|string|max:255',
            'description'         => 'nullable|string',
            'description_en'      => 'nullable|string',
            'body'                => 'nullable|string',
            'body_en'             => 'nullable|string',
            'price'               => 'required|numeric|min:0',
            'variant'             => 'required|in:original,chocolate,banana',
            'stock'               => 'required|integer|min:0',
            'meta_title'          => 'nullable|string|max:255',
            'meta_title_en'       => 'nullable|string|max:255',
            'meta_description'    => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }
}

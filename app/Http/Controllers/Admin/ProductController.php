<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\UploadService;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['variantInfo', 'unitInfo'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(15)->withQueryString();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $variants = Variant::where('is_active', true)->get();
        $units = ProductUnit::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.products.create', compact('variants', 'units'));
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
            'unit'                => 'required|exists:product_units,slug',
            'variant'             => 'required|exists:variants,slug',
            'meta_title'          => 'nullable|string|max:255',
            'meta_title_en'       => 'nullable|string|max:255',
            'meta_description'    => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'marketplaces'        => 'nullable|array',
            'marketplaces.*.name' => 'required|string|max:255',
            'marketplaces.*.url'  => 'required|url',
            'marketplaces.*.color'=> 'required|string|max:50',
            'benefits'            => 'nullable|array',
            'benefits.*'          => 'required|string|max:255',
            'benefits_en'         => 'nullable|array',
            'benefits_en.*'       => 'required|string|max:255',
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');
        $data['show_on_home'] = $request->has('show_on_home');
        $data['is_best_seller'] = $request->has('is_best_seller');

        if ($request->hasFile('image')) {
            $data['image'] = UploadService::upload($request->file('image'), 'products');
        }

        $product = Product::create($data);

        if ($request->has('marketplaces')) {
            foreach ($request->marketplaces as $mp) {
                $product->marketplaces()->create($mp);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $product->load('marketplaces');
        $variants = Variant::where('is_active', true)->get();
        $units = ProductUnit::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.products.edit', compact('product', 'variants', 'units'));
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
            'unit'                => 'required|exists:product_units,slug',
            'variant'             => 'required|exists:variants,slug',
            'meta_title'          => 'nullable|string|max:255',
            'meta_title_en'       => 'nullable|string|max:255',
            'meta_description'    => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'marketplaces'        => 'nullable|array',
            'marketplaces.*.name' => 'required|string|max:255',
            'marketplaces.*.url'  => 'required|url',
            'marketplaces.*.color'=> 'required|string|max:50',
            'benefits'            => 'nullable|array',
            'benefits.*'          => 'required|string|max:255',
            'benefits_en'         => 'nullable|array',
            'benefits_en.*'       => 'required|string|max:255',
        ]);

        $data['slug'] = Str::slug($request->name);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');
        $data['show_on_home'] = $request->has('show_on_home');
        $data['is_best_seller'] = $request->has('is_best_seller');

        if ($request->hasFile('image')) {
            $data['image'] = UploadService::upload($request->file('image'), 'products');
        }

        $product->update($data);

        $product->marketplaces()->delete();
        if ($request->has('marketplaces')) {
            foreach ($request->marketplaces as $mp) {
                $product->marketplaces()->create($mp);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }
}

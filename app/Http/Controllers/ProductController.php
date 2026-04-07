<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\Variant;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $units = ProductUnit::where('is_active', true)->orderBy('sort_order')->get();
        $variants = Variant::where('is_active', true)->get();
        $products = Product::active()
            ->with(['variantInfo', 'unitInfo'])
            ->when($request->unit, fn($q) => $q->where('unit', $request->unit))
            ->latest()
            ->paginate(12);

        $seo = [
            'title'       => __('products.seo_index_title'),
            'description' => __('products.seo_index_description'),
            'keywords'    => __('products.seo_index_keywords'),
        ];

        if ($request->ajax()) {
            return view('products._product_list', compact('products'));
        }

        return view('products.index', compact('products', 'seo', 'units', 'variants'));
    }

    public function show($slug)
    {
        $product = Product::active()->where('slug', $slug)->firstOrFail();
        $reviews = $product->approvedReviews()->latest()->get();
        $related = Product::active()
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        $seo = [
            'title'       => $product->meta_title ?: $product->name . ' – Miruku',
            'description' => $product->meta_description ?: $product->description,
            'keywords'    => "miruku {$product->variant}, susu lactose free {$product->variant}, " . Setting::get('meta_keywords', ''),
        ];

        return view('products.show', compact('product', 'reviews', 'related', 'seo'));
    }
}

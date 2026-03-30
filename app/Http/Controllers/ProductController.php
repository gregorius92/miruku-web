<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::active()
            ->when($request->variant, fn($q) => $q->where('variant', $request->variant))
            ->latest()
            ->paginate(9);

        $seo = [
            'title'       => __('products.seo_index_title'),
            'description' => __('products.seo_index_description'),
            'keywords'    => __('products.seo_index_keywords'),
        ];

        return view('products.index', compact('products', 'seo'));
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

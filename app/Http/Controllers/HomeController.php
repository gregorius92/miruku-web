<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Product;
use App\Models\Review;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Post;
use App\Models\StoreLocation;
use App\Models\ProductUnit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $carousels = Carousel::active()->get();
        $units = ProductUnit::where('is_active', true)->orderBy('sort_order')->get();
        
        $products = Product::active()
            ->with(['variantInfo', 'unitInfo'])
            ->where('show_on_home', true)
            ->when($request->unit, function($query) use ($request) {
                return $query->where('unit', $request->unit);
            })
            ->orderBy('is_featured', 'desc')
            ->take(3)
            ->get();
            
        $reviews = Review::approved()->latest()->take(8)->get();
        $stores = StoreLocation::active()->get();
        $cities = StoreLocation::active()->distinct()->pluck('city');
        $posts = Post::active()->latest()->take(3)->get();

        $sections = [
            'about'    => Section::where('section_name', 'about')->with('features')->first(),
            'benefits' => Section::getByName('benefits'),
            'cta'      => Section::getByName('cta'),
        ];

        $seo = [
            'title'       => Setting::get('meta_title', 'Miruku – Susu Lactose-Free Premium Indonesia'),
            'description' => Setting::get('meta_description', 'Susu lactose-free premium terbaik di Indonesia.'),
            'keywords'    => Setting::get('meta_keywords', 'susu lactose free, susu sehat, miruku'),
        ];

        return view('home', compact('carousels', 'products', 'reviews', 'stores', 'cities', 'sections', 'seo', 'posts', 'units'));
    }

    public function benefits()
    {
        $seo = [
            'title'       => __('benefits.seo_title'),
            'description' => __('benefits.seo_description'),
            'keywords'    => __('benefits.seo_keywords'),
        ];
        return view('benefits', compact('seo'));
    }

    public function about()
    {
        $seo = [
            'title'       => __('about.seo_title'),
            'description' => __('about.seo_description'),
            'keywords'    => __('about.seo_keywords'),
        ];
        return view('about', compact('seo'));
    }
}

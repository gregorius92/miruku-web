<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Product;
use App\Models\Review;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Post;
use App\Models\StoreLocation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $carousels = Carousel::active()->get();
        $products = Product::active()->orderBy('is_featured', 'desc')->get();
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

        return view('home', compact('carousels', 'products', 'reviews', 'stores', 'cities', 'sections', 'seo', 'posts'));
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

<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Product;
use App\Models\Review;
use App\Models\Section;
use App\Models\Setting;
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

        return view('home', compact('carousels', 'products', 'reviews', 'stores', 'cities', 'sections', 'seo'));
    }

    public function benefits()
    {
        $seo = [
            'title'       => 'Manfaat Susu Lactose-Free | Miruku',
            'description' => 'Pelajari manfaat susu lactose-free dan mengapa Miruku adalah pilihan terbaik untuk kesehatan Anda dan keluarga.',
            'keywords'    => 'manfaat susu lactose free, susu sehat, lactose intolerance',
        ];
        return view('benefits', compact('seo'));
    }

    public function about()
    {
        $seo = [
            'title'       => 'Tentang Miruku | Susu Lactose-Free Premium',
            'description' => 'Pelajari kisah di balik Miruku, brand susu lactose-free premium asal Indonesia yang hadir untuk mewujudkan gaya hidup sehat.',
            'keywords'    => 'tentang miruku, susu lactose free indonesia',
        ];
        return view('about', compact('seo'));
    }
}

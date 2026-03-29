<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\Carousel;
use App\Models\StoreLocation;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'active_products' => Product::active()->count(),
            'total_reviews' => Review::count(),
            'pending_reviews' => Review::pending()->count(),
            'approved_reviews' => Review::approved()->count(),
            'total_stores' => StoreLocation::count(),
            'active_carousels' => Carousel::where('is_active', true)->count(),
        ];

        $recentReviews = Review::pending()->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentReviews'));
    }
}

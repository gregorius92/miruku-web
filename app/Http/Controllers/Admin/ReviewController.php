<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = Review::with('product')
            ->when($request->status === 'pending', fn($q) => $q->pending())
            ->when($request->status === 'approved', fn($q) => $q->approved())
            ->latest()
            ->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve(Review $review)
    {
        $review->update(['approved' => true]);
        return back()->with('success', 'Review berhasil disetujui!');
    }

    public function reject(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review berhasil dihapus!');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review berhasil dihapus!');
    }
}

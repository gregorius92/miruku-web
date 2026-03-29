<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'nullable|email|max:150',
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        Review::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
            'product_id' => $request->product_id ?? null,
            'approved'   => false,
        ]);

        return back()->with('success', 'Terima kasih! Review kamu akan ditampilkan setelah diverifikasi oleh tim kami.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'nullable|email|max:150',
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:3|max:1000',

        ]);

        $commentEn = $request->comment; // Default to original comment
        try {
            $tr = new GoogleTranslate('en', 'id');
            $commentEn = $tr->translate($request->comment) ?? $request->comment;
        } catch (\Exception $e) {
            Log::error('Review auto-translation failed: ' . $e->getMessage());
        }


        Review::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
            'comment_en' => $commentEn,
            'product_id' => $request->product_id ?? null,
            'approved'   => false,
        ]);

        if ($request->ajax() || $request->wantsJson()) {

            return response()->json([
                'success' => true,
                'message' => __('home.review_success'),
                'review'  => [
                    'name'       => $request->name,
                    'rating'     => $request->rating,
                    'comment'    => app()->getLocale() === 'en' ? ($commentEn ?? $request->comment) : $request->comment,
                ]

            ]);
        }

        return back()->with('success', __('home.review_success'));


    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::active();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('title_en', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('content_en', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest()->paginate(9)->withQueryString();
        
        $seo = [
            'title'       => Setting::get('blog_meta_title', 'Artikel — Miruku'),
            'description' => Setting::get('blog_meta_description', 'Baca artikel terbaru dari Miruku tentang kesehatan dan susu lactose-free.'),
            'keywords'    => Setting::get('blog_meta_keywords', 'artikel, susu lactose free, miruku'),
        ];

        if ($request->ajax()) {
            return view('articles._article_list', compact('posts'));
        }

        return view('articles.index', compact('posts', 'seo'));
    }

    public function show(Post $post)
    {
        if (!$post->is_active) {
            abort(404);
        }

        $post->increment('view_count');

        $seo = [
            'title'       => $post->meta_title ?: $post->title . ' — Miruku',
            'description' => $post->meta_description ?: Str::limit(strip_tags($post->content), 160),
            'keywords'    => Setting::get('meta_keywords', 'susu lactose free, susu sehat, miruku'),
        ];

        $relatedPosts = Post::active()
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('articles.show', compact('post', 'seo', 'relatedPosts'));
    }
}

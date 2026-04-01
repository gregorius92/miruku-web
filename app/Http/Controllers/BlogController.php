<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::active()->latest()->paginate(9);
        
        $seo = [
            'title'       => Setting::get('blog_meta_title', 'Blog & Artikel — Miruku'),
            'description' => Setting::get('blog_meta_description', 'Baca artikel terbaru dari Miruku tentang kesehatan dan susu lactose-free.'),
            'keywords'    => Setting::get('blog_meta_keywords', 'blog, artikel, susu lactose free, miruku'),
        ];

        return view('blog.index', compact('posts', 'seo'));
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

        return view('blog.show', compact('post', 'seo', 'relatedPosts'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Services\UploadService;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(15);
        return view('admin.articles.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'               => 'required|string|max:255',
            'title_en'            => 'nullable|string|max:255',
            'content'             => 'required|string',
            'content_en'          => 'nullable|string',
            'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title'          => 'nullable|string|max:255',
            'meta_title_en'       => 'nullable|string|max:255',
            'meta_description'    => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'published_at'        => 'nullable|date',
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');
        $data['published_at'] = $request->published_at ?? now();

        if ($request->hasFile('image')) {
            $data['image'] = UploadService::upload($request->file('image'), 'posts');
        }

        Post::create($data);
        return redirect()->route('admin.articles.index')->with('success', __('admin.posts.created_success'));
    }

    public function edit(Post $post)
    {
        return view('admin.articles.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title'               => 'required|string|max:255',
            'title_en'            => 'nullable|string|max:255',
            'content'             => 'required|string',
            'content_en'          => 'nullable|string',
            'image'               => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_title'          => 'nullable|string|max:255',
            'meta_title_en'       => 'nullable|string|max:255',
            'meta_description'    => 'nullable|string',
            'meta_description_en' => 'nullable|string',
            'published_at'        => 'nullable|date',
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');
        $data['published_at'] = $request->published_at ?? $post->published_at ?? now();

        if ($request->hasFile('image')) {
            $data['image'] = UploadService::upload($request->file('image'), 'posts');
        }

        $post->update($data);
        return redirect()->route('admin.articles.index')->with('success', __('admin.posts.updated_success'));
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', __('admin.posts.deleted_success'));
    }
}

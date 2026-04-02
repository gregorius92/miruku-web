@extends('layouts.admin')
@section('title', __('admin.posts.edit'))

@section('admin-content')
<div class="w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.posts.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">{{ __('admin.posts.edit') }}</h1>
    </div>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-6">
        @csrf
        @method('PUT')
        <div class="grid sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('admin.posts.fields.title') }} (ID) *</label>
                <input type="text" name="title" id="title_id" value="{{ old('title', $post->title) }}" required translate="no" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue focus:ring-2 focus:ring-blue-50" placeholder="Judul artikel...">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    {{ __('admin.posts.fields.title') }} (EN)
                </label>
                <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $post->title_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Article title in English">
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-6">
            <div class="sm:col-span-1">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('admin.posts.fields.image') }}</label>
                @if($post->image)
                <div class="mb-3">
                    <img src="{{ $post->image_url }}" alt="" class="w-32 h-20 object-cover rounded-xl border border-gray-100">
                </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue file:mr-3 file:text-xs file:font-medium file:bg-blue-50 file:text-miruku-blue file:border-0 file:rounded-lg file:px-3 file:py-1.5">
                <p class="text-[10px] text-gray-400 mt-1 italic">*Biarkan kosong jika tidak ingin mengubah gambar</p>
            </div>
            <div class="sm:col-span-1">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('admin.posts.fields.published_at') }}</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ __('admin.posts.fields.content') }} (ID) *</label>
                <textarea name="content" id="content_id" rows="10" translate="no" class="editor w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-y">{{ old('content', $post->content) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    {{ __('admin.posts.fields.content') }} (EN)
                </label>
                <textarea name="content_en" id="content_en" rows="10" class="editor w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-y">{{ old('content_en', $post->content_en) }}</textarea>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">SEO Settings</h3>
            <div class="grid sm:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-1">Meta Title (ID)</label>
                        <input type="text" name="meta_title" id="meta_t_id" value="{{ old('meta_title', $post->meta_title) }}" translate="no" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Meta Title">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-1">Meta Description (ID)</label>
                        <textarea name="meta_description" id="meta_d_id" rows="2" translate="no" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Meta Description">{{ old('meta_description', $post->meta_description) }}</textarea>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-blue-500 mb-1">Meta Title (EN)</label>
                        <input type="text" name="meta_title_en" id="meta_t_en" value="{{ old('meta_title_en', $post->meta_title_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Meta Title in English">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-blue-500 mb-1">Meta Description (EN)</label>
                        <textarea name="meta_description_en" id="meta_d_en" rows="2" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Meta Description in English">{{ old('meta_description_en', $post->meta_description_en) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" {{ old('is_active', $post->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">{{ __('admin.common.active') }}</span>
            </label>
        </div>

        <div class="flex justify-end items-center gap-3 pt-6 border-t border-gray-100 mt-8">
            <a href="{{ route('admin.posts.index') }}" class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium px-6 py-2.5 rounded-xl transition-colors text-sm">Batal</a>
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
    // Title
    autoTranslate('title_id', 'title_en');
    
    // Content (Summernote)
    autoTranslateSummernote('content', 'content_en');
    
    // SEO Meta
    autoTranslate('meta_t_id', 'meta_t_en');
    autoTranslate('meta_d_id', 'meta_d_en');
</script>
@endsection

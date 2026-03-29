@extends('layouts.admin')
@section('title', 'Edit Section')

@section('admin-content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.sections.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Section: {{ $section->section_name }}</h1>
    </div>

    <form action="{{ route('admin.sections.update', $section) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        @csrf @method('PUT')
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul (ID)</label>
                <input type="text" name="title" value="{{ old('title', $section->getRawOriginal('title')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Judul (EN)
                </label>
                <input type="text" name="title_en" value="{{ old('title_en', $section->title_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Title in English">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Subtitle (ID)</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $section->getRawOriginal('subtitle')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Subtitle (EN)
                </label>
                <input type="text" name="subtitle_en" value="{{ old('subtitle_en', $section->subtitle_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Subtitle in English">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konten (ID)</label>
                <textarea name="content" rows="5" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-y">{{ old('content', $section->getRawOriginal('content')) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Konten (EN)
                </label>
                <textarea name="content_en" rows="5" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-y" placeholder="Content in English">{{ old('content_en', $section->content_en) }}</textarea>
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar</label>
            @if($section->image_url) <div class="mb-2"><img src="{{ $section->image_url }}" class="h-20 rounded-lg border border-gray-200"></div> @endif
            <input type="file" name="image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm file:mr-3 file:text-xs file:font-medium file:bg-blue-50 file:text-miruku-blue file:border-0 file:rounded-lg file:px-3 file:py-1.5">
        </div>
        <div class="flex items-center gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                <input type="number" name="order" value="{{ old('order', $section->order) }}" min="0" class="w-24 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div class="flex items-center gap-2 mt-5">
                <input type="checkbox" name="is_active" {{ old('is_active', $section->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="ml-2 text-sm text-gray-600">Aktif</span>
            </div>
        </div>
        <div class="flex justify-end gap-3 border-t border-gray-100 pt-6">
            <a href="{{ route('admin.sections.index') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors text-sm">Batal</a>
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan</button>
        </div>
    </form>
</div>
@endsection

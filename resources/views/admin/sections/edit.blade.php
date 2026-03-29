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
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul</label>
            <input type="text" name="title" value="{{ old('title', $section->title) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Subtitle</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $section->subtitle) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konten</label>
            <textarea name="content" rows="5" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-y">{{ old('content', $section->content) }}</textarea>
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

@extends('layouts.admin')
@section('title', 'Edit Carousel')

@section('admin-content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.carousels.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Carousel</h1>
    </div>
    <form action="{{ route('admin.carousels.update', $carousel) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul *</label>
            <input type="text" name="title" value="{{ old('title', $carousel->title) }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Subtitle</label>
            <textarea name="subtitle" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none">{{ old('subtitle', $carousel->subtitle) }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ganti Gambar</label>
            @if($carousel->image_url)
            <div class="mb-2"><img src="{{ $carousel->image_url }}" class="h-24 w-40 object-cover rounded-lg border border-gray-200"></div>
            @endif
            <input type="file" name="image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm file:mr-3 file:text-xs file:font-medium file:bg-blue-50 file:text-miruku-blue file:border-0 file:rounded-lg file:px-3 file:py-1.5">
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tombol 1 Teks</label>
                <input type="text" name="button_text" value="{{ old('button_text', $carousel->button_text) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tombol 1 Link</label>
                <input type="text" name="button_link" value="{{ old('button_link', $carousel->button_link) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tombol 2 Teks</label>
                <input type="text" name="button2_text" value="{{ old('button2_text', $carousel->button2_text) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tombol 2 Link</label>
                <input type="text" name="button2_link" value="{{ old('button2_link', $carousel->button2_link) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                <input type="number" name="order" value="{{ old('order', $carousel->order) }}" min="1" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" {{ old('is_active', $carousel->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
            <span class="text-sm font-medium text-gray-700">Aktif</span>
        </div>
        <div class="flex justify-end gap-3 border-t border-gray-100 pt-6">
            <a href="{{ route('admin.carousels.index') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors text-sm">Batal</a>
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan</button>
        </div>
    </form>
</div>
@endsection

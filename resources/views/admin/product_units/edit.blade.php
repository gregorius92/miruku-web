@extends('layouts.admin')
@section('title', 'Edit Unit')

@section('admin-content')
<div class="w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.product_units.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Unit / Kategori: {{ $productUnit->name }}</h1>
    </div>

    <form action="{{ route('admin.product_units.update', $productUnit) }}" method="POST" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Unit (ID) *</label>
                <input type="text" name="name" id="name_id" value="{{ old('name', $productUnit->name) }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Contoh: 1000ml">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Nama Unit (EN)
                </label>
                <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $productUnit->name_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Example: 1000ml">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Slug *</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $productUnit->slug) }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="1000ml">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $productUnit->sort_order) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
        </div>

        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" {{ old('is_active', $productUnit->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Aktif</span>
            </label>
        </div>

        <div class="flex justify-end items-center gap-3 pt-6 border-t border-gray-100 mt-8">
            <a href="{{ route('admin.product_units.index') }}" class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium px-6 py-2.5 rounded-xl transition-colors text-sm">Batal</a>
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan Perubahan</button>
        </div>
    </form>
</div>
<script>
    const nameInput = document.getElementById('name_id');
    const slugInput = document.getElementById('slug');
    
    nameInput.addEventListener('input', function() {
        if (!slugInput.dataset.manual) {
            slugInput.value = this.value
                .toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
        }
    });
    
    slugInput.addEventListener('input', function() {
        this.dataset.manual = true;
    });

    if (typeof autoTranslate === 'function') {
        autoTranslate('name_id', 'name_en');
    }
</script>
@endsection

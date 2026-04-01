@extends('layouts.admin')
@section('title', 'Tambah Produk')

@section('admin-content')
<div class="w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Produk</h1>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
        @csrf
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Produk (ID) *</label>
                <input type="text" name="name" id="name_id" value="{{ old('name') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue focus:ring-2 focus:ring-blue-50" placeholder="Miruku Original">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Nama Produk (EN)
                </label>
                <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Product name in English">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Varian *</label>
                <select name="variant" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                    <option value="original" {{ old('variant') === 'original' ? 'selected' : '' }}>Original</option>
                    <option value="chocolate" {{ old('variant') === 'chocolate' ? 'selected' : '' }}>Chocolate</option>
                    <option value="banana" {{ old('variant') === 'banana' ? 'selected' : '' }}>Banana</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Harga (Rp) *</label>
                <input type="number" name="price" value="{{ old('price', 35000) }}" required min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Unit/Volume *</label>
                <input type="text" name="unit" value="{{ old('unit', '1000ml') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="1000ml">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Stok *</label>
                <input type="number" name="stock" value="{{ old('stock', 100) }}" required min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar Produk</label>
                <input type="file" name="image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue file:mr-3 file:text-xs file:font-medium file:bg-blue-50 file:text-miruku-blue file:border-0 file:rounded-lg file:px-3 file:py-1.5">
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Singkat (ID)</label>
                <textarea name="description" id="desc_id" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Deskripsi singkat untuk card produk...">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Deskripsi Singkat (EN)
                </label>
                <textarea name="description_en" id="desc_en" rows="2" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Short description in English">{{ old('description_en') }}</textarea>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konten Lengkap (ID)</label>
                <textarea name="body" rows="6" class="editor w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-y" placeholder="Detail produk lengkap...">{{ old('body') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Konten Lengkap (EN)
                </label>
                <textarea name="body_en" rows="6" class="editor w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-y" placeholder="Full content in English">{{ old('body_en') }}</textarea>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-4">
            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">SEO Settings</h3>
            <div class="grid sm:grid-cols-2 gap-5">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-1">Meta Title (ID)</label>
                        <input type="text" name="meta_title" id="meta_t_id" value="{{ old('meta_title') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Meta Title">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 mb-1">Meta Description (ID)</label>
                        <textarea name="meta_description" id="meta_d_id" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Meta Description">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-blue-500 mb-1">Meta Title (EN)</label>
                        <input type="text" name="meta_title_en" id="meta_t_en" value="{{ old('meta_title_en') }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Meta Title in English">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-blue-500 mb-1">Meta Description (EN)</label>
                        <textarea name="meta_description_en" id="meta_d_en" rows="2" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Meta Description in English">{{ old('meta_description_en') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Aktif</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Featured</span>
            </label>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan Produk</button>
            <a href="{{ route('admin.products.index') }}" class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium px-6 py-2.5 rounded-xl transition-colors text-sm">Batal</a>
        </div>
    </form>
</div>
<script>
    autoTranslate('name_id', 'name_en');
    autoTranslate('desc_id', 'desc_en');
    autoTranslate('meta_t_id', 'meta_t_en');
    autoTranslate('meta_d_id', 'meta_d_en');
    autoTranslateSummernote('body', 'body_en');
</script>
@endsection

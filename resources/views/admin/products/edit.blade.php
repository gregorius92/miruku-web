@extends('layouts.admin')
@section('title', 'Edit Produk')

@section('admin-content')
<div class="w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit: {{ $product->name }}</h1>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
        @csrf @method('PUT')
        <div class="grid sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Produk (ID) *</label>
                    <input type="text" name="name" id="name_id" value="{{ old('name', $product->getRawOriginal('name')) }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> 
                        Nama Produk (EN)
                    </label>
                    <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $product->name_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Product Name in English">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Varian *</label>
                <select name="variant" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                    @foreach(['original', 'chocolate', 'banana'] as $v)
                    <option value="{{ $v }}" {{ old('variant', $product->variant) === $v ? 'selected' : '' }}>{{ ucfirst($v) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Harga (Rp) *</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Unit/Volume *</label>
                <input type="text" name="unit" value="{{ old('unit', $product->unit) }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="1000ml">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Stok *</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ganti Gambar</label>
                @if($product->image)
                <div class="mb-2"><img src="{{ $product->image_url }}" alt="" class="h-16 w-16 object-cover rounded-lg border border-gray-200"></div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm file:mr-3 file:text-xs file:font-medium file:bg-blue-50 file:text-miruku-blue file:border-0 file:rounded-lg file:px-3 file:py-1.5">
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Singkat (ID)</label>
                <textarea name="description" id="desc_id" rows="3" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none">{{ old('description', $product->getRawOriginal('description')) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Deskripsi Singkat (EN)
                </label>
                <textarea name="description_en" id="desc_en" rows="3" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Short description in English">{{ old('description_en', $product->description_en) }}</textarea>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konten Lengkap (ID - HTML)</label>
                <textarea name="body" rows="6" class="editor w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue font-mono resize-y">{{ old('body', $product->getRawOriginal('body')) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Konten Lengkap (EN - HTML)
                </label>
                <textarea name="body_en" rows="6" class="editor w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue font-mono resize-y" placeholder="Full content in English">{{ old('body_en', $product->body_en) }}</textarea>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-5 mt-5">
            <h3 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-wider">SEO Settings</h3>
            <div class="grid sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Meta Title (ID)</label>
                    <input type="text" name="meta_title" id="meta_t_id" value="{{ old('meta_title', $product->getRawOriginal('meta_title')) }}" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-miruku-blue">
                </div>
                <div>
                    <label class="block text-sm font-medium text-blue-500 mb-1">Meta Title (EN)</label>
                    <input type="text" name="meta_title_en" id="meta_t_en" value="{{ old('meta_title_en', $product->meta_title_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-miruku-blue">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Meta Description (ID)</label>
                    <textarea name="meta_description" id="meta_d_id" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-miruku-blue resize-none">{{ old('meta_description', $product->getRawOriginal('meta_description')) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-blue-500 mb-1">Meta Description (EN)</label>
                    <textarea name="meta_description_en" id="meta_d_en" rows="2" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-miruku-blue resize-none">{{ old('meta_description_en', $product->meta_description_en) }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Aktif</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Featured</span>
            </label>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan Perubahan</button>
            <a href="{{ route('admin.products.index') }}" class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium px-6 py-2.5 rounded-xl transition-colors text-sm">Batal</a>
        </div>
    </form>
</div>
<script>
    autoTranslate('name_id', 'name_en');
    autoTranslate('desc_id', 'desc_en');
    autoTranslate('meta_t_id', 'meta_t_en');
    autoTranslate('meta_d_id', 'meta_d_en');
    autoTranslateCKEditor('body', 'body_en');
</script>
@endsection

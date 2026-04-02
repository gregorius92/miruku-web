@extends('layouts.admin')
@section('title', 'Tambah Carousel')

@section('admin-content')
<div class="w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.carousels.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Carousel Slide</h1>
    </div>
    <form action="{{ route('admin.carousels.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        @csrf
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul (ID) *</label>
                <input type="text" name="title" id="title_id" value="{{ old('title') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Judul (EN)
                </label>
                <input type="text" name="title_en" id="title_en" value="{{ old('title_en') }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Title in English">
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Subtitle (ID)</label>
                <textarea name="subtitle" id="subtitle_id" rows="2" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none">{{ old('subtitle') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Subtitle (EN)
                </label>
                <textarea name="subtitle_en" id="subtitle_en" rows="2" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Subtitle in English">{{ old('subtitle_en') }}</textarea>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tombol 1 (ID)</label>
                <input type="text" name="button_text" id="button1_id" value="{{ old('button_text') }}" placeholder="Jelajahi Produk" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-500 mb-1.5">Tombol 1 (EN)</label>
                <input type="text" name="button_text_en" id="button1_en" value="{{ old('button_text_en') }}" placeholder="Explore Products" class="w-full border border-blue-50 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div class="lg:col-span-2" x-data="{ 
                linkType: '{{ old('button_link', '/products') }}',
                customValue: '{{ old('button_link', '/products') }}',
                get isCustom() {
                    return !['/', '/about', '/benefits-lactose-free', '/products', '/blog', '/#about', '/#why', '/#products', '/#reviews', '/#blog', '/#stores'].includes(this.linkType);
                }
            }">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tombol 1 Link</label>
                <select x-model="linkType" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue mb-2">
                    <option value="/">Halaman Utama</option>
                    <option value="/about">Tentang Miruku (Halaman)</option>
                    <option value="/benefits-lactose-free">Manfaat Susu (Halaman)</option>
                    <option value="/products">Semua Produk</option>
                    <option value="/blog">Artikel Blog</option>
                    <option value="/#about">Section: Tentang</option>
                    <option value="/#why">Section: Manfaat</option>
                    <option value="/#products">Section: Produk</option>
                    <option value="/#reviews">Section: Review</option>
                    <option value="/#blog">Section: Blog</option>
                    <option value="/#stores">Section: Lokasi Toko</option>
                    <option value="custom">Lainnya (Custom Link)</option>
                </select>
                <input type="text" name="button_link" x-model="customValue" x-show="linkType === 'custom' || isCustom" 
                    :placeholder="linkType === 'custom' ? 'Masukkan link manual (contoh: /products/susu-cokelat)' : ''"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue"
                    x-effect="if(linkType !== 'custom' && !isCustom) customValue = linkType">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tombol 2 (ID)</label>
                <input type="text" name="button2_text" id="button2_id" value="{{ old('button2_text') }}" placeholder="Cari Toko" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-500 mb-1.5">Tombol 2 (EN)</label>
                <input type="text" name="button2_text_en" id="button2_en" value="{{ old('button2_text_en') }}" placeholder="Find Stores" class="w-full border border-blue-50 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div class="lg:col-span-2" x-data="{ 
                linkType: '{{ old('button2_link', '/#stores') }}',
                customValue: '{{ old('button2_link', '/#stores') }}',
                get isCustom() {
                    return !['/', '/about', '/benefits-lactose-free', '/products', '/blog', '/#about', '/#why', '/#products', '/#reviews', '/#blog', '/#stores'].includes(this.linkType);
                }
            }">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tombol 2 Link</label>
                <select x-model="linkType" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue mb-2">
                    <option value="/">Halaman Utama</option>
                    <option value="/about">Tentang Miruku (Halaman)</option>
                    <option value="/benefits-lactose-free">Manfaat Susu (Halaman)</option>
                    <option value="/products">Semua Produk</option>
                    <option value="/blog">Artikel Blog</option>
                    <option value="/#about">Section: Tentang</option>
                    <option value="/#why">Section: Manfaat</option>
                    <option value="/#products">Section: Produk</option>
                    <option value="/#reviews">Section: Review</option>
                    <option value="/#blog">Section: Blog</option>
                    <option value="/#stores">Section: Lokasi Toko</option>
                    <option value="custom">Lainnya (Custom Link)</option>
                </select>
                <input type="text" name="button2_link" x-model="customValue" x-show="linkType === 'custom' || isCustom"
                    :placeholder="linkType === 'custom' ? 'Masukkan link manual (contoh: /blog/judul-artikel)' : ''"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue"
                    x-effect="if(linkType !== 'custom' && !isCustom) customValue = linkType">
            </div>
        </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar Slide *</label>
                <input type="file" name="image" accept="image/*" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue file:mr-3 file:text-xs file:font-medium file:bg-blue-50 file:text-miruku-blue file:border-0 file:rounded-lg file:px-3 file:py-1.5">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                <input type="number" name="order" value="{{ old('order', 1) }}" min="1" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
        </div>

        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="show_content" {{ old('show_content', true) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Tampilkan Tulisan & Tombol</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Aktif</span>
            </label>
        </div>

        <div class="flex justify-end gap-3 border-t border-gray-100 pt-6">
            <a href="{{ route('admin.carousels.index') }}" class="px-6 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors text-sm">Batal</a>
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan Slide</button>
        </div>
    </form>
</div>
<script>
    autoTranslate('title_id', 'title_en');
    autoTranslate('subtitle_id', 'subtitle_en');
    autoTranslate('button1_id', 'button1_en');
    autoTranslate('button2_id', 'button2_en');
</script>
@endsection

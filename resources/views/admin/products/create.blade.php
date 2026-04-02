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
                    @foreach($variants as $v)
                    <option value="{{ $v->slug }}" {{ old('variant') === $v->slug ? 'selected' : '' }}>{{ $v->name }} ({{ $v->icon }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Harga (Rp) *</label>
                <input type="number" name="price" value="{{ old('price', 35000) }}" required min="0" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Unit/Volume *</label>
                <select name="unit" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                    @foreach($units as $u)
                    <option value="{{ $u->slug }}" {{ old('unit', '1000ml') === $u->slug ? 'selected' : '' }}>{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar Produk</label>
                <input type="file" name="image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue file:mr-3 file:text-xs file:font-medium file:bg-blue-50 file:text-miruku-blue file:border-0 file:rounded-lg file:px-3 file:py-1.5">
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest">Marketplace Links</h3>
                <button type="button" onclick="addMarketplace()" class="text-miruku-blue hover:text-miruku-dark text-xs font-bold flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Link
                </button>
            </div>
            <div id="marketplaces-container" class="space-y-3">
                <!-- Repeater items go here -->
            </div>
        </div>

        <div class="border-t border-gray-100 pt-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest">Manfaat Produk</h3>
                    <span class="text-[10px] bg-blue-50 text-miruku-blue px-2 py-0.5 rounded-full font-bold">What's inside Miruku</span>
                </div>
                <button type="button" onclick="addBenefit()" class="text-miruku-blue hover:text-miruku-dark text-xs font-bold flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Manfaat
                </button>
            </div>
            <div id="benefits-container" class="space-y-3">
                <!-- Repeater items go here -->
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

        <div class="flex flex-wrap items-center gap-x-8 gap-y-4">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Aktif</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="show_on_home" {{ old('show_on_home') ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Tampilan di Halaman Utama</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_best_seller" {{ old('is_best_seller') ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Best Seller</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Featured</span>
            </label>
        </div>

        <div class="flex justify-end items-center gap-3 pt-6 border-t border-gray-100 mt-8">
            <a href="{{ route('admin.products.index') }}" class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium px-6 py-2.5 rounded-xl transition-colors text-sm">Batal</a>
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan Produk</button>
        </div>
    </form>
</div>
<script>
    autoTranslate('name_id', 'name_en');
    autoTranslate('desc_id', 'desc_en');
    autoTranslate('meta_t_id', 'meta_t_en');
    autoTranslate('meta_d_id', 'meta_d_en');
    autoTranslateSummernote('body', 'body_en');

    let mpIndex = 0;
    function addMarketplace(name = '', url = '', color = 'bg-miruku-blue') {
        const container = document.getElementById('marketplaces-container');
        const div = document.createElement('div');
        div.className = 'grid grid-cols-1 sm:grid-cols-12 gap-3 items-end bg-gray-50/50 p-4 rounded-xl border border-gray-100';
        div.innerHTML = `
            <div class="sm:col-span-3">
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Merchant (Label)</label>
                <input type="text" name="marketplaces[${mpIndex}][name]" value="${name}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Shopee / Tokopedia">
            </div>
            <div class="sm:col-span-5">
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">URL Link</label>
                <input type="url" name="marketplaces[${mpIndex}][url]" value="${url}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-miruku-blue" placeholder="https://shopee.co.id/product/...">
            </div>
            <div class="sm:col-span-3">
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Warna Tombol</label>
                <select name="marketplaces[${mpIndex}][color]" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-miruku-blue">
                    <option value="bg-[#ee4d2d]" ${color === 'bg-[#ee4d2d]' ? 'selected' : ''}>Shopee (Orange)</option>
                    <option value="bg-[#03ac0e]" ${color === 'bg-[#03ac0e]' ? 'selected' : ''}>Tokopedia (Green)</option>
                    <option value="bg-[#0095da]" ${color === 'bg-[#0095da]' ? 'selected' : ''}>Blibli (Blue)</option>
                    <option value="bg-[#e31e54]" ${color === 'bg-[#e31e54]' ? 'selected' : ''}>Bukalapak (Red)</option>
                    <option value="bg-[#0f146d]" ${color === 'bg-[#0f146d]' ? 'selected' : ''}>Lazada (Navy)</option>
                    <option value="bg-black" ${color === 'bg-black' ? 'selected' : ''}>TikTok Shop (Black)</option>
                    <option value="bg-miruku-blue" ${color === 'bg-miruku-blue' ? 'selected' : ''}>Miruku (Brand Blue)</option>
                    <option value="bg-gray-600" ${color === 'bg-gray-600' ? 'selected' : ''}>General (Gray)</option>
                </select>
            </div>
            <div class="sm:col-span-1">
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="w-full bg-white border border-red-100 text-red-400 hover:bg-red-50 p-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>
        `;
        container.appendChild(div);
        mpIndex++;
    }

    let benefitIndex = 0;
    function addBenefit(idVal = '', enVal = '') {
        const container = document.getElementById('benefits-container');
        const div = document.createElement('div');
        div.className = 'grid grid-cols-1 sm:grid-cols-12 gap-3 items-end bg-blue-50/20 p-4 rounded-xl border border-blue-50';
        div.innerHTML = `
            <div class="sm:col-span-1 border-r border-blue-100 flex items-center justify-center">
                <span class="text-xs font-bold text-blue-300">#</span>
            </div>
            <div class="sm:col-span-5">
                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Manfaat (ID)</label>
                <input type="text" name="benefits[]" value="${idVal}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Contoh: 0% Lactose">
            </div>
            <div class="sm:col-span-5">
                <label class="block text-[10px] font-bold text-blue-400 uppercase mb-1">Benefit (EN)</label>
                <input type="text" name="benefits_en[]" value="${enVal}" required class="w-full border border-blue-100 bg-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-miruku-blue" placeholder="English version...">
            </div>
            <div class="sm:col-span-1">
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="w-full bg-white border border-red-100 text-red-400 hover:bg-red-50 p-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </div>
        `;
        container.appendChild(div);
        benefitIndex++;
    }

    // Add one empty field by default
    @if(old('marketplaces'))
        @foreach(old('marketplaces') as $mp)
            addMarketplace('{{ $mp['name'] }}', '{{ $mp['url'] }}', '{{ $mp['color'] ?? 'bg-miruku-blue' }}');
        @endforeach
    @else
        addMarketplace();
    @endif

    @if(old('benefits'))
        @foreach(old('benefits') as $index => $idVal)
            addBenefit('{{ $idVal }}', '{{ old('benefits_en')[$index] ?? '' }}');
        @endforeach
    @else
        // Fallback or default items? Let's leave it empty for new products to let them see the placeholder.
        // Or maybe add 3 empty rows.
        addBenefit();
    @endif
</script>
@endsection

@extends('layouts.admin')
@section('title', 'Edit Varian')

@section('admin-content')
<div class="w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.variants.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Varian: {{ $variant->name }}</h1>
    </div>

    <form action="{{ route('admin.variants.update', $variant) }}" method="POST" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
        @csrf
        @method('PUT')
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Varian (ID) *</label>
                <input type="text" name="name" id="name_id" value="{{ old('name', $variant->name) }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue focus:ring-2 focus:ring-blue-50" placeholder="Contoh: Cokelat">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Nama Varian (EN)
                </label>
                <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $variant->name_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Example: Chocolate">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Slug / Key *</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $variant->slug) }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="example-slug">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Icon (Emoji) *</label>
                <select name="icon" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                    @foreach(['🥛', '🍫', '🍌', '🍓', '🍵', '☕', '🍨', '🍯', '🥭', '🫐', '🥥', '🍈'] as $emoji)
                        <option value="{{ $emoji }}" {{ old('icon', $variant->icon) == $emoji ? 'selected' : '' }}>{{ $emoji }}</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Color Class (Tailwind Gradient)</label>
                <select name="color_class" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                    @foreach([
                        'from-blue-50 to-indigo-100' => 'Blue (Original)',
                        'from-amber-50 to-orange-100' => 'Orange (Chocolate)',
                        'from-yellow-50 to-lime-100' => 'Yellow (Banana)',
                        'from-pink-50 to-rose-100' => 'Pink (Strawberry)',
                        'from-green-50 to-emerald-100' => 'Green (Matcha)',
                        'from-purple-50 to-fuchsia-100' => 'Purple (Taro)',
                        'from-gray-50 to-slate-200' => 'Gray (Vanilla)',
                        'from-red-50 to-orange-100' => 'Red (Spicy/Red Fruit)',
                    ] as $class => $label)
                        <option value="{{ $class }}" {{ old('color_class', $variant->color_class) == $class ? 'selected' : '' }}>{{ $label }} ({{ $class }})</option>
                    @endforeach
                </select>
                <p class="text-[10px] text-gray-400 mt-1">Pilih kombinasi warna gradient yang sesuai untuk latar belakang produk.</p>
            </div>
        </div>

        <div class="flex items-center gap-6">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" {{ old('is_active', $variant->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
                <span class="text-sm font-medium text-gray-700">Aktif</span>
            </label>
        </div>

        <div class="flex justify-end items-center gap-3 pt-6 border-t border-gray-100 mt-8">
            <a href="{{ route('admin.variants.index') }}" class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium px-6 py-2.5 rounded-xl transition-colors text-sm">Batal</a>
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Update Varian</button>
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

@extends('layouts.admin')
@section('title', 'Edit Toko')

@section('admin-content')
<div class="w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.stores.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Toko: {{ $store->name }}</h1>
    </div>
    <form action="{{ route('admin.stores.update', $store) }}" method="POST" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        @csrf @method('PUT')
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Toko (ID) *</label>
                <input type="text" name="name" id="name_id" value="{{ old('name', $store->getRawOriginal('name')) }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Nama Toko (EN)
                </label>
                <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $store->name_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Store name in English">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat (ID) *</label>
                <textarea name="address" id="addr_id" rows="2" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none">{{ old('address', $store->getRawOriginal('address')) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Alamat (EN)
                </label>
                <textarea name="address_en" id="addr_en" rows="2" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Address in English">{{ old('address_en', $store->address_en) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kota (ID) *</label>
                <input type="text" name="city" id="city_id" value="{{ old('city', $store->getRawOriginal('city')) }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Kota (EN)
                </label>
                <input type="text" name="city_en" id="city_en" value="{{ old('city_en', $store->city_en) }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="City in English">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Provinsi</label>
                <input type="text" name="province" value="{{ old('province', $store->province) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $store->phone) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jam Buka</label>
                    <input type="time" name="open_time" value="{{ old('open_time', $store->open_time) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jam Tutup</label>
                    <input type="time" name="close_time" value="{{ old('close_time', $store->close_time) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Google Maps Embed URL</label>
                <input type="text" name="map_embed" value="{{ old('map_embed', $store->map_embed) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
        </div>
        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_active" {{ old('is_active', $store->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-miruku-blue">
            <span class="text-sm font-semibold text-gray-700">Toko Aktif</span>
        </label>
        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.stores.index') }}" class="bg-white border border-gray-300 text-gray-700 font-semibold px-6 py-2.5 rounded-xl hover:bg-gray-50 transition-colors text-sm">Batal</a>
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan</button>
        </div>
    </form>
</div>
<script>
    autoTranslate('name_id', 'name_en');
    autoTranslate('addr_id', 'addr_en');
    autoTranslate('city_id', 'city_en');
</script>
@endsection

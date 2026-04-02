@extends('layouts.admin')
@section('title', 'Tambah Toko')

@section('admin-content')
<div class="w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.stores.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Lokasi Toko</h1>
    </div>
    <form action="{{ route('admin.stores.store') }}" method="POST" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
        @csrf
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Toko (ID) *</label>
                <input type="text" name="name" id="name_id" value="{{ old('name') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Nama Toko (EN)
                </label>
                <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="Store name in English">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat (ID) *</label>
                <textarea name="address" id="addr_id" rows="2" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none">{{ old('address') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Alamat (EN)
                </label>
                <textarea name="address_en" id="addr_en" rows="2" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none" placeholder="Address in English">{{ old('address_en') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kota (ID) *</label>
                <input type="text" name="city" id="city_id" value="{{ old('city') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-blue-600 mb-1.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Kota (EN)
                </label>
                <input type="text" name="city_en" id="city_en" value="{{ old('city_en') }}" class="w-full border border-blue-100 bg-blue-50/20 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue" placeholder="City in English">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Provinsi</label>
                <input type="text" name="province" value="{{ old('province') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar</label>
            <input type="file" name="image" accept="image/*" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm file:mr-3 file:text-xs file:font-medium file:bg-blue-50 file:text-miruku-blue file:border-0 file:rounded-lg file:px-3 file:py-1.5">
        </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jam Buka</label>
                    <input type="time" name="open_time" value="{{ old('open_time', '08:00') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jam Tutup</label>
                    <input type="time" name="close_time" value="{{ old('close_time', '21:00') }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Google Maps Embed URL</label>
                <input type="text" name="map_embed" value="{{ old('map_embed') }}" placeholder="https://www.google.com/maps/embed?pb=..." class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" checked class="rounded border-gray-300 text-miruku-blue">
            <span class="text-sm font-medium text-gray-700">Aktif</span>
        </div>
        <div class="flex justify-end items-center gap-3 pt-6 border-t border-gray-100 mt-8">
            <a href="{{ route('admin.stores.index') }}" class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium px-6 py-2.5 rounded-xl transition-colors text-sm">Batal</a>
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan Toko</button>
        </div>
    </form>
</div>
<script>
    autoTranslate('name_id', 'name_en');
    autoTranslate('addr_id', 'addr_en');
    autoTranslate('city_id', 'city_en');
</script>
@endsection

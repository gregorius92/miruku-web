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
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Provinsi *</label>
                <select name="province" id="province_select" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                    <option value="">Pilih Provinsi</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kota (ID) *</label>
                <select name="city" id="city_id" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                    <option value="">Pilih Kota</option>
                </select>
            </div>
            <input type="hidden" name="city_en" id="city_en_hidden" value="{{ old('city_en', $store->city_en) }}">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $store->phone) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jam Buka</label>
                    <input type="time" name="open_time" value="{{ old('open_time', substr($store->open_time, 0, 5)) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jam Tutup</label>
                    <input type="time" name="close_time" value="{{ old('close_time', substr($store->close_time, 0, 5)) }}" class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
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
        <div class="flex justify-end items-center gap-3 pt-6 border-t border-gray-100 mt-8">
            <a href="{{ route('admin.stores.index') }}" class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium px-6 py-2.5 rounded-xl transition-colors text-sm">Batal</a>
            <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan Perubahan</button>
        </div>
    </form>
</div>
<style>
    .select2-container--default .select2-selection--single {
        height: 50px;
        border-radius: 0.75rem;
        border-color: #e5e7eb;
        display: flex;
        items-center: center!important;
        padding: 0.5rem 1rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: normal;
        padding-left: 0;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 50px;
    }
    .select2-dropdown {
        border-radius: 0.75rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        overflow: hidden;
    }
</style>
<script>
    autoTranslate('name_id', 'name_en');
    autoTranslate('addr_id', 'addr_en');
    
    $(document).ready(function() {
        const storedProvince = "{{ old('province', $store->province) }}";
        const storedCity = "{{ old('city', $store->getRawOriginal('city')) }}";

        const $provinceSelect = $('#province_select').select2();
        const $citySelect = $('#city_id').select2();

        async function fetchProvinces() {
            try {
                const response = await fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                const provinces = await response.json();
                
                provinces.forEach(province => {
                    const option = new Option(province.name, province.id, false, false);
                    $provinceSelect.append(option);
                });

                if (storedProvince) {
                    const found = provinces.find(p => p.name.toUpperCase() === storedProvince.toUpperCase());
                    if (found) {
                        $provinceSelect.val(found.id).trigger('change');
                    }
                } else {
                    $provinceSelect.trigger('change');
                }
            } catch (error) {
                console.error('Error fetching provinces:', error);
            }
        }

        async function fetchCities(provinceId) {
            $citySelect.empty().append('<option value="">Pilih Kota</option>').trigger('change');
            
            try {
                const response = await fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`);
                const cities = await response.json();
                
                cities.forEach(city => {
                    const option = new Option(city.name, city.name, false, false);
                    $citySelect.append(option);
                });

                if (storedCity) {
                    const found = cities.find(c => c.name.toUpperCase() === storedCity.toUpperCase());
                    if (found) {
                        $citySelect.val(found.name).trigger('change');
                    }
                } else {
                    $citySelect.trigger('change');
                }
            } catch (error) {
                console.error('Error fetching cities:', error);
            }
        }

        $provinceSelect.on('change', function() {
            const provinceId = $(this).val();
            if (provinceId) {
                fetchCities(provinceId);
            }
        });

        $citySelect.on('change', async function() {
            const cityName = $(this).val();
            if (cityName) {
                try {
                    const response = await fetch('{{ route("admin.translate") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ text: cityName, target: 'en' })
                    });
                    const data = await response.json();
                    if (data.success) {
                        $('#city_en_hidden').val(data.translatedText);
                    }
                } catch (error) {
                    console.error('City translation error:', error);
                }
            }
        });

        $('form').on('submit', function(e) {
            const provinceId = $provinceSelect.val();
            if (provinceId) {
                const provinceName = $("#province_select option:selected").text();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'province',
                    value: provinceName
                }).appendTo(this);
                
                $provinceSelect.attr('name', '');
            }
        });

        fetchProvinces();
    });
</script>
@endsection

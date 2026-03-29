@extends('layouts.admin')
@section('title', 'Pengaturan')

@section('admin-content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Pengaturan Global</h1>
    <p class="text-sm text-gray-500 mt-1">Kelola SEO, kontak, dan media sosial</p>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
    @csrf

    @foreach($settings as $group => $groupSettings)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h3 class="font-semibold text-gray-900 mb-5 flex items-center gap-2">
            <span class="text-xs font-bold uppercase tracking-wider text-miruku-blue bg-blue-50 px-2.5 py-1 rounded-full">{{ ucfirst($group) }}</span>
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 mt-4">
            @foreach($groupSettings as $setting)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
                @if(str_contains($setting->key, 'description') || str_contains($setting->key, 'address'))
                <textarea name="settings[{{ $setting->key }}]" 
                          class="w-full rounded-xl border-gray-300 focus:border-miruku-blue focus:ring-miruku-blue text-sm" rows="3">{{ old('settings.'.$setting->key, $setting->value) }}</textarea>
                @else
                <input type="text" name="settings[{{ $setting->key }}]" value="{{ old('settings.'.$setting->key, $setting->value) }}"
                       class="w-full rounded-xl border-gray-300 focus:border-miruku-blue focus:ring-miruku-blue text-sm">
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endforeach

    <div class="flex gap-3">
        <button type="submit" class="bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">Simpan Pengaturan</button>
    </div>
</form>
@endsection

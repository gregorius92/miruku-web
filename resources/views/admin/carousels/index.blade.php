@extends('layouts.admin')
@section('title', 'Carousel')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">{{ __('admin.carousels.title') }}</h1>
    <a href="{{ route('admin.carousels.create') }}" class="inline-flex items-center gap-2 bg-miruku-blue text-white font-medium px-4 py-2.5 rounded-xl hover:bg-miruku-dark transition-colors text-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        {{ __('admin.carousels.add') }}
    </a>
</div>

<div class="grid gap-4">
    @forelse($carousels as $carousel)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex gap-4 items-center p-4">
        <div class="w-24 h-16 rounded-xl overflow-hidden bg-gradient-to-br from-blue-100 to-indigo-100 flex-shrink-0 flex items-center justify-center text-3xl">
            @if($carousel->image_url)
            <img src="{{ $carousel->image_url }}" class="w-full h-full object-cover">
            @else 🖼️
            @endif
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2 mb-1">
                <span class="font-semibold text-gray-900 truncate">{{ $carousel->title }}</span>
                @if($carousel->is_active)
                <span class="text-xs bg-green-50 text-green-700 px-2 py-0.5 rounded-full font-medium">{{ __('admin.common.active') }}</span>
                @else
                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full font-medium">{{ __('admin.common.inactive') }}</span>
                @endif
            </div>
            <p class="text-sm text-gray-500 truncate">{{ $carousel->subtitle }}</p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="{{ route('admin.carousels.edit', $carousel) }}" class="text-xs text-miruku-blue hover:text-miruku-dark font-medium px-3 py-1.5 rounded-lg hover:bg-blue-50 transition-colors">{{ __('admin.common.edit') }}</a>
            <form action="{{ route('admin.carousels.destroy', $carousel) }}" method="POST" onsubmit="return confirm('{{ __('admin.carousels.delete_confirm') }}')">
                @csrf @method('DELETE')
                <button class="text-xs text-red-500 hover:text-red-600 font-medium px-3 py-1.5 rounded-lg hover:bg-red-50 transition-colors">{{ __('admin.common.delete') }}</button>
            </form>
        </div>
    </div>
    @empty
    <div class="text-center py-12 text-gray-400 bg-white rounded-2xl border border-gray-100">
        {{ __('admin.carousels.empty') }} <a href="{{ route('admin.carousels.create') }}" class="text-miruku-blue font-medium">{{ __('admin.carousels.add_now') }}</a>
    </div>
    @endforelse
</div>
@endsection

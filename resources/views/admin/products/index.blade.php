@extends('layouts.admin')
@section('title', 'Produk')

@section('admin-content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">{{ __('admin.products.title') }}</h1>
        <p class="text-sm text-gray-500 mt-1">{{ __('admin.products.subtitle') }}</p>
    </div>
    <div class="flex items-center gap-3">
        <form action="{{ route('admin.products.index') }}" method="GET" class="relative group">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari produk..." 
                   class="bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:outline-none focus:border-miruku-blue focus:ring-2 focus:ring-blue-50 transition-all w-full md:w-64">
            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 group-focus-within:text-miruku-blue transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            @if(request('search'))
            <a href="{{ route('admin.products.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </a>
            @endif
        </form>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-miruku-blue text-white font-medium px-4 py-2.5 rounded-xl hover:bg-miruku-dark transition-colors text-sm whitespace-nowrap">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            {{ __('admin.products.add') }}
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.products.title') }}</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.products.fields.variant') }}</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.products.fields.price') }}</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Flags</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.common.status') }}</th>
                <th class="text-right px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.common.actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($products as $product)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-blue-50 flex items-center justify-center text-xl flex-shrink-0">
                            @if($product->image)
                            <img src="{{ $product->image_url }}" alt="" class="w-full h-full object-cover">
                            @else
                            {{ $product->variantInfo->icon ?? '🥛' }}
                            @endif
                        </div>
                        <div class="truncate">
                            <div class="font-semibold text-gray-900 truncate">{{ $product->name }}</div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-tight">{{ $product->unitInfo->name ?? $product->unit }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-miruku-blue">{{ $product->variantInfo->name ?? ucfirst($product->variant) }}</span>
                </td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $product->formatted_price }}</td>
                <td class="px-5 py-4">
                    <div class="flex flex-col gap-1">
                        @if($product->show_on_home)
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-600 border border-purple-100 italic">HOMEPAGE</span>
                        @endif
                        @if($product->is_best_seller)
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-100 italic">BEST SELLER</span>
                        @endif
                        @if($product->is_featured)
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-100 italic">FEATURED</span>
                        @endif
                    </div>
                </td>
                <td class="px-5 py-4">
                    @if($product->is_active)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> {{ __('admin.common.active') }}
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> {{ __('admin.common.inactive') }}
                    </span>
                    @endif
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium px-3 py-1.5 rounded-lg hover:bg-blue-50 transition-colors">{{ __('admin.common.edit') }}</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('{{ __('admin.products.delete_confirm') }}')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:text-red-600 font-medium px-3 py-1.5 rounded-lg hover:bg-red-50 transition-colors">{{ __('admin.common.delete') }}</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-12 text-gray-400">Belum ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-5 py-4 border-t border-gray-100">
        {{ $products->links() }}
    </div>
</div>
@endsection

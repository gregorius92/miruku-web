@extends('layouts.admin')
@section('title', 'Produk')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">{{ __('admin.products.title') }}</h1>
        <p class="text-sm text-gray-500 mt-1">{{ __('admin.products.subtitle') }}</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-miruku-blue text-white font-medium px-4 py-2.5 rounded-xl hover:bg-miruku-dark transition-colors text-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        {{ __('admin.products.add') }}
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.products.title') }}</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.products.fields.variant') }}</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.products.fields.price') }}</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">{{ __('admin.products.fields.stock') }}</th>
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
                            @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="" class="w-full h-full object-cover">
                            @else 🥛
                            @endif
                        </div>
                        <div class="truncate">
                            <div class="font-semibold text-gray-900 truncate">{{ $product->name }}</div>
                            <div class="text-xs text-gray-500">{{ __('admin.products.fields.stock') }}: {{ $product->stock }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-miruku-blue">{{ ucfirst($product->variant) }}</span>
                </td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $product->formatted_price }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $product->stock }}</td>
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
            <tr><td colspan="6" class="text-center py-12 text-gray-400">{{ __('admin.products.empty') }}</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-5 py-4 border-t border-gray-100">
        {{ $products->links() }}
    </div>
</div>
@endsection

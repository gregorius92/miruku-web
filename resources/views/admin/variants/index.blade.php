@extends('layouts.admin')
@section('title', 'Varian Produk')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Varian Produk</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola varian rasa dan tampilan produk Miruku.</p>
    </div>
    <a href="{{ route('admin.variants.create') }}" class="inline-flex items-center gap-2 bg-miruku-blue text-white font-medium px-4 py-2.5 rounded-xl hover:bg-miruku-dark transition-colors text-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Varian
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Varian</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Slug / Key</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Preview Layout</th>
                <th class="text-left px-5 py-3.5 font-semibold text-gray-600">Status</th>
                <th class="text-right px-5 py-3.5 font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($variants as $variant)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center text-xl flex-shrink-0">
                            {{ $variant->icon ?? '🥛' }}
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ $variant->name }}</div>
                            <div class="text-xs text-gray-500">{{ $variant->name_en }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4 text-gray-600 font-mono text-xs">
                    {{ $variant->slug }}
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-2">
                        <div class="w-20 h-8 rounded-lg bg-gradient-to-br {{ $variant->color_class ?? 'from-gray-100 to-gray-200' }} border border-gray-100 flex items-center justify-center text-sm">
                            {{ $variant->icon }}
                        </div>
                        <span class="text-[10px] text-gray-400 font-mono truncate max-w-[100px]">{{ $variant->color_class }}</span>
                    </div>
                </td>
                <td class="px-5 py-4">
                    @if($variant->is_active)
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-50 text-green-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span> Aktif
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Nonaktif
                    </span>
                    @endif
                </td>
                <td class="px-5 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.variants.edit', $variant) }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium px-3 py-1.5 rounded-lg hover:bg-blue-50 transition-colors">Edit</a>
                        <form action="{{ route('admin.variants.destroy', $variant) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus varian ini?')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:text-red-600 font-medium px-3 py-1.5 rounded-lg hover:bg-red-50 transition-colors">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-12 text-gray-400">Belum ada varian.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-5 py-4 border-t border-gray-100">
        {{ $variants->links() }}
    </div>
</div>
@endsection

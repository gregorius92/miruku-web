@extends('layouts.admin')
@section('title', 'Dashboard')

@section('admin-content')
<div class="space-y-6">
    <!-- Stats Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach([
            ['label' => 'Total Produk', 'value' => $stats['total_products'], 'sub' => $stats['active_products'].' aktif', 'color' => 'blue', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
            ['label' => 'Ulasan Pending', 'value' => $stats['pending_reviews'], 'sub' => $stats['approved_reviews'].' disetujui', 'color' => 'amber', 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
            ['label' => 'Lokasi Toko', 'value' => $stats['total_stores'], 'sub' => 'Aktif', 'color' => 'teal', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z'],
            ['label' => 'Carousel Aktif', 'value' => $stats['active_carousels'], 'sub' => 'Slides', 'color' => 'indigo', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ] as $stat)
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <span class="text-sm font-medium text-gray-500">{{ $stat['label'] }}</span>
                <div class="w-9 h-9 bg-{{ $stat['color'] === 'blue' ? 'blue' : $stat['color'] }}-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-{{ $stat['color'] === 'blue' ? 'miruku-blue' : $stat['color'].'-500' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $stat['value'] }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $stat['sub'] }}</p>
        </div>
        @endforeach
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <h3 class="font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-miruku-blue text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-miruku-dark transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Produk
            </a>
            <a href="{{ route('admin.carousels.create') }}" class="inline-flex items-center gap-2 bg-purple-500 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-purple-600 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Carousel
            </a>
            <a href="{{ route('admin.reviews.index') }}" class="inline-flex items-center gap-2 bg-amber-500 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-amber-600 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Kelola Ulasan
            </a>
        </div>
    </div>

    <!-- Recent Reviews -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between">
            <h3 class="font-bold text-gray-900">Ulasan Terbaru</h3>
            <a href="{{ route('admin.reviews.index') }}" class="text-sm text-miruku-blue hover:text-miruku-dark font-medium">Lihat semua →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentReviews as $review)
            <div class="px-6 py-4 flex items-center gap-4">
                <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-miruku-blue font-bold text-sm flex-shrink-0">
                    {{ strtoupper(substr($review->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-medium text-gray-900 text-sm">{{ $review->name }}</span>
                        <div class="flex gap-0.5">
                            @for($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-200' }} text-xs">★</span>
                            @endfor
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm truncate">{{ $review->comment }}</p>
                </div>
                <div class="flex gap-2 flex-shrink-0">
                    @if(!$review->is_approved)
                    <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
                        @csrf
                        <button class="text-xs bg-miruku-blue hover:bg-miruku-dark text-white px-3 py-1.5 rounded-lg transition-colors">Setujui</button>
                    </form>
                    @endif
                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini?')">
                        @csrf @method('DELETE')
                        <button class="text-xs text-red-500 hover:text-red-600 font-medium px-3 py-1.5 rounded-lg hover:bg-red-50 transition-colors">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-400">Belum ada ulasan terbaru.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection

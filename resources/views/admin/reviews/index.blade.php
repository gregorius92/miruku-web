@extends('layouts.admin')
@section('title', 'Ulasan')

@section('admin-content')
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Review & Ulasan</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola ulasan dari pelanggan Miruku</p>
        </div>
        
        <div class="flex overflow-x-auto pb-1 md:pb-0 gap-2">
            @foreach([
                ['status' => null, 'label' => 'Semua'],
                ['status' => 'pending', 'label' => 'Pending'],
                ['status' => 'approved', 'label' => 'Disetujui']
            ] as $filter)
            <a href="{{ route('admin.reviews.index', ['status' => $filter['status']]) }}" 
               class="whitespace-nowrap px-4 py-2 rounded-xl text-sm font-medium transition-colors
              {{ (request('status') == $filter['status']) ? 'bg-miruku-blue text-white' : 'bg-gray-50 text-gray-600 hover:bg-gray-100' }}">
                {{ $filter['label'] }}
            </a>
            @endforeach
        </div>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($reviews as $review)
            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100 relative group">
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-miruku-blue font-bold text-sm flex-shrink-0">
                        {{ strtoupper(substr($review->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-bold text-gray-900">{{ $review->name }}</span>
                            @if(!$review->is_approved)
                            <span class="text-[10px] bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded-full font-bold uppercase tracking-wider">Pending</span>
                            @else
                            <span class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded-full font-bold uppercase tracking-wider">Disetujui</span>
                            @endif
                        </div>
                        <div class="flex gap-0.5 mb-2">
                            @for($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-200' }} text-xs">★</span>
                            @endfor
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">"{{ $review->comment }}"</p>
                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                            <span class="text-[11px] text-gray-400">{{ $review->created_at->format('d M Y') }}</span>
                            <div class="flex gap-2">
                                @if(!$review->is_approved)
                                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
                                    @csrf
                                    <button class="text-xs font-semibold text-miruku-blue hover:text-miruku-dark bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">Setujui</button>
                                </form>
                                @endif
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-xs font-semibold text-red-500 hover:text-red-600 bg-red-50 px-3 py-1.5 rounded-lg transition-colors">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center">
                <div class="text-4xl mb-3">💬</div>
                <p class="text-gray-500">Belum ada ulasan untuk kategori ini.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-8">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@endsection

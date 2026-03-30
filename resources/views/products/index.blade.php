@extends('layouts.app')

@section('content')
<div class="pt-24 pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <span class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('products.hero_badge') }}</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 font-cormorant">{{ __('products.hero_title') }}</h1>
            <p class="text-gray-500 mt-4 text-lg max-w-2xl mx-auto">{{ __('products.hero_subtitle') }}</p>
        </div>

        <!-- Filter -->
        <div class="flex flex-wrap justify-center gap-3 mb-10">
            <a href="{{ route('products.index') }}"
               class="px-6 py-2.5 rounded-full text-sm font-medium border transition-all duration-200 {{ !request('variant') ? 'bg-miruku-blue border-miruku-blue text-white' : 'bg-white border-gray-200 text-gray-600 hover:bg-blue-50' }}">
                {{ __('products.filter_all') }}
            </a>
            @foreach(['original', 'chocolate', 'banana'] as $v)
            <a href="{{ route('products.index', ['variant' => $v]) }}"
               class="px-6 py-2.5 rounded-full text-sm font-medium border transition-all duration-200 {{ request('variant') === $v ? 'bg-miruku-blue border-miruku-blue text-white' : 'bg-white border-gray-200 text-gray-600 hover:bg-blue-50' }}">
                {{ ucfirst($v) }}
            </a>
            @endforeach
        </div>

        <!-- Products Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $product)
            <div class="group bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                <div class="aspect-square overflow-hidden bg-gradient-to-br
                    {{ $product->variant === 'original' ? 'from-blue-50 to-indigo-50' : ($product->variant === 'chocolate' ? 'from-amber-50 to-orange-50' : 'from-yellow-50 to-lime-50') }}">
                    @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-7xl">
                        {{ $product->variant === 'original' ? '🥛' : ($product->variant === 'chocolate' ? '🍫' : '🍌') }}
                    </div>
                    @endif
                </div>
                @if($product->is_featured)
                <div class="absolute -mt-40 ml-4">
                    <span class="bg-miruku-blue text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">⭐ {{ __('products.best_seller') }}</span>
                </div>
                @endif
                <div class="p-6">
                    <span class="text-xs font-semibold uppercase tracking-wider text-miruku-blue bg-blue-50 px-3 py-1 rounded-full">{{ ucfirst($product->variant) }}</span>
                    <h2 class="text-xl font-bold text-gray-900 mt-3 mb-2 font-cormorant">{{ $product->name }}</h2>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">{{ $product->description }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-miruku-blue font-cormorant">{{ $product->formatted_price }}</span>
                        <a href="{{ route('products.show', $product->slug) }}"
                           class="inline-flex items-center gap-2 bg-gray-900 hover:bg-miruku-blue text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-all duration-300">
                            {{ __('products.view_detail') }}
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-20">
                <div class="text-6xl mb-4">🥛</div>
                <p class="text-gray-400">{{ __('products.not_found') }}</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">{{ $products->links() }}</div>
    </div>
</div>
@endsection

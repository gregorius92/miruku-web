@extends('layouts.app')

@push('head')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "{{ $product->name }}",
    "description": "{{ $product->description }}",
    "image": "{{ $product->image_url }}",
    "url": "{{ url()->current() }}",
    "brand": {
        "@type": "Brand",
        "name": "Miruku"
    },
    "offers": {
        "@type": "Offer",
        "price": "{{ $product->price }}",
        "priceCurrency": "IDR",
        "availability": "{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}"
    }
    @if($reviews->count() > 0)
    ,"aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ number_format($product->average_rating, 1) }}",
        "reviewCount": "{{ $reviews->count() }}"
    }
    @endif
}
</script>
@endpush

@section('content')
<div class="pt-24 pb-16 bg-white">
    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <nav class="flex items-center gap-2 text-sm text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-miruku-blue transition-colors">{{ __('products.breadcrumb_home') }}</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-miruku-blue transition-colors">{{ __('products.breadcrumb_products') }}</a>
            <span>/</span>
            <span class="text-gray-700">{{ $product->name }}</span>
        </nav>
    </div>

    <!-- Product Detail -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-start mb-20">
            <!-- Product Image -->
            <div class="relative">
                <div class="aspect-square rounded-3xl overflow-hidden bg-gradient-to-br
                    {{ $product->variant === 'original' ? 'from-blue-50 to-indigo-100' : ($product->variant === 'chocolate' ? 'from-amber-50 to-orange-100' : 'from-yellow-50 to-lime-100') }}">
                    @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex flex-col items-center justify-center">
                        <div class="text-[140px]">{{ $product->variant === 'original' ? '🥛' : ($product->variant === 'chocolate' ? '🍫' : '🍌') }}</div>
                        <p class="text-miruku-blue font-cormorant text-2xl italic mt-4">{{ $product->name }}</p>
                    </div>
                    @endif
                </div>
                @if($product->is_featured)
                <div class="absolute top-6 left-6 bg-miruku-blue text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg">
                    ⭐ {{ __('products.best_seller') }}
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="pt-4">
                <span class="inline-flex items-center gap-1 text-xs font-bold uppercase tracking-wider text-miruku-blue bg-blue-50 px-3 py-1.5 rounded-full mb-4">
                    {{ __('products.variant_label', ['variant' => ucfirst($product->variant)]) }}
                </span>
                <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4 font-cormorant leading-tight">{{ $product->name }}</h1>

                <!-- Rating -->
                @if($reviews->count() > 0)
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= round($product->average_rating) ? 'text-amber-400 fill-amber-400' : 'text-gray-200 fill-gray-200' }}" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        @endfor
                    </div>
                    <span class="text-gray-600 text-sm font-medium">{{ __('products.reviews_count', ['rating' => number_format($product->average_rating, 1), 'count' => $reviews->count()]) }}</span>
                </div>
                @endif

                <p class="text-gray-600 text-lg leading-relaxed mb-8">{{ $product->description }}</p>

                <!-- Price -->
                <div class="flex items-center gap-4 mb-8">
                    <span class="text-4xl font-bold text-miruku-blue font-cormorant">{{ $product->formatted_price }}</span>
                    <span class="text-gray-400 text-sm">/ {{ $product->unit }}</span>
                </div>

                <!-- Stock Status -->
                <div class="flex items-center gap-2 mb-8">
                    @if($product->stock > 0)
                    <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                    <span class="text-green-600 text-sm font-medium">{{ __('products.available') }} ({{ $product->stock }} {{ __('products.unit') ?? 'unit' }})</span>
                    @else
                    <div class="w-2 h-2 rounded-full bg-red-400"></div>
                    <span class="text-red-500 text-sm font-medium">{{ __('products.out_of_stock') }}</span>
                    @endif
                </div>

                <!-- Benefits list -->
                <div class="bg-blue-50 rounded-2xl p-5 mb-8">
                    <h4 class="font-semibold text-gray-900 mb-3 text-sm uppercase tracking-wide">{{ __('products.inside_miruku') }}</h4>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach(__('products.benefits') as $benefit)
                        <div class="flex items-center gap-2 text-sm text-gray-700">
                            <svg class="w-4 h-4 text-miruku-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $benefit }}
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- CTAs -->
                <div class="flex flex-wrap gap-4">
                    <a href="#" class="flex-1 min-w-0 bg-miruku-blue hover:bg-miruku-dark text-white font-bold py-4 px-6 rounded-full text-center transition-all duration-300 hover:scale-105 shadow-xl shadow-miruku-blue/30">
                        🛒 {{ __('products.buy_shopee') }}
                    </a>
                    <a href="#" class="flex-1 min-w-0 border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white font-bold py-4 px-6 rounded-full text-center transition-all duration-300">
                        {{ __('products.buy_tokopedia') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Product Body -->
        @if($product->body)
        <div class="max-w-3xl mx-auto mb-20">
            <div class="prose prose-lg prose-slate max-w-none text-gray-600">
                {!! $product->body !!}
            </div>
        </div>
        @endif

        <!-- Reviews -->
        <div class="border-t border-gray-100 pt-16 mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-10 font-cormorant">{{ __('products.customer_reviews') }}</h2>
            @if($reviews->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach($reviews as $review)
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <div class="flex gap-0.5 mb-3">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-amber-400 fill-amber-400' : 'text-gray-200 fill-gray-200' }}" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4 italic">"{{ $review->comment }}"</p>
                    <p class="font-semibold text-gray-900 text-sm">{{ $review->name }}</p>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-400 mb-10">{{ __('products.no_reviews') }}</p>
            @endif

            <!-- Submit Review -->
            <div class="max-w-xl bg-blue-50 rounded-2xl p-6 border border-blue-100">
                <h3 class="font-bold text-gray-900 mb-4">{{ __('products.write_review') }}</h3>
                <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="text" name="name" placeholder="{{ __('products.name_placeholder') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                    <div x-data="{ rating: 5 }" class="flex gap-2 items-center">
                        <span class="text-sm text-gray-600 mr-2">{{ __('products.rating_label') }}:</span>
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button" @click="rating = {{ $i }}"
                                :class="rating >= {{ $i }} ? 'text-amber-400' : 'text-gray-300'"
                                class="text-2xl transition-colors">★</button>
                        @endfor
                        <input type="hidden" name="rating" :value="rating">
                    </div>
                    <textarea name="comment" rows="3" placeholder="{{ __('products.comment_placeholder') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none"></textarea>
                    <button type="submit" class="w-full bg-miruku-blue hover:bg-miruku-dark text-white font-semibold py-3 rounded-xl transition-colors">{{ __('products.submit_review') }}</button>
                </form>
            </div>
        </div>

        <!-- Related Products -->
        @if($related->count() > 0)
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-8 font-cormorant">{{ __('products.other_products') }}</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($related as $item)
                <a href="{{ route('products.show', $item->slug) }}"
                   class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    <div class="aspect-video overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-50">
                        @if($item->image)
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-6xl">
                            {{ $item->variant === 'original' ? '🥛' : ($item->variant === 'chocolate' ? '🍫' : '🍌') }}
                        </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-900 mb-1 group-hover:text-miruku-blue transition-colors">{{ $item->name }}</h3>
                        <p class="text-miruku-blue font-bold font-cormorant text-xl">{{ $item->formatted_price }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

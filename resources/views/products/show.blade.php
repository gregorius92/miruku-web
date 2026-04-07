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
        "availability": "https://schema.org/InStock"
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
                    {{ $product->variantInfo->color_class ?? 'from-blue-50 to-indigo-100' }}">
                    @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex flex-col items-center justify-center">
                        <div class="text-[140px]">{{ $product->variant === 'original' ? '🥛' : ($product->variant === 'chocolate' ? '🍫' : '🍌') }}</div>
                        <p class="text-miruku-blue font-cormorant text-2xl italic mt-4">{{ $product->name }}</p>
                    </div>
                    @endif
                </div>
                @if($product->is_best_seller)
                <div class="absolute top-6 left-6 bg-miruku-blue text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg z-10">
                    ⭐ {{ __('products.best_seller') }}
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="pt-4">
                <span class="inline-flex items-center gap-1 text-xs font-bold uppercase tracking-wider text-miruku-blue bg-blue-50 px-3 py-1.5 rounded-full mb-4">
                    {{ __('products.variant_label', ['variant' => $product->variantInfo->name ?? ucfirst($product->variant)]) }}
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

                <!-- Benefits list -->
                <div class="bg-blue-50 rounded-2xl p-5 mb-8">
                    <h4 class="font-semibold text-gray-900 mb-3 text-sm uppercase tracking-wide">{{ __('products.inside_miruku') }}</h4>
                    <div class="grid grid-cols-2 gap-2">
                        @php
                            $benefits = $product->benefits ?? __('products.benefits');
                        @endphp
                        @foreach($benefits as $benefit)
                        <div class="flex items-center gap-2 text-sm text-gray-700">
                            <svg class="w-4 h-4 text-miruku-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $benefit }}
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- CTAs (Marketplaces) -->
                <div class="space-y-4">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest px-1">{{ __('products.buy_now_at') }}</h4>
                    <div class="flex flex-wrap gap-4">
                        @forelse($product->marketplaces as $mp)
                            <a href="{{ $mp->url }}" target="_blank" rel="noopener noreferrer" 
                               @if(str_starts_with($mp->color, 'bg-['))
                                   style="background-color: {{ str_replace(['bg-[', ']'], '', $mp->color) }}"
                               @endif
                               class="flex-1 min-w-[140px] {{ !str_starts_with($mp->color, 'bg-[') ? $mp->color : '' }} hover:brightness-110 text-white font-bold py-4 px-6 rounded-full text-center transition-all duration-300 shadow-lg hover:scale-[1.02]">
                                {{ $mp->name }}
                            </a>
                        @empty
                            <p class="text-gray-400 text-sm italic px-1">{{ __('products.no_marketplaces') }}</p>
                        @endforelse
                    </div>

                    <!-- Share Section -->
                    <div class="pt-6 border-t border-gray-50 flex items-center gap-4" x-data="{ copied: false }">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ __('products.share_product') }}:</span>
                        <div class="flex gap-2">
                            <!-- WhatsApp -->
                            <a href="https://wa.me/?text={{ urlencode($product->name . ' ' . url()->current()) }}" target="_blank" class="w-9 h-9 rounded-full border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-green-50 hover:text-green-600 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.01 2.01c-5.52 0-9.99 4.47-9.99 9.99 0 1.77.46 3.42 1.25 4.86L2 22l5.31-1.39c1.39.75 2.97 1.18 4.65 1.18 5.52 0 9.99-4.47 9.99-9.99a9.99 9.99 0 0 0-9.94-9.79zm5.35 14.23c-.23.64-1.31 1.22-1.81 1.3-1.01.16-2.58-.27-4.48-1.57-1.46-1-2.48-2.61-2.83-3.1s-.41-.58-.5-1c-.08-.43.08-.82.16-1 .08-.18.23-.31.32-.42.09-.1.12-.17.18-.28.06-.11.03-.21-.01-.3-.04-.09-.32-.78-.44-1.07-.12-.29-.24-.25-.33-.25-.09 0-.2-.01-.32-.01s-.3.04-.46.21c-.16.16-.62.6-.62 1.48 0 .88.64 1.73.73 1.85s1.26 1.93 3.05 2.7c1.79.77 1.79.52 2.12.49.33-.03 1.05-.43 1.2-.84.15-.41.15-.76.1-.84-.04-.08-.17-.12-.35-.21-.18-.09-1.05-.52-1.21-.58-.16-.06-.27-.09-.39.09-.12.18-.45.58-.55.7-.1.12-.2.13-.38.04s-.76-.28-1.45-.9c-.53-.47-.89-1.05-1-1.23-.1-.18-.01-.28.08-.37.08-.08.18-.21.27-.32.09-.11.12-.18.18-.3.06-.12.03-.22-.01-.3-.04-.08-.35-.84-.48-1.15-.13-.3-.26-.25-.35-.26h-.3c-.11 0-.27.04-.42.21-.15.17-.6.59-.6 1.43 0 .84.62 1.66.71 1.77.09.12 1.22 1.86 2.96 2.61.41.18.82.33 1.11.42.42.14.8.12 1.1.07.33-.04 1.05-.43 1.2-.84.15-.41.15-.76.09-.84-.05-.08-.18-.12-.36-.21z"/></svg>
                            </a>
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-9 h-9 rounded-full border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-blue-50 hover:text-blue-700 transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.8c4.56-.93 8-4.96 8-9.8z"/></svg>
                            </a>
                            <!-- Copy -->
                            <div class="relative">
                                <button @click="navigator.clipboard.writeText('{{ url()->current() }}'); copied = true; setTimeout(() => copied = false, 2000)"
                                        class="w-9 h-9 rounded-full border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-miruku-blue hover:text-white transition-all">
                                    <svg x-show="!copied" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    <svg x-show="copied" x-cloak class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </button>
                                <div x-show="copied" x-cloak x-transition class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 text-white text-[10px] rounded whitespace-nowrap">Tersalin!</div>
                            </div>
                        </div>
                    </div>
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
            <div class="max-w-xl bg-blue-50 rounded-2xl p-6 border border-blue-100" x-data="reviewForm()">
                <h3 class="font-bold text-gray-900 mb-4">{{ __('products.write_review') }}</h3>

                <div x-show="successMessage" x-transition
                     class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span x-text="successMessage"></span>
                </div>

                <div x-show="errorMessage" x-transition
                     class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span x-text="errorMessage"></span>
                </div>

                <form @submit.prevent="submit" class="space-y-4" x-show="!successMessage">
                    <input type="hidden" name="product_id" x-model="formData.product_id">
                    <input type="text" name="name" x-model="formData.name" placeholder="{{ __('products.name_placeholder') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue">
                    <div class="flex gap-2 items-center">
                        <span class="text-sm text-gray-600 mr-2">{{ __('products.rating_label') }}:</span>
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button" @click="formData.rating = {{ $i }}"
                                :class="formData.rating >= {{ $i }} ? 'text-amber-400' : 'text-gray-300'"
                                class="text-2xl transition-colors">★</button>
                        @endfor
                    </div>
                    <textarea name="comment" x-model="formData.comment" rows="3" placeholder="{{ __('products.comment_placeholder') }}" required class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue resize-none"></textarea>
                    
                    <button type="submit" :disabled="loading"
                        class="w-full bg-miruku-blue hover:bg-miruku-dark text-white font-semibold py-3 rounded-xl transition-colors disabled:opacity-50 flex items-center justify-center gap-2">
                        <svg x-show="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span x-text="loading ? 'Mengirim...' : '{{ __('products.submit_review') }}'"></span>
                    </button>
                </form>

                <div x-show="successMessage" class="text-center py-4">
                    <button @click="resetForm" class="text-miruku-blue font-semibold hover:underline text-sm">
                        {{ __('home.send_another_review') }}
                    </button>
                </div>

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
                            {{ $item->variantInfo->icon ?? '🥛' }}
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

@push('scripts')
<script>
    function reviewForm() {
        return {
            formData: {
                name: '',
                email: '',
                rating: 5,
                comment: '',
                product_id: '{{ $product->id }}'
            },
            loading: false,
            successMessage: '',
            errorMessage: '',
            async submit() {
                this.loading = true;
                this.successMessage = '';
                this.errorMessage = '';

                try {
                    const response = await fetch('{{ route('reviews.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(this.formData)
                    });


                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        const result = await response.json();
                        if (response.ok) {
                            this.successMessage = result.message;
                            this.formData.comment = '';
                        } else {
                            this.errorMessage = result.message || '{{ __('home.review_error_default') }}';
                        }
                    } else {
                        // If not JSON, it might be a 500 or 419 error page
                        const errorText = await response.text();
                        console.error('Server error response:', errorText);
                        if (response.status === 419) {
                            this.errorMessage = 'Sesi telah berakhir. Silakan refresh halaman.';
                        } else {
                            this.errorMessage = 'Terjadi kesalahan pada server (Error ' + response.status + ').';
                        }
                    }
                } catch (error) {
                    console.error('Review submission error:', error);
                    this.errorMessage = '{{ __('home.review_error_connection') }}';
                } finally {
                    this.loading = false;
                }


            },
            resetForm() {
                this.successMessage = '';
                this.errorMessage = '';
                this.formData.comment = '';
            }
        }
    }
</script>
@endpush


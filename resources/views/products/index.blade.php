@extends('layouts.app')

@section('content')
<div class="pt-24 pb-16" x-data="productFilter()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <span class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('products.hero_badge') }}</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 font-cormorant">{{ __('products.hero_title') }}</h1>
            <p class="text-gray-500 mt-4 text-lg max-w-2xl mx-auto">{{ __('products.hero_subtitle') }}</p>
        </div>

        <!-- Filters -->
        <div class="space-y-6 mb-12">
            <!-- Unit/Size Filter (Kategori) -->
            <div class="flex flex-wrap justify-center gap-3">
                <button @click="changeCategory('all')"
                   :class="activeUnit === 'all' ? 'bg-miruku-blue border-miruku-blue text-white shadow-lg shadow-miruku-blue/20' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50'"
                   class="px-6 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">
                    {{ __('products.all_categories') }}
                </button>
                @foreach($units as $u)
                <button @click="changeCategory('{{ $u->slug }}')"
                   :class="activeUnit === '{{ $u->slug }}' ? 'bg-miruku-blue border-miruku-blue text-white shadow-lg shadow-miruku-blue/20' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50'"
                   class="px-6 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">
                    {{ $u->name }}
                </button>
                @endforeach
            </div>
        </div>

        @if($products->count() > 0)
        <!-- Products Grid -->
        <div id="product-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @include('products._product_list')
        </div>

        <!-- Pagination / Load More -->
        <div class="mt-16 flex flex-col items-center justify-center space-y-6">
            <!-- Load More Button -->
            <div x-show="hasMore && !loading" x-cloak>
                <button @click="loadNextPage()"
                    class="bg-miruku-blue hover:bg-miruku-dark text-white font-bold px-10 py-4 rounded-full transition-all duration-300 shadow-xl shadow-miruku-blue/20 transform hover:-translate-y-1 active:scale-95 flex items-center gap-3">
                    {{ __('products.load_more') }}
                    <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            <!-- Loading Spinner -->
            <div x-show="loading" x-cloak class="text-center">
                <div class="w-12 h-12 border-4 border-miruku-blue/20 border-t-miruku-blue rounded-full animate-spin mx-auto"></div>
                <p class="text-sm text-gray-500 font-medium mt-4">{{ __('products.loading') }}</p>
            </div>

            <!-- End of Content -->
            <div x-show="!hasMore && !loading && {{ $products->total() }} > 0" x-cloak class="text-center">
                <div class="text-3xl mb-2">✨</div>
                <p class="text-gray-400 font-medium text-sm">{{ __('products.all_loaded') }}</p>
            </div>
        </div>
        @else
        <div class="text-center py-20">
            <div class="text-6xl mb-4">🥛</div>
            <p class="text-gray-400">{{ __('products.not_found') }}</p>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function productFilter() {
    return {
        activeUnit: 'all',
        page: {{ $products->currentPage() + 1 }},
        loading: false,
        hasMore: {{ $products->hasMorePages() ? 'true' : 'false' }},
        
        init() {
            console.log('Product filter initialized', { page: this.page, hasMore: this.hasMore });
        },
        
        async changeCategory(unit) {
            if (this.loading) return;
            
            console.log('Changing category to:', unit);
            this.activeUnit = unit;
            this.page = 1;
            this.hasMore = true;
            this.loading = true;
            
            document.getElementById('product-grid').innerHTML = ''; // Clear grid
            await this.loadNextPage(true);
        },
        
        async loadNextPage(reset = false) {
            if (this.loading && !reset) return;
            this.loading = true;
            
            try {
                // Robust URL construction
                const baseUrl = '{{ route('products.index', [], false) }}';
                const url = new URL(baseUrl, window.location.origin);
                
                if (this.activeUnit !== 'all') {
                    url.searchParams.set('unit', this.activeUnit);
                }
                url.searchParams.set('page', this.page);
                
                console.log('Fetching products:', url.toString());
                
                const response = await fetch(url.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                if (!response.ok) throw new Error('Response error: ' + response.status);
                
                const html = await response.text();
                const trimmedHtml = html.trim();
                
                if (trimmedHtml.length > 0) {
                    document.getElementById('product-grid').insertAdjacentHTML('beforeend', trimmedHtml);
                    
                    if (typeof AOS !== 'undefined') {
                        AOS.refresh();
                    }
                    
                    this.page++;
                    console.log('Loaded products. Next page is:', this.page);
                } else {
                    console.log('Empty response, no more products.');
                    this.hasMore = false;
                }
            } catch (error) {
                console.error('Fetch error:', error);
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
@endpush
@endsection

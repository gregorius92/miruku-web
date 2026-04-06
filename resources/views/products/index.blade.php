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

        <!-- Filters -->
        <div class="space-y-6 mb-12">
            <!-- Unit/Size Filter (Kategori) -->
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('products.index', request()->except('unit')) }}"
                   class="px-6 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200 {{ !request('unit') ? 'bg-miruku-blue border-miruku-blue text-white shadow-lg shadow-miruku-blue/20' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                    {{ __('products.all_categories') }}
                </a>
                @foreach($units as $u)
                <a href="{{ route('products.index', array_merge(request()->query(), ['unit' => $u->slug])) }}"
                   class="px-6 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200 {{ request('unit') === $u->slug ? 'bg-miruku-blue border-miruku-blue text-white shadow-lg shadow-miruku-blue/20' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                    {{ $u->name }}
                </a>
                @endforeach
            </div>
        </div>

        @if($products->count() > 0)
        <!-- Products Grid -->
        <div id="product-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @include('products._product_list')
        </div>

        <!-- Loading Sentinel -->
        <div id="loading-sentinel" class="mt-16 flex flex-col items-center justify-center space-y-4 py-8">
            <div id="loading-spinner" class="hidden">
                <div class="w-12 h-12 border-4 border-miruku-blue/20 border-t-miruku-blue rounded-full animate-spin"></div>
                <p class="text-sm text-gray-500 font-medium mt-4">{{ __('products.loading') }}</p>
            </div>
            <div id="end-of-content" class="hidden text-center">
                <div class="text-3xl mb-2">✨</div>
                <p class="text-gray-400 font-medium text-sm">{{ __('products.all_loaded') }}</p>
            </div>
        </div>

        <!-- Hidden Standard Pagination (Used to get next page URL) -->
        <div id="pagination-wrapper" class="hidden">
            {{ $products->links() }}
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
document.addEventListener('DOMContentLoaded', function() {
    let nextPageUrl = document.querySelector('#pagination-wrapper a[rel="next"]')?.href;
    const grid = document.querySelector('#product-grid');
    const sentinel = document.querySelector('#loading-sentinel');
    const spinner = document.querySelector('#loading-spinner');
    const endMessage = document.querySelector('#end-of-content');
    
    if (!nextPageUrl) {
        if (grid.children.length > 0) {
            endMessage.classList.remove('hidden');
        }
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting && nextPageUrl) {
            loadMoreProducts();
        }
    }, {
        rootMargin: '200px'
    });

    observer.observe(sentinel);

    async function loadMoreProducts() {
        if (!nextPageUrl) return;
        
        const currentUrl = nextPageUrl;
        nextPageUrl = null; // Prevent double trigger
        
        spinner.classList.remove('hidden');
        
        try {
            const response = await fetch(currentUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (!response.ok) throw new Error('Network response was not ok');
            
            const html = await response.text();
            
            // Append new items
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = html;
            
            // Re-enable AOS if exists
            const newItems = tempDiv.querySelectorAll('[data-aos]');
            
            grid.insertAdjacentHTML('beforeend', html);
            
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }

            // Get the next page URL from the new response if we were to parse the whole page, 
            // but since we only return partial, we need to handle pagination differently.
            // Better approach: the Controller should ideally return JSON with html and next_page_url,
            // OR we can just keep fetching page 2, 3, etc. until we get empty results.
            
            // Let's refine the controller or the logic:
            // Since we're using standard Laravel pagination, let's just increment a counter.
            const url = new URL(currentUrl);
            let currentPage = parseInt(url.searchParams.get('page')) || 1;
            const nextPage = currentPage + 1;
            url.searchParams.set('page', nextPage);
            
            // Check if we should continue
            if (html.trim().length > 0) {
                nextPageUrl = url.toString();
            } else {
                nextPageUrl = null;
                endMessage.classList.remove('hidden');
            }
            
        } catch (error) {
            console.error('Error loading more products:', error);
        } finally {
            spinner.classList.add('hidden');
        }
    }
});
</script>
@endpush
@endsection

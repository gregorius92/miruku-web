@extends('layouts.app')

@section('content')
<section class="relative py-24 lg:py-32 overflow-hidden bg-miruku-blue miruku-pattern">
    <div class="absolute inset-0 bg-miruku-dark/20 pointer-events-none"></div>
    
    <!-- Organic Wave Bottom -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] transform rotate-180">
        <svg class="relative block w-full h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#F9FAFB" opacity="1"></path>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-slide-up">
            {{ __('blog.title') }}
        </h1>
        <p class="text-xl text-white/80 max-w-2xl mx-auto animate-fade-in">
            {{ __('blog.subtitle') }}
        </p>
    </div>
</section>

<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($posts->count() > 0)
        <!-- Blog Grid -->
        <div id="blog-grid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @include('blog._blog_list')
        </div>

        <!-- Loading Sentinel -->
        <div id="loading-sentinel" class="mt-8 flex flex-col items-center justify-center space-y-4 py-8">
            <div id="loading-spinner" class="hidden">
                <div class="w-12 h-12 border-4 border-miruku-blue/20 border-t-miruku-blue rounded-full animate-spin"></div>
                <p class="text-sm text-gray-400 font-medium mt-4">{{ __('blog.loading') }}</p>
            </div>
            <div id="end-of-content" class="hidden text-center mt-8">
                <div class="text-3xl mb-2">✨</div>
                <p class="text-gray-400 font-medium text-sm">{{ __('blog.all_loaded') }}</p>
            </div>
        </div>

        <!-- Hidden Standard Pagination -->
        <div id="pagination-wrapper" class="hidden">
            {{ $posts->links() }}
        </div>
        @else
        <div class="text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-200" data-aos="fade-up">
            <div class="text-6xl mb-6">📝</div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ __('blog.empty_title') }}</h3>
            <p class="text-gray-500">{{ __('blog.empty_subtitle') }}</p>
        </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let nextPageUrl = document.querySelector('#pagination-wrapper a[rel="next"]')?.href;
    const grid = document.querySelector('#blog-grid');
    const sentinel = document.querySelector('#loading-sentinel');
    const spinner = document.querySelector('#loading-spinner');
    const endMessage = document.querySelector('#end-of-content');
    
    if (!nextPageUrl) {
        if (grid && grid.children.length > 0) {
            endMessage.classList.remove('hidden');
        }
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting && nextPageUrl) {
            loadMorePosts();
        }
    }, {
        rootMargin: '200px'
    });

    observer.observe(sentinel);

    async function loadMorePosts() {
        if (!nextPageUrl) return;
        
        const currentUrl = nextPageUrl;
        nextPageUrl = null; 
        
        spinner.classList.remove('hidden');
        
        try {
            const response = await fetch(currentUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (!response.ok) throw new Error('Network response was not ok');
            
            const html = await response.text();
            
            if (html.trim().length > 0) {
                grid.insertAdjacentHTML('beforeend', html);
                
                // Refresh AOS
                if (typeof AOS !== 'undefined') {
                    AOS.refresh();
                }

                // Increment page for next URL
                const url = new URL(currentUrl);
                let currentPage = parseInt(url.searchParams.get('page')) || 1;
                url.searchParams.set('page', currentPage + 1);
                nextPageUrl = url.toString();
            } else {
                nextPageUrl = null;
                endMessage.classList.remove('hidden');
            }
            
        } catch (error) {
            console.error('Error loading more posts:', error);
        } finally {
            spinner.classList.add('hidden');
        }
    }
});
</script>
@endpush
@endsection

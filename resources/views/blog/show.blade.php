@extends('layouts.app')

@section('content')
<article class="relative min-h-screen bg-white">
    <!-- Post Header -->
    <!-- Post Header -->
    <header class="relative py-24 lg:py-32 overflow-hidden bg-miruku-blue miruku-pattern">
        <div class="absolute inset-0 bg-miruku-dark/20 pointer-events-none"></div>
        
        <!-- Background Image (Optional Overlay) -->
        <div class="absolute inset-0 opacity-10 filter blur-3xl scale-110 pointer-events-none">
            <img src="{{ $post->image_url }}" alt="" class="w-full h-full object-cover">
        </div>

        <!-- Organic Wave Bottom -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] transform rotate-180">
            <svg class="relative block w-full h-[150px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#FFFFFF" opacity="1"></path>
            </svg>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-4 py-2 rounded-full text-white text-xs font-bold uppercase tracking-widest mb-8 border border-white/10 animate-fade-in">
                {{ $post->published_at->format('d M Y') }}
                <span class="w-1 h-1 rounded-full bg-white/50"></span>
                {{ number_format($post->view_count) }} {{ __('blog.views') }}
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-8 leading-tight animate-slide-up">
                {{ $post->title }}
            </h1>
        </div>
    </header>

    <!-- Content Container -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 relative z-20 pb-20">
        <!-- Featured Image Card -->
        <div class="bg-white rounded-[40px] overflow-hidden shadow-2xl shadow-blue-900/10 mb-16 border border-gray-100" data-aos="zoom-in" data-aos-duration="1000">
            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full aspect-[16/9] object-cover">
        </div>

        <!-- Post Body -->
        <div class="prose prose-lg md:prose-xl max-w-none prose-miruku prose-img:rounded-3xl prose-headings:text-gray-900 prose-p:text-gray-600 prose-a:text-miruku-blue prose-strong:text-gray-900 mb-20" data-aos="fade-up">
            {!! $post->content !!}
        </div>

        <!-- Author/Footer -->
        <div class="border-t border-gray-100 pt-10 flex flex-col sm:flex-row items-center justify-between gap-6" data-aos="fade-up">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 group text-gray-500 hover:text-miruku-blue font-bold transition-colors">
                <svg class="w-5 h-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                {{ __('blog.back_to_list') }}
            </a>
            <div class="flex items-center gap-4" x-data="{ copied: false }">
                <p class="text-sm font-medium text-gray-400">{{ __('blog.share_this') }}:</p>
                <div class="flex gap-2">
                    <!-- WhatsApp -->
                    <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" class="w-10 h-10 rounded-full border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-green-50 hover:text-green-600 transition-all" title="Share to WhatsApp">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.01 2.01c-5.52 0-9.99 4.47-9.99 9.99 0 1.77.46 3.42 1.25 4.86L2 22l5.31-1.39c1.39.75 2.97 1.18 4.65 1.18 5.52 0 9.99-4.47 9.99-9.99a9.99 9.99 0 0 0-9.94-9.79zm5.35 14.23c-.23.64-1.31 1.22-1.81 1.3-1.01.16-2.58-.27-4.48-1.57-1.46-1-2.48-2.61-2.83-3.1s-.41-.58-.5-1c-.08-.43.08-.82.16-1 .08-.18.23-.31.32-.42.09-.1.12-.17.18-.28.06-.11.03-.21-.01-.3-.04-.09-.32-.78-.44-1.07-.12-.29-.24-.25-.33-.25-.09 0-.2-.01-.32-.01s-.3.04-.46.21c-.16.16-.62.6-.62 1.48 0 .88.64 1.73.73 1.85s1.26 1.93 3.05 2.7c1.79.77 1.79.52 2.12.49.33-.03 1.05-.43 1.2-.84.15-.41.15-.76.1-.84-.04-.08-.17-.12-.35-.21-.18-.09-1.05-.52-1.21-.58-.16-.06-.27-.09-.39.09-.12.18-.45.58-.55.7-.1.12-.2.13-.38.04s-.76-.28-1.45-.9c-.53-.47-.89-1.05-1-1.23-.1-.18-.01-.28.08-.37.08-.08.18-.21.27-.32.09-.11.12-.18.18-.3.06-.12.03-.22-.01-.3-.04-.08-.35-.84-.48-1.15-.13-.3-.26-.25-.35-.26h-.3c-.11 0-.27.04-.42.21-.15.17-.6.59-.6 1.43 0 .84.62 1.66.71 1.77.09.12 1.22 1.86 2.96 2.61.41.18.82.33 1.11.42.42.14.8.12 1.1.07.33-.04 1.05-.43 1.2-.84.15-.41.15-.76.09-.84-.05-.08-.18-.12-.36-.21z"/></svg>
                    </a>
                    
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-10 h-10 rounded-full border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-blue-50 hover:text-blue-700 transition-all" title="Share to Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.8c4.56-.93 8-4.96 8-9.8z"/></svg>
                    </a>

                    <!-- Twitter / X -->
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ url()->current() }}" target="_blank" class="w-10 h-10 rounded-full border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:text-black transition-all" title="Share to X">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>

                    <!-- Copy Link -->
                    <div class="relative">
                        <button 
                            @click="navigator.clipboard.writeText('{{ url()->current() }}'); copied = true; setTimeout(() => copied = false, 2000)"
                            class="w-10 h-10 rounded-full border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-miruku-blue hover:text-white transition-all" 
                            title="Copy Link">
                            <svg x-show="!copied" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <svg x-show="copied" x-cloak class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </button>
                        <div x-show="copied" x-cloak x-transition class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 bg-gray-900 text-white text-[10px] rounded whitespace-nowrap">
                            Tersalin!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($relatedPosts->count() > 0)
    <!-- Related Posts Section -->
    <section class="bg-gray-50 py-24 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold px-10 text-gray-900 mb-12 text-center" data-aos="fade-up">{{ __('blog.related_posts') }}</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($relatedPosts as $related)
                <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 group border border-gray-100 flex flex-col h-full" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <a href="{{ route('blog.show', $related) }}" class="relative block aspect-[16/10] overflow-hidden">
                        <img src="{{ $related->image_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </a>
                    <div class="p-8 flex flex-col flex-1">
                        <div class="text-[10px] uppercase font-bold tracking-widest text-miruku-blue mb-3">
                            {{ $related->published_at->format('M d, Y') }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-miruku-blue transition-colors line-clamp-2">
                            <a href="{{ route('blog.show', $related) }}">{{ $related->title }}</a>
                        </h3>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</article>

<style>
/* Custom prose scaling for miruku style */
.prose-miruku p {
    color: #4B5563; /* text-gray-600 */
    line-height: 1.8;
}
.prose-miruku h2, .prose-miruku h3, .prose-miruku h4 {
    color: #111827; /* text-gray-900 */
    font-weight: 800;
}
</style>
@endsection

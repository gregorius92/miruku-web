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
            <div class="flex items-center gap-4">
                <p class="text-sm font-medium text-gray-400">{{ __('blog.share_this') }}:</p>
                <div class="flex gap-2">
                    <button class="w-10 h-10 rounded-full border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-blue-50 hover:text-miruku-blue transition-all" title="Copy Link">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </button>
                    <!-- More social icons if needed -->
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

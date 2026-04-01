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
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach($posts as $post)
            <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 group border border-gray-100 flex flex-col h-full" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <a href="{{ route('blog.show', $post) }}" class="relative block aspect-[16/10] overflow-hidden">
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/90 backdrop-blur-md text-miruku-blue text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                            {{ $post->published_at->format('M d, Y') }}
                        </span>
                    </div>
                </a>
                <div class="p-8 flex flex-col flex-1">
                    <h2 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-miruku-blue transition-colors">
                        <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                    </h2>
                    <div class="text-gray-500 text-sm mb-6 line-clamp-4">
                        {!! Str::limit(strip_tags($post->content), 200) !!}
                    </div>
                    <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('blog.show', $post) }}" class="text-sm font-bold text-miruku-blue flex items-center gap-2 group/link">
                            {{ __('blog.read_more') }}
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <span class="text-xs text-gray-400 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            {{ number_format($post->view_count) }}
                        </span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="mt-12">
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
@endsection

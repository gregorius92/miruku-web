@foreach($posts as $post)
<article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 group border border-gray-100 flex flex-col h-full" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
    <a href="{{ route('articles.show', $post) }}" class="relative block aspect-[16/10] overflow-hidden">
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
            <a href="{{ route('articles.show', $post) }}">{{ $post->title }}</a>
        </h2>
        <div class="text-gray-500 text-sm mb-6 line-clamp-4">
            {!! Str::limit(strip_tags($post->content), 200) !!}
        </div>
        <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
            <a href="{{ route('articles.show', $post) }}" class="text-sm font-bold text-miruku-blue flex items-center gap-2 group/link">
                {{ __('articles.read_more') }}
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

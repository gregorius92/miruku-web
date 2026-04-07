@foreach($products as $product)
<div x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform scale-95"
     x-transition:enter-end="opacity-100 transform scale-100"
     class="group bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
    <div class="aspect-square overflow-hidden bg-gradient-to-br
        {{ $product->variantInfo->color_class ?? 'from-blue-50 to-indigo-50' }}">
        @if($product->image)
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
        @else
        <div class="w-full h-full flex items-center justify-center text-7xl">
            {{ $product->variantInfo->icon ?? '🥛' }}
        </div>
        @endif
    </div>
    @if($product->is_featured)
    <div class="absolute -mt-40 ml-4">
        <span class="bg-miruku-blue text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">⭐ {{ __('products.best_seller') }}</span>
    </div>
    @endif
    <div class="p-6">
        <div class="flex items-center gap-2 mb-3">
            <span class="text-[10px] font-bold uppercase tracking-wider text-miruku-blue bg-blue-50 px-2.5 py-1 rounded-full">{{ $product->variantInfo->name ?? ucfirst($product->variant) }}</span>
            <span class="text-[10px] font-bold uppercase tracking-wider text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">{{ $product->unitInfo->name ?? $product->unit }}</span>
        </div>
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
@endforeach

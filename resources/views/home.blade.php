@extends('layouts.app')

@section('content')

{{-- =============================================
     1. HERO CAROUSEL
     ============================================= --}}
<section id="hero" class="relative h-screen min-h-[600px] overflow-hidden">
    <div class="swiper hero-swiper h-full">
        <div class="swiper-wrapper">
            @forelse($carousels as $slide)
            <div class="swiper-slide relative">
                <!-- Background Image -->
                <div class="absolute inset-0 bg-gradient-to-r from-gray-950/80 via-gray-900/60 to-gray-800/40">
                    @if($slide->image)
                    <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}"
                         class="absolute inset-0 w-full h-full object-cover -z-10">
                    @else
                    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-miruku-dark via-miruku-blue to-gray-900"></div>
                    @endif
                </div>

                <!-- Floating abstract shapes -->
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-20 right-20 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute bottom-20 left-32 w-48 h-48 bg-blue-300/20 rounded-full blur-2xl animate-pulse" style="animation-delay: 1s"></div>
                </div>

                <!-- Content -->
                <div class="relative h-full flex items-center">
                    <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full">
                        <div class="max-w-2xl">
                            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 px-4 py-2 rounded-full text-sm font-medium mb-6 animate-fade-in">
                                <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                                {{ __('home.hero_badge') }}
                            </div>
                            <h1 class="text-5xl lg:text-7xl font-bold text-white mb-6 leading-tight font-cormorant animate-slide-up">
                                {{ $slide->title }}
                            </h1>
                            @if($slide->subtitle)
                            <p class="text-white/80 text-lg lg:text-xl mb-10 leading-relaxed animate-slide-up" style="animation-delay: 100ms">
                                {{ $slide->subtitle }}
                            </p>
                            @endif
                            <div class="flex flex-wrap gap-4 animate-slide-up" style="animation-delay: 200ms">
                                @if($slide->button_text)
                                <a href="{{ $slide->button_link ?? route('products.index') }}"
                                   class="inline-flex items-center gap-2 bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 hover:scale-105 shadow-xl shadow-miruku-blue/30">
                                    {{ $slide->button_text }}
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                                @endif
                                @if($slide->button2_text)
                                <a href="{{ $slide->button2_link ?? '#about' }}"
                                   class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/30 text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 hover:scale-105">
                                    {{ $slide->button2_text }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="swiper-slide relative">
                <div class="absolute inset-0 bg-gradient-to-br from-miruku-dark via-miruku-blue to-gray-900"></div>
                <div class="relative h-full flex items-center justify-center text-center">
                    <div class="max-w-2xl px-6">
                        <h1 class="text-6xl font-bold text-white mb-6 font-cormorant">{{ __('home.hero_default_title', ['title' => 'Susu Premium Tanpa Batas']) }}</h1>
                        <p class="text-white/80 text-xl mb-10">{{ __('home.hero_default_subtitle', ['subtitle' => '0% Lactose. 100% Kenikmatan.']) }}</p>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-miruku-blue text-white font-semibold px-8 py-4 rounded-full hover:bg-miruku-dark transition-all">
                            {{ __('home.explore_products', ['text' => 'Jelajahi Produk']) }}
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Navigation -->
        <div class="swiper-button-prev !text-white !w-14 !h-14 !bg-white/10 !rounded-full backdrop-blur-md after:hidden hover:!bg-white/20 transition-all duration-500 flex items-center justify-center group/nav shadow-2xl animate-float">
            <svg class="w-6 h-6 transition-transform duration-500 group-hover/nav:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </div>
        <div class="swiper-button-next !text-white !w-14 !h-14 !bg-white/10 !rounded-full backdrop-blur-md after:hidden hover:!bg-white/20 transition-all duration-500 flex items-center justify-center group/nav shadow-2xl animate-float" style="animation-delay: 1.5s">
            <svg class="w-6 h-6 transition-transform duration-500 group-hover/nav:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </div>

        <!-- Pagination -->
        <div class="swiper-pagination !bottom-8"></div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-12 left-1/2 -translate-x-1/2 animate-bounce hidden md:block">
        <div class="w-6 h-10 rounded-full border-2 border-white/40 flex items-start justify-center pt-2">
            <div class="w-1 h-2 bg-white/60 rounded-full animate-scroll-dot"></div>
        </div>
    </div>
</section>

{{-- =============================================
     2. ABOUT MIRUKU
     ============================================= --}}
<section id="about" class="py-24 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Text -->
            <div data-aos="fade-right">
                <span class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.about_badge') }}</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 font-cormorant leading-tight">
                    {{ $sections['about']->title ?? 'Kenali Miruku' }}
                </h2>
                <p class="text-gray-500 text-lg leading-relaxed mb-8">
                    {{ $sections['about']->content ?? 'Miruku hadir sebagai jawaban atas kebutuhan Anda akan susu berkualitas premium yang ramah bagi sistem pencernaan.' }}
                </p>

                <!-- Bullet Points -->
                <div class="space-y-4">
                    @foreach([
                        ['icon' => '🥛', 'title' => '0% Lactose', 'desc' => 'Aman untuk penderita lactose intolerance'],
                        ['icon' => '✨', 'title' => 'Tekstur Creamy', 'desc' => 'Kelezatan premium di setiap tegukan'],
                        ['icon' => '💚', 'title' => 'Mudah Dicerna', 'desc' => 'Nyaman di perut, energi sepanjang hari'],
                    ] as $point)
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-2xl">
                            {{ $point['icon'] }}
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $point['title'] }}</h4>
                            <p class="text-gray-500 text-sm">{{ $point['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    <a href="{{ route('about') }}" class="inline-flex items-center gap-2 text-miruku-blue font-semibold hover:gap-4 transition-all duration-300">
                        {{ __('home.learn_more') }}
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Image -->
            <div class="relative" data-aos="fade-left">
                <div class="aspect-square rounded-3xl overflow-hidden bg-gradient-to-br from-blue-100 to-indigo-50">
                    <div class="w-full h-full flex items-center justify-center">
                        <div class="text-center p-12">
                            <div class="text-[120px] mb-4">🥛</div>
                            <p class="text-miruku-blue font-cormorant text-2xl italic">Pure. Natural. Premium.</p>
                        </div>
                    </div>
                </div>
                <!-- Floating badge -->
                <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-2xl p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-miruku-blue rounded-xl flex items-center justify-center text-white text-xl">⭐</div>
                        <div>
                            <p class="font-bold text-gray-900 text-xl">4.9/5</p>
                            <p class="text-gray-500 text-xs">{{ __('home.total_reviews') }}</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -top-6 -right-6 bg-miruku-blue text-white rounded-2xl shadow-2xl p-5 text-center">
                    <p class="text-3xl font-bold font-cormorant">99%</p>
                    <p class="text-xs text-blue-100">{{ __('home.lactose_free') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =============================================
     3. COMPARISON SECTION
     ============================================= --}}
<section id="comparison" class="py-24 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.comparison_badge') }}</span>
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 font-cormorant">{{ __('home.comparison_title') }}</h2>
            <p class="text-gray-500 mt-4 text-lg">{{ __('home.comparison_subtitle') }}</p>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="grid grid-cols-3 bg-gradient-to-r from-miruku-blue to-miruku-dark text-white">
                <div class="p-6 text-center font-semibold">{{ __('home.feature') }}</div>
                <div class="p-6 text-center font-bold text-lg border-x border-white/20">
                    <div class="flex items-center justify-center gap-2">
                        <span>🥛</span> Miruku
                    </div>
                </div>
                <div class="p-6 text-center font-semibold opacity-80">{{ __('home.regular_milk') }}</div>
            </div>

            @foreach([
                ['feature' => __('home.comp_lactose_content'), 'miruku' => __('home.comp_miruku_lactose'), 'regular' => __('home.comp_regular_lactose'), 'miruku_icon' => '✅', 'regular_icon' => '❌'],
                ['feature' => __('home.comp_li_suitability'), 'miruku' => __('home.comp_miruku_li'), 'regular' => __('home.comp_regular_li'), 'miruku_icon' => '✅', 'regular_icon' => '❌'],
                ['feature' => __('home.comp_digestion'), 'miruku' => __('home.comp_miruku_digestion'), 'regular' => __('home.comp_regular_digestion'), 'miruku_icon' => '✅', 'regular_icon' => '⚠️'],
                ['feature' => __('home.comp_calcium'), 'miruku' => __('home.comp_miruku_calcium'), 'regular' => __('home.comp_regular_calcium'), 'miruku_icon' => '✅', 'regular_icon' => '✅'],
                ['feature' => __('home.comp_taste'), 'miruku' => __('home.comp_miruku_taste'), 'regular' => __('home.comp_regular_taste'), 'miruku_icon' => '✅', 'regular_icon' => '✅'],
                ['feature' => __('home.comp_flavor_variants'), 'miruku' => __('home.comp_miruku_variants'), 'regular' => __('home.comp_regular_variants'), 'miruku_icon' => '✅', 'regular_icon' => '⚠️'],
                ['feature' => __('home.comp_preservatives'), 'miruku' => __('home.comp_miruku_preservatives'), 'regular' => __('home.comp_regular_preservatives'), 'miruku_icon' => '✅', 'regular_icon' => '❌'],
            ] as $i => $row)
            <div class="grid grid-cols-3 {{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-50/20' }} border-b border-gray-100 last:border-0">
                <div class="p-5 text-gray-700 font-medium flex items-center">{{ $row['feature'] }}</div>
                <div class="p-5 text-center border-x border-gray-100">
                    <span class="text-2xl block mb-1">{{ $row['miruku_icon'] }}</span>
                    <span class="text-sm font-medium text-miruku-blue">{{ $row['miruku'] }}</span>
                </div>
                <div class="p-5 text-center">
                    <span class="text-2xl block mb-1">{{ $row['regular_icon'] }}</span>
                    <span class="text-sm text-gray-500">{{ $row['regular'] }}</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 hover:scale-105 shadow-lg shadow-miruku-blue/30">
                {{ __('home.try_now') }}
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- =============================================
     4. PRODUCTS SECTION
     ============================================= --}}
<section id="products" class="py-24 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.collection_badge') }}</span>
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 font-cormorant">{{ __('home.collection_title') }}</h2>
            <p class="text-gray-500 mt-4 text-lg max-w-2xl mx-auto">{{ __('home.collection_subtitle') }}</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $product)
            <div class="group relative bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                <!-- Image -->
                <div class="aspect-square overflow-hidden bg-gradient-to-br
                    {{ $product->variant === 'original' ? 'from-blue-50 to-indigo-50' : ($product->variant === 'chocolate' ? 'from-amber-50 to-orange-50' : 'from-yellow-50 to-lime-50') }}">
                    @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-7xl mb-2">
                                {{ $product->variant === 'original' ? '🥛' : ($product->variant === 'chocolate' ? '🍫' : '🍌') }}
                            </div>
                            <p class="text-sm font-medium text-gray-400">{{ ucfirst($product->variant) }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Badge -->
                @if($product->is_featured)
                <div class="absolute top-4 left-4 bg-miruku-blue text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                    {{ __('home.best_seller') }}
                </div>
                @endif

                <!-- Content -->
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-semibold uppercase tracking-wider text-miruku-blue bg-blue-50 px-3 py-1 rounded-full">
                            {{ ucfirst($product->variant) }}
                        </span>
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-amber-400 fill-amber-400" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <span class="text-sm font-medium text-gray-700">{{ number_format($product->average_rating, 1) }}</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 font-cormorant">{{ $product->name }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">{{ $product->description }}</p>

                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-miruku-blue font-cormorant">{{ $product->formatted_price }}</span>
                        <a href="{{ route('products.show', $product->slug) }}"
                           class="inline-flex items-center gap-2 bg-gray-900 hover:bg-miruku-blue text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-all duration-300">
                            {{ __('home.view_detail') }}
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center py-16 text-gray-400">Produk sedang disiapkan...</div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 border-2 border-miruku-blue text-miruku-blue hover:bg-miruku-blue hover:text-white font-semibold px-8 py-4 rounded-full transition-all duration-300">
                {{ __('home.view_all') }}
            </a>
        </div>
    </div>
</section>

{{-- =============================================
     5. STORE LOCATIONS
     ============================================= --}}
<section id="stores" class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.find_us') }}</span>
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 font-cormorant">{{ __('home.nearest_store') }}</h2>
            <p class="text-gray-500 mt-4 text-lg">{{ __('home.store_availability') }}</p>
        </div>

        <!-- City Filter -->
        @if($cities->count() > 1)
        <div x-data="{ activeCity: 'all' }" class="mb-8">
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                <button @click="activeCity = 'all'"
                        :class="activeCity === 'all' ? 'bg-miruku-blue text-white' : 'bg-white text-gray-600 hover:bg-blue-50'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200 border border-gray-200">
                    {{ __('home.all_cities') }}
                </button>
                @foreach($cities as $city)
                <button @click="activeCity = '{{ $city }}'"
                        :class="activeCity === '{{ $city }}' ? 'bg-miruku-blue text-white' : 'bg-white text-gray-600 hover:bg-blue-50'"
                        class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200 border border-gray-200">
                    {{ $city }}
                </button>
                @endforeach
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($stores as $store)
                <div x-show="activeCity === 'all' || activeCity === '{{ $store->city }}'"
                     x-transition
                     class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300">
                    @if($store->map_embed)
                    <div class="h-40 bg-gray-200 overflow-hidden">
                        <iframe src="{{ $store->map_embed }}"
                                class="w-full h-full border-0"
                                loading="lazy"
                                title="{{ $store->name }} map"></iframe>
                    </div>
                    @endif
                    <div class="p-5">
                        <h3 class="font-bold text-gray-900 mb-2">{{ $store->name }}</h3>
                        <div class="space-y-2 text-sm text-gray-500">
                            <p class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-miruku-blue flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $store->address }}, {{ $store->city }}
                            </p>
                            @if($store->phone)
                            <p class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-miruku-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                {{ $store->phone }}
                            </p>
                            @endif
                            @if($store->open_time && $store->close_time)
                            <p class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-miruku-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ \Carbon\Carbon::parse($store->open_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($store->close_time)->format('H:i') }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-400">{{ __('home.store_coming_soon') }}</div>
                @endforelse
            </div>
        </div>
        @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($stores as $store)
            <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">
                @if($store->map_embed)
                <div class="h-40 bg-gray-200 overflow-hidden">
                    <iframe src="{{ $store->map_embed }}" class="w-full h-full border-0" loading="lazy"></iframe>
                </div>
                @endif
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 mb-2">{{ $store->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $store->address }}, {{ $store->city }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- =============================================
     6. CUSTOMER REVIEWS
     ============================================= --}}
<section id="reviews" class="py-24 lg:py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.customer_reviews') }}</span>
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 font-cormorant">{{ __('home.what_they_say') }}</h2>
            <p class="text-gray-500 mt-4 text-lg">{{ __('home.satisfied_customers') }}</p>
        </div>

        <!-- Reviews Slider -->
        @if($reviews->count() > 0)
        <div class="swiper reviews-swiper mb-16">
            <div class="swiper-wrapper pb-4">
                @foreach($reviews as $review)
                <div class="swiper-slide">
                    <div class="bg-gray-50 rounded-3xl p-8 h-full border border-gray-100 hover:border-blue-200 transition-all duration-300">
                        <!-- Stars -->
                        <div class="flex gap-1 mb-4">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-amber-400 fill-amber-400' : 'text-gray-200 fill-gray-200' }}" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            @endfor
                        </div>
                        <!-- Comment -->
                        <p class="text-gray-600 leading-relaxed mb-6 text-base italic">"{{ $review->comment }}"</p>
                        <!-- Author -->
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-miruku-blue to-blue-600 flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($review->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $review->name }}</p>
                                <p class="text-xs text-gray-400">{{ __('home.miruku_customer') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination !relative !mt-6"></div>
        </div>
        @endif

        <!-- Submit Review Form -->
        <div class="max-w-2xl mx-auto">
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 border border-blue-100">
                <h3 class="text-2xl font-bold text-gray-900 mb-2 font-cormorant">{{ __('home.share_experience') }}</h3>
                <p class="text-gray-500 text-sm mb-6">{{ __('home.verification_note') }}</p>

                @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5" for="review-name">{{ __('home.name') }} *</label>
                            <input type="text" name="name" id="review-name" required
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue focus:ring-2 focus:ring-blue-50 transition-all"
                                   placeholder="{{ __('home.name_placeholder') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5" for="review-email">{{ __('home.email_optional') }}</label>
                            <input type="email" name="email" id="review-email"
                                   class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue focus:ring-2 focus:ring-blue-50 transition-all"
                                   placeholder="email@kamu.com">
                        </div>
                    </div>

                    <!-- Star Rating Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('home.rating') }} *</label>
                        <div x-data="{ rating: 5 }" class="flex gap-2">
                            @for($i = 1; $i <= 5; $i++)
                            <button type="button" @click="rating = {{ $i }}"
                                    :class="rating >= {{ $i }} ? 'text-amber-400' : 'text-gray-300'"
                                    class="text-3xl transition-colors hover:text-amber-400 cursor-pointer">★</button>
                            @endfor
                            <input type="hidden" name="rating" :value="rating">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5" for="review-comment">{{ __('home.comment') }} *</label>
                        <textarea name="comment" id="review-comment" rows="4" required
                                  class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue focus:ring-2 focus:ring-blue-50 transition-all resize-none"
                                  placeholder="{{ __('home.comment_placeholder') }}"></textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-miruku-blue hover:bg-miruku-dark text-white font-semibold py-3.5 rounded-xl transition-all duration-300 hover:scale-[1.02] shadow-lg shadow-miruku-blue/30">
                        {{ __('home.submit_review') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- =============================================
     7. BENEFITS / WHY MIRUKU
     ============================================= --}}
<section id="why" class="section-blue">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-blue-200 font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.why_miruku') }}</span>
            <h2 class="text-4xl lg:text-5xl font-bold font-cormorant text-white">{{ $sections['benefits']->title ?? __('home.more_than_milk') }}</h2>
            <p class="text-blue-100 mt-4 text-lg max-w-2xl mx-auto opacity-80">{{ $sections['benefits']->subtitle ?? __('home.join_customers') }}</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['icon' => '🧬', 'title' => __('home.benefit_title_1'), 'desc' => __('home.benefit_desc_1')],
                ['icon' => '🦴', 'title' => __('home.benefit_title_2'), 'desc' => __('home.benefit_desc_2')],
                ['icon' => '⚡', 'title' => __('home.benefit_title_3'), 'desc' => __('home.benefit_desc_3')],
                ['icon' => '🌿', 'title' => __('home.benefit_title_4'), 'desc' => __('home.benefit_desc_4')],
                ['icon' => '👨‍👩‍👧‍👦', 'title' => __('home.benefit_title_5'), 'desc' => __('home.benefit_desc_5')],
                ['icon' => '🏆', 'title' => __('home.benefit_title_6'), 'desc' => __('home.benefit_desc_6')],
            ] as $benefit)
            <div class="group bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/10 hover:border-white/40 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1">
                <div class="text-4xl mb-4 text-white">{{ $benefit['icon'] }}</div>
                <h3 class="text-xl font-bold mb-2 font-cormorant text-white">{{ $benefit['title'] }}</h3>
                <p class="text-blue-50 text-sm leading-relaxed opacity-80">{{ $benefit['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =============================================
     8. CTA SECTION
     ============================================= --}}
<section id="cta" class="section-blue !pt-32 pb-32">
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h2 class="text-4xl lg:text-6xl font-bold mb-8 font-cormorant leading-tight text-white animate-slide-up">
            {{ $sections['cta']->title ?? __('home.switch_now') }}
        </h2>

        <!-- Video Section -->
        <div class="max-w-4xl mx-auto mb-16 animate-slide-up shadow-2xl rounded-3xl overflow-hidden border-4 border-white/20" style="animation-delay: 100ms">
            <div class="aspect-video">
                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/CH3rulpG7ac?si=6o99qMhExJb-uDyY"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
                </iframe>
            </div>
        </div>

        <p class="text-blue-100 text-lg lg:text-xl mb-12 max-w-2xl mx-auto opacity-90 animate-slide-up" style="animation-delay: 200ms">
            {{ $sections['cta']->subtitle ?? __('home.join_customers') }}
        </p>
        <div class="flex flex-wrap justify-center gap-6 animate-slide-up" style="animation-delay: 300ms">
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 bg-white text-miruku-blue font-bold px-10 py-4 rounded-full hover:bg-blue-50 transition-all duration-300 hover:scale-105 shadow-2xl text-lg">
                {{ __('home.buy_now') }}
            </a>
            <a href="#stores"
               class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/30 text-white font-bold px-10 py-4 rounded-full hover:bg-white/20 transition-all duration-300 hover:scale-105 text-lg">
                {{ __('home.find_store') }}
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hero Swiper
    new Swiper('.hero-swiper', {
        loop: true,
        autoplay: { delay: 5000, disableOnInteraction: false },
        effect: 'fade',
        fadeEffect: { crossFade: true },
        speed: 800,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    // Reviews Swiper
    new Swiper('.reviews-swiper', {
        loop: false,
        spaceBetween: 24,
        slidesPerView: 1,
        breakpoints: {
            640: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        },
        pagination: {
            el: '.reviews-swiper .swiper-pagination',
            clickable: true,
        },
        autoplay: { delay: 4000, disableOnInteraction: false },
    });
});
</script>
@endpush

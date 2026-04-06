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
                        <div
                            class="absolute inset-0 {{ $slide->show_content ? 'bg-gradient-to-r from-gray-950/80 via-gray-900/60 to-gray-800/40' : 'bg-transparent' }}">
                            @if ($slide->image)
                                <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}"
                                    class="absolute inset-0 w-full h-full object-cover -z-10">
                            @else
                                <div
                                    class="absolute inset-0 -z-10 bg-gradient-to-br from-miruku-dark via-miruku-blue to-gray-900">
                                </div>
                            @endif
                        </div>

                        <!-- Floating glassmorphic shapes -->
                        @if ($slide->show_content)
                            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                                <div
                                    class="absolute -top-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-float-slow">
                                </div>
                                <div class="absolute top-1/4 -right-20 w-80 h-80 bg-blue-400/20 rounded-full blur-3xl animate-pulse"
                                    style="animation-delay: 2s"></div>
                                <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl animate-float-slow"
                                    style="animation-delay: 5s"></div>
                            </div>
                        @endif

                        <!-- Floating abstract shapes -->
                        @if ($slide->show_content)
                            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                                <div
                                    class="absolute top-20 right-20 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl animate-pulse">
                                </div>
                                <div class="absolute bottom-20 left-32 w-48 h-48 bg-blue-300/20 rounded-full blur-2xl animate-pulse"
                                    style="animation-delay: 1s"></div>
                            </div>
                        @endif

                        <!-- Content -->
                        @if ($slide->show_content)
                            <div class="relative h-full flex items-center">
                                <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full">
                                    <div class="max-w-2xl">
                                        <div
                                            class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 px-4 py-2 rounded-full text-sm font-medium mb-6 animate-fade-in">
                                            <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                                            {{ __('home.hero_badge') }}
                                        </div>
                                        <h1
                                            class="text-5xl lg:text-7xl font-bold text-white mb-6 leading-tight font-cormorant animate-slide-up text-shadow-premium">
                                            {{ $slide->title }}
                                        </h1>
                                        @if ($slide->subtitle)
                                            <p class="text-white text-lg lg:text-xl mb-10 leading-relaxed animate-slide-up text-shadow-premium"
                                                style="animation-delay: 100ms">
                                                {{ $slide->subtitle }}
                                            </p>
                                        @endif
                                        <div class="flex flex-wrap gap-4 animate-slide-up" style="animation-delay: 200ms">
                                            @if ($slide->button_text)
                                                <a href="{{ $slide->button_link ?? route('products.index') }}"
                                                    class="inline-flex items-center gap-2 bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 hover:scale-105 shadow-xl shadow-miruku-blue/30">
                                                    {{ $slide->button_text }}
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                    </svg>
                                                </a>
                                            @endif
                                            @if ($slide->button2_text)
                                                <a href="{{ $slide->button2_link ?? '#about' }}"
                                                    class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/30 text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 hover:scale-105">
                                                    {{ $slide->button2_text }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="swiper-slide relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-miruku-dark via-miruku-blue to-gray-900"></div>
                        <div class="relative h-full flex items-center justify-center text-center">
                            <div class="max-w-2xl px-6">
                                <h1 class="text-6xl font-bold text-white mb-6 font-cormorant">
                                    {{ __('home.hero_default_title', ['title' => 'Susu Premium Tanpa Batas']) }}</h1>
                                <p class="text-white/80 text-xl mb-10">
                                    {{ __('home.hero_default_subtitle', ['subtitle' => '0% Lactose. 100% Kenikmatan.']) }}
                                </p>
                                <a href="{{ route('products.index') }}"
                                    class="inline-flex items-center gap-2 bg-miruku-blue text-white font-semibold px-8 py-4 rounded-full hover:bg-miruku-dark transition-all">
                                    {{ __('home.explore_products', ['text' => 'Jelajahi Produk']) }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Navigation -->
            <div
                class="swiper-button-prev hidden md:flex !text-white !w-14 !h-14 !bg-white/10 !rounded-full backdrop-blur-md after:hidden hover:!bg-white/20 transition-all duration-500 items-center justify-center group/nav shadow-2xl animate-float">
                <svg class="w-6 h-6 transition-transform duration-500 group-hover/nav:-translate-x-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </div>
            <div class="swiper-button-next hidden md:flex !text-white !w-14 !h-14 !bg-white/10 !rounded-full backdrop-blur-md after:hidden hover:!bg-white/20 transition-all duration-500 items-center justify-center group/nav shadow-2xl animate-float"
                style="animation-delay: 1.5s">
                <svg class="w-6 h-6 transition-transform duration-500 group-hover/nav:translate-x-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
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
    <div class="relative">
        <!-- Organic Wave Transition (Top of About) -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] transform -translate-y-[99%] z-10"
            data-aos="fade-down" data-aos-duration="1500">
            <svg fill="white" class="relative block w-[calc(100%+1.3px)] h-[80px]" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z">
                </path>
            </svg>
        </div>

        <section id="about" class="py-24 lg:py-32 bg-white relative overflow-hidden">
            <!-- Background Decorations -->
            <div class="absolute top-0 left-0 w-full h-full pointer-events-none overflow-hidden">
                <div
                    class="absolute top-40 -left-20 w-80 h-80 bg-blue-50 rounded-full blur-3xl opacity-60 animate-float-slow">
                </div>
                <div class="absolute bottom-20 -right-20 w-96 h-96 bg-indigo-50 rounded-full blur-3xl opacity-60 animate-float-slow"
                    style="animation-delay: 3s"></div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <!-- Text -->
                    <div data-aos="fade-right" class="relative group">
                        @auth
                            <a href="{{ route('admin.sections.edit', $sections['about']->id ?? 1) }}"
                                class="absolute -top-6 -right-6 bg-miruku-blue text-white p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-10 hover:scale-110"
                                title="Edit Section">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                        @endauth
                        <span
                            class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.about_badge') }}</span>
                        <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 font-cormorant leading-tight">
                            {{ $sections['about']->title ?? 'Kenali Miruku' }}
                        </h2>
                        <div class="text-gray-500 text-lg leading-relaxed mb-8">
                            {!! $sections['about']->content ??
                                'Miruku hadir sebagai jawaban atas kebutuhan Anda akan susu berkualitas premium yang ramah bagi sistem pencernaan.' !!}
                        </div>

                        <!-- Bullet Points -->
                        <div class="space-y-4">
                            @if (isset($sections['about']) && $sections['about']->features->count() > 0)
                                @foreach ($sections['about']->features as $point)
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="flex-shrink-0 w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-2xl">
                                            {{ $point->icon }}
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ $point->title }}</h4>
                                            <p class="text-gray-500 text-sm">{{ $point->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @foreach ([['icon' => '🥛', 'title' => '0% Lactose', 'desc' => 'Aman untuk penderita lactose intolerance'], ['icon' => '✨', 'title' => 'Tekstur Creamy', 'desc' => 'Kelezatan premium di setiap tegukan'], ['icon' => '💚', 'title' => 'Mudah Dicerna', 'desc' => 'Nyaman di perut, energi sepanjang hari']] as $point)
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="flex-shrink-0 w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-2xl">
                                            {{ $point['icon'] }}
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ $point['title'] }}</h4>
                                            <p class="text-gray-500 text-sm">{{ $point['desc'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="mt-10">
                            <a href="{{ route('about') }}"
                                class="inline-flex items-center gap-2 text-miruku-blue font-semibold hover:gap-4 transition-all duration-300">
                                {{ __('home.learn_more') }}
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="relative max-w-lg mx-auto lg:ml-auto w-full" data-aos="fade-left">
                        <div
                            class="aspect-square rounded-3xl overflow-hidden bg-gradient-to-br from-blue-100 to-indigo-50 shadow-2xl">
                            @if ($sections['about']->image)
                                <img src="{{ $sections['about']->image_url }}" alt="{{ $sections['about']->title }}"
                                    class="w-full h-full object-cover object-center">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center p-12">
                                        <div class="text-[120px] mb-4">🥛</div>
                                        <p class="text-miruku-blue font-cormorant text-2xl italic">Pure. Natural. Premium.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- Floating badge -->
                        <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-2xl p-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 bg-miruku-blue rounded-xl flex items-center justify-center text-white text-xl">
                                    ⭐</div>
                                <div>
                                    <p class="font-bold text-gray-900 text-xl">
                                        {{ $sections['about']->display_rating ?? '4.9/5' }}</p>
                                    <p class="text-gray-500 text-xs">
                                        {{ $sections['about']->display_reviews ?? __('home.total_reviews') }}</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute -top-6 -right-6 bg-miruku-blue text-white rounded-2xl shadow-2xl p-5 text-center">
                            <p class="text-3xl font-bold font-cormorant">99%</p>
                            <p class="text-xs text-blue-100">{{ __('home.lactose_free') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    {{-- =============================================
     3. BENEFITS / WHY MIRUKU
     ============================================= --}}
    <section id="why" class="relative py-24 lg:py-32 overflow-hidden bg-miruku-blue miruku-pattern text-white">
        <div class="absolute inset-0 bg-miruku-dark/20 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 px-4" data-aos="fade-up">
                <span
                    class="text-blue-200 font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.benefits_badge') }}</span>
                <h2 class="text-4xl lg:text-5xl font-bold font-cormorant text-white text-shadow-premium">
                    {!! $sections['benefits']->title ?? __('home.more_than_milk') !!}</h2>

                @if (isset($sections['benefits']->subtitle))
                    <p class="text-blue-100 mt-4 text-lg max-w-2xl mx-auto opacity-80">
                        {!! $sections['benefits']->subtitle !!}</p>
                @endif

                @if (isset($sections['benefits']) && $sections['benefits']->content)
                    <div class="mt-6 text-blue-50/70 text-base max-w-3xl mx-auto leading-relaxed">
                        {!! $sections['benefits']->content !!}
                    </div>
                @endif
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @if (isset($sections['benefits']) && $sections['benefits']->features->count() > 0)
                    @foreach ($sections['benefits']->features as $i => $benefit)
                        <div data-aos="fade-up" data-aos-delay="{{ $i * 100 }}"
                            class="group bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/10 hover:border-white/40 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1">
                            <div class="text-4xl mb-4 text-white">{{ $benefit->icon }}</div>
                            <h3 class="text-xl font-bold mb-2 font-cormorant text-white">{!! $benefit->title !!}</h3>
                            <p class="text-blue-50 text-sm leading-relaxed opacity-80">{!! $benefit->description !!}</p>
                        </div>
                    @endforeach
                @else
                    @foreach ([['icon' => '🧬', 'title' => __('home.benefit_title_1'), 'desc' => __('home.benefit_desc_1')], ['icon' => '🦴', 'title' => __('home.benefit_title_2'), 'desc' => __('home.benefit_desc_2')], ['icon' => '⚡', 'title' => __('home.benefit_title_3'), 'desc' => __('home.benefit_desc_3')], ['icon' => '🌿', 'title' => __('home.benefit_title_4'), 'desc' => __('home.benefit_desc_4')], ['icon' => '👨‍👩‍👧‍👦', 'title' => __('home.benefit_title_5'), 'desc' => __('home.benefit_desc_5')], ['icon' => '🏆', 'title' => __('home.benefit_title_6'), 'desc' => __('home.benefit_desc_6')]] as $i => $benefit)
                        <div data-aos="fade-up" data-aos-delay="{{ $i * 100 }}"
                            class="group bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/10 hover:border-white/40 rounded-2xl p-6 transition-all duration-300 hover:-translate-y-1">
                            <div class="text-4xl mb-4 text-white">{{ $benefit['icon'] }}</div>
                            <h3 class="text-xl font-bold mb-2 font-cormorant text-white">{{ $benefit['title'] }}</h3>
                            <p class="text-blue-50 text-sm leading-relaxed opacity-80">{{ $benefit['desc'] }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    {{-- =============================================
     4. COMPARISON SECTION
     ============================================= --}}
    <section id="comparison" class="py-24 bg-gray-50 relative overflow-hidden">
        <!-- Wave transition from About to Comparison -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] transform -translate-y-[99%]">
            <svg fill="#f9fafb" class="relative block w-[calc(100%+1.3px)] h-[60px]" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.83C1132.19,118.92,1055.71,111.31,985.66,92.83Z">
                </path>
            </svg>
        </div>

        <!-- Background Decorations -->
        <div
            class="absolute top-1/2 -right-20 w-80 h-80 bg-blue-100/50 rounded-full blur-3xl opacity-60 animate-float-slow">
        </div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span
                    class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.comparison_badge') }}</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 font-cormorant">{{ __('home.comparison_title') }}
                </h2>
                <p class="text-gray-500 mt-4 text-lg">{{ __('home.comparison_subtitle') }}</p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100" data-aos="fade-up"
                data-aos-delay="100">
                <div class="grid grid-cols-3 bg-gradient-to-r from-miruku-blue to-miruku-dark text-white">
                    <div class="p-6 text-center font-semibold">{{ __('home.feature') }}</div>
                    <div class="p-6 text-center font-bold text-lg border-x border-white/20">
                        <div class="flex items-center justify-center gap-2">
                            <span>🥛</span> Miruku
                        </div>
                    </div>
                    <div class="p-6 text-center font-semibold opacity-80">{{ __('home.regular_milk') }}</div>
                </div>

                @foreach ([
            ['feature' => __('home.comp_lactose_content'), 'miruku' => __('home.comp_miruku_lactose'), 'regular' => __('home.comp_regular_lactose'), 'miruku_icon' => '✅', 'regular_icon' => '❌'],
            ['feature' => __('home.comp_li_suitability'), 'miruku' => __('home.comp_miruku_li'), 'regular' => __('home.comp_regular_li'), 'miruku_icon' => '✅', 'regular_icon' => '❌'],
            ['feature' => __('home.comp_digestion'), 'miruku' => __('home.comp_miruku_digestion'), 'regular' => __('home.comp_regular_digestion'), 'miruku_icon' => '✅', 'regular_icon' => '⚠️'],
            ['feature' => __('home.comp_calcium'), 'miruku' => __('home.comp_miruku_calcium'), 'regular' => __('home.comp_regular_calcium'), 'miruku_icon' => '✅', 'regular_icon' => '✅'],
            ['feature' => __('home.comp_taste'), 'miruku' => __('home.comp_miruku_taste'), 'regular' => __('home.comp_regular_taste'), 'miruku_icon' => '✅', 'regular_icon' => '✅'],
            ['feature' => __('home.comp_flavor_variants'), 'miruku' => __('home.comp_miruku_variants'), 'regular' => __('home.comp_regular_variants'), 'miruku_icon' => '✅', 'regular_icon' => '⚠️'],
            ['feature' => __('home.comp_preservatives'), 'miruku' => __('home.comp_miruku_preservatives'), 'regular' => __('home.comp_regular_preservatives'), 'miruku_icon' => '✅', 'regular_icon' => '❌'],
        ] as $i => $row)
                    <div
                        class="grid grid-cols-3 {{ $i % 2 === 0 ? 'bg-white' : 'bg-blue-50/20' }} border-b border-gray-100 last:border-0">
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

            <div class="text-center mt-10" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 bg-miruku-blue hover:bg-miruku-dark text-white font-semibold px-8 py-4 rounded-full transition-all duration-300 hover:scale-105 shadow-lg shadow-miruku-blue/30">
                    {{ __('home.try_now') }}
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>


    {{-- =============================================
     5. PRODUCTS SECTION
     ============================================= --}}
    <section id="products" x-data="{
        activeUnit: 'all',
        products: @js($products->map(fn($p) => ['id' => $p->id, 'unit' => $p->unit])),
        get visibleIds() {
            if (this.activeUnit === 'all') return this.products.slice(0, 3).map(p => p.id);
            return this.products.filter(p => p.unit === this.activeUnit).slice(0, 3).map(p => p.id);
        }
    }" class="py-24 lg:py-32 bg-white relative overflow-hidden">
        <!-- Wave transition from Comparison to Products -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] transform -translate-y-[99%]">
            <svg fill="white" class="relative block w-[calc(100%+1.3px)] h-[60px]" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z">
                </path>
            </svg>
        </div>

        <!-- Background Decorations -->
        <div class="absolute -top-20 -left-20 w-80 h-80 bg-blue-50 rounded-full blur-3xl opacity-80 animate-float-slow">
        </div>
        <div class="absolute bottom-40 -right-20 w-64 h-64 bg-indigo-50 rounded-full blur-3xl opacity-60 animate-pulse">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span
                    class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.collection_badge') }}</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 font-cormorant">{{ __('home.collection_title') }}
                </h2>
                <p class="text-gray-500 mt-4 text-lg max-w-2xl mx-auto">{{ __('home.collection_subtitle') }}</p>

                <!-- Filter Units/Categories -->
                <div class="flex flex-wrap justify-center gap-3 mt-10">
                    <button @click="activeUnit = 'all'"
                        :class="activeUnit === 'all' ? 'bg-miruku-blue text-white shadow-lg shadow-miruku-blue/20' :
                            'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300">
                        {{ __('products.all_categories') }}
                    </button>
                    @foreach ($units as $u)
                        <button @click="activeUnit = '{{ $u->slug }}'"
                            :class="activeUnit === '{{ $u->slug }}' ?
                                'bg-miruku-blue text-white shadow-lg shadow-miruku-blue/20' :
                                'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                            class="px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300">
                            {{ $u->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $product)
                    <div x-show="visibleIds.includes({{ $product->id }})"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100" data-aos="fade-up"
                        data-aos-delay="{{ ($loop->index % 3) * 100 }}"
                        class="group relative bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100">
                        <!-- Image -->
                        <div
                            class="aspect-square overflow-hidden bg-gradient-to-br
                    {{ $product->variantInfo->color_class ?? 'from-blue-50 to-indigo-50' }}">
                            @if ($product->image)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-7xl mb-2">
                                            {{ $product->variantInfo->icon ?? '🥛' }}
                                        </div>
                                        <p class="text-sm font-medium text-gray-400">
                                            {{ $product->variantInfo->name ?? ucfirst($product->variant) }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Badge -->
                        @if ($product->is_best_seller)
                            <div
                                class="absolute top-4 left-4 bg-miruku-blue text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg z-10">
                                {{ __('home.best_seller') }}
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider text-miruku-blue bg-blue-50 px-2.5 py-1 rounded-full">
                                        {{ $product->variantInfo->name ?? ucfirst($product->variant) }}
                                    </span>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">
                                        {{ $product->unitInfo->name ?? $product->unit }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-amber-400 fill-amber-400" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium text-gray-700">{{ number_format($product->average_rating, 1) }}</span>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 font-cormorant">{{ $product->name }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">{{ $product->description }}
                            </p>

                            <div class="flex items-center justify-between">
                                <span
                                    class="text-2xl font-bold text-miruku-blue font-cormorant">{{ $product->formatted_price }}</span>
                                <a href="{{ route('products.show', $product->slug) }}"
                                    class="inline-flex items-center gap-2 bg-gray-900 hover:bg-miruku-blue text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-all duration-300">
                                    {{ __('home.view_detail') }}
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16 text-gray-400">Produk sedang disiapkan...</div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center gap-2 border-2 border-miruku-blue text-miruku-blue hover:bg-miruku-blue hover:text-white font-semibold px-8 py-4 rounded-full transition-all duration-300">
                    {{ __('home.view_all') }}
                </a>
            </div>
        </div>
    </section>




    {{-- =============================================
     6. CUSTOMER REVIEWS
     ============================================= --}}
    <section id="reviews" x-data="{ activeReview: null }"
        class="py-24 lg:py-32 bg-miruku-blue miruku-pattern overflow-hidden relative text-white">
        <!-- Wave transition from Products to Reviews -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] transform -translate-y-[99%]">
            <svg fill="#3474a2" class="relative block w-[calc(100%+1.3px)] h-[60px]" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z">
                </path>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" data-aos="fade-up">
            <div class="text-center mb-16 px-4">
                <span
                    class="text-blue-200 font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.customer_reviews') }}</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-white font-cormorant text-shadow-premium">
                    {{ __('home.what_they_say') }}
                </h2>
                <p class="text-blue-100 mt-4 text-lg opacity-80">{{ __('home.satisfied_customers') }}</p>
            </div>

            <!-- Reviews Slider -->
            @if ($reviews && $reviews->count() > 0)
                <div class="swiper reviews-swiper mb-16">
                    <div class="swiper-wrapper pb-10">
                        @foreach ($reviews as $review)
                            <div class="swiper-slide h-auto">
                                <div @click="activeReview = { name: '{{ addslashes($review->name) }}', rating: {{ $review->rating }}, comment: {{ json_encode($review->comment) }} }; $dispatch('open-modal', 'review-detail')"
                                    class="bg-white/10 backdrop-blur-md rounded-3xl p-8 h-full border border-white/10 hover:border-white/40 hover:bg-white/20 hover:shadow-2xl hover:shadow-black/20 transition-all duration-500 cursor-pointer group flex flex-col">
                                    <!-- Stars -->
                                    <div class="flex gap-1 mb-4">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-amber-400 fill-amber-400' : 'text-white/20 fill-white/20' }}"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <!-- Comment -->
                                    <p
                                        class="text-blue-50 leading-relaxed mb-6 text-base italic line-clamp-3 flex-grow opacity-90">
                                        "{{ $review->comment }}"</p>
                                    <!-- Author -->
                                    <div class="flex items-center gap-3 mt-auto">
                                        <div
                                            class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white font-bold text-sm border border-white/20 shadow-inner">
                                            {{ strtoupper(substr($review->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p
                                                class="font-semibold text-white group-hover:text-blue-200 transition-colors">
                                                {{ $review->name }}</p>
                                            <p class="text-xs text-blue-200/60">{{ __('home.miruku_customer') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination !relative !mt-2"></div>
                </div>
            @endif

            <!-- Submit Review Form -->
            <div class="max-w-2xl mx-auto mt-16" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2 font-cormorant">{{ __('home.share_experience') }}
                    </h3>
                    <p class="text-gray-500 text-sm mb-6">{{ __('home.verification_note') }}</p>

                    @if (session('success'))
                        <div
                            class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm animate-fade-in">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5"
                                    for="review-name">{{ __('home.name') }} *</label>
                                <input type="text" name="name" id="review-name" required
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue focus:ring-2 focus:ring-blue-50 transition-all text-gray-900 placeholder-gray-400"
                                    placeholder="{{ __('home.name_placeholder') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5"
                                    for="review-email">{{ __('home.email_optional') }}</label>
                                <input type="email" name="email" id="review-email"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue focus:ring-2 focus:ring-blue-50 transition-all text-gray-900 placeholder-gray-400"
                                    placeholder="email@kamu.com">
                            </div>
                        </div>

                        <!-- Star Rating Input -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('home.rating') }} *</label>
                            <div x-data="{ rating: 5 }" class="flex gap-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button" @click="rating = {{ $i }}"
                                        :class="rating >= {{ $i }} ? 'text-amber-400' : 'text-gray-200'"
                                        class="text-3xl transition-colors hover:text-amber-400 cursor-pointer focus:outline-none">★</button>
                                @endfor
                                <input type="hidden" name="rating" :value="rating">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5"
                                for="review-comment">{{ __('home.comment') }} *</label>
                            <textarea name="comment" id="review-comment" rows="4" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-miruku-blue focus:ring-2 focus:ring-blue-50 transition-all resize-none text-gray-900 placeholder-gray-400"
                                placeholder="{{ __('home.comment_placeholder') }}"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-miruku-blue hover:bg-miruku-dark text-white font-bold py-4 rounded-xl transition-all duration-300 hover:scale-[1.01] shadow-lg shadow-miruku-blue/30">
                            {{ __('home.submit_review') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Review Detail Modal -->
        <x-modal name="review-detail" maxWidth="lg">
            <div x-show="activeReview" class="p-8 relative overflow-hidden">
                <!-- Decoration -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-50 rounded-full blur-2xl opacity-60"></div>

                <div class="relative">
                    <button @click="$dispatch('close')"
                        class="absolute -top-2 -right-2 p-2 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-miruku-blue to-blue-600 flex items-center justify-center text-white font-bold text-xl shadow-lg text-shadow-premium">
                            <template x-if="activeReview">
                                <span x-text="activeReview.name.charAt(0).toUpperCase()"></span>
                            </template>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900 font-cormorant leading-tight"
                                x-text="activeReview?.name"></h4>
                            <div class="flex gap-0.5 mt-1">
                                <template x-for="i in 5">
                                    <svg class="w-4 h-4"
                                        :class="i <= activeReview?.rating ? 'text-amber-400 fill-amber-400' :
                                            'text-gray-200 fill-gray-200'"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <svg class="w-8 h-8 text-miruku-blue/10 mb-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 7.55228 14.017 7V5C14.017 4.44772 14.4647 4 15.017 4H19.017C20.6739 4 22.017 5.34315 22.017 7V15C22.017 16.6569 20.6739 18 19.017 18H16.017L16.017 21H14.017ZM2.017 21L2.017 18C2.017 16.8954 2.91243 16 4.017 16H7.017C7.56928 16 8.017 15.5523 8.017 15V9C8.017 8.44772 7.56928 8 7.017 8H3.017C2.46472 8 2.017 7.55228 2.017 7V5C2.017 4.44772 2.46472 4 3.017 4H7.017C8.67386 4 10.017 5.34315 10.017 7V15C10.017 16.6569 8.67386 18 7.017 18H4.017L4.017 21H2.017Z" />
                        </svg>
                        <p class="text-gray-700 leading-relaxed italic text-lg whitespace-pre-line"
                            x-text="activeReview?.comment"></p>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button @click="$dispatch('close')"
                            class="bg-miruku-blue hover:bg-miruku-dark text-white font-bold px-8 py-3 rounded-xl transition-all duration-300 shadow-lg shadow-miruku-blue/20">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </x-modal>
    </section>

    {{-- =============================================
     Latest Articles
     ============================================= --}}
    <section id="articles" class="py-24 lg:py-32 bg-white relative overflow-hidden">
        <!-- Wave transition from Reviews to Articles -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] transform -translate-y-[99%]">
            <svg fill="white" class="relative block w-[calc(100%+1.3px)] h-[60px]" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z">
                </path>
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span
                    class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.blog_badge') }}</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 font-cormorant">{{ __('articles.title') }}</h2>
                <p class="text-gray-500 mt-4 text-lg max-w-2xl mx-auto">{{ __('articles.subtitle') }}</p>
            </div>

            @if ($posts->count() > 0)
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach ($posts as $post)
                        <article
                            class="bg-gray-50 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 group border border-gray-100 flex flex-col h-full"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <a href="{{ route('articles.show', $post) }}"
                                class="relative block aspect-[16/10] overflow-hidden">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-white/90 backdrop-blur-md text-miruku-blue text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                                        {{ $post->published_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </a>
                            <div class="p-8 flex flex-col flex-1">
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-4 group-hover:text-miruku-blue transition-colors">
                                    <a href="{{ route('articles.show', $post) }}">{{ $post->title }}</a>
                                </h3>
                                <div class="text-gray-500 text-sm mb-6 line-clamp-4">
                                    {!! Str::limit(strip_tags($post->content), 180) !!}
                                </div>
                                <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
                                    <a href="{{ route('articles.show', $post) }}"
                                        class="text-sm font-bold text-miruku-blue flex items-center gap-2 group/link">
                                        {{ __('home.read_more') }}
                                        <svg class="w-4 h-4 transition-transform duration-300 group-hover/link:translate-x-1"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="text-center mt-12">
                    <a href="{{ route('articles.index') }}"
                        class="inline-flex items-center gap-2 border-2 border-miruku-blue text-miruku-blue hover:bg-miruku-blue hover:text-white font-semibold px-8 py-4 rounded-full transition-all duration-300">
                        {{ __('home.view_all_articles') }}
                    </a>
                </div>
            @else
                <div class="text-center py-12 text-gray-400">Artikel sedang dalam proses penulisan...</div>
            @endif
        </div>
    </section>

    {{-- =============================================
     7. STORE LOCATIONS
     ============================================= --}}
    <section id="stores" class="py-24 bg-white relative">
        <!-- Wave transition from Reviews to Stores -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] transform -translate-y-[99%]">
            <svg fill="white" class="relative block w-[calc(100%+1.3px)] h-[60px]" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.83C1132.19,118.92,1055.71,111.31,985.66,92.83Z">
                </path>
            </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span
                    class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('home.find_us') }}</span>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 font-cormorant">{{ __('home.nearest_store') }}
                </h2>
                <p class="text-gray-500 mt-4 text-lg">{{ __('home.store_availability') }}</p>
            </div>

            <!-- City Filter -->
            @if ($cities->count() > 1)
                <div x-data="{ activeCity: 'all' }" class="mb-8">
                    <div class="flex flex-wrap justify-center gap-3 mb-8">
                        <button @click="activeCity = 'all'"
                            :class="activeCity === 'all' ? 'bg-miruku-blue text-white' :
                                'bg-white text-gray-600 hover:bg-blue-50'"
                            class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200 border border-gray-200">
                            {{ __('home.all_cities') }}
                        </button>
                        @foreach ($cities as $city)
                            @php
                                // Get a sample store for this city to use its formatted_city attribute
                                $sampleStore = $stores->firstWhere(fn($s) => $s->getRawOriginal('city') === $city);
                                $displayCity = $sampleStore ? $sampleStore->formatted_city : $city;
                            @endphp
                            <button @click="activeCity = '{{ $city }}'"
                                :class="activeCity === '{{ $city }}' ? 'bg-miruku-blue text-white' :
                                    'bg-white text-gray-600 hover:bg-blue-50'"
                                class="px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200 border border-gray-200">
                                {{ $displayCity }}
                            </button>
                        @endforeach
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @php
                            $storesByCity = $stores->groupBy(fn($s) => $s->getRawOriginal('city'));
                        @endphp
                        @foreach ($storesByCity as $cityKey => $cityStores)
                            @foreach ($cityStores->take(3) as $store)
                                <div x-show="activeCity === 'all' || activeCity === '{{ $cityKey }}'" x-transition
                                    data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}"
                                    class="bg-gray-50 rounded-2xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300">
                                    @if ($store->map_embed)
                                        <div class="h-40 bg-gray-200 overflow-hidden">
                                            <iframe src="{{ $store->map_embed }}" class="w-full h-full border-0"
                                                loading="lazy" title="{{ $store->name }} map"></iframe>
                                        </div>
                                    @endif
                                    <div class="p-5">
                                        <h3 class="font-bold text-gray-900 mb-2">{{ $store->name }}</h3>
                                        <div class="space-y-2 text-sm text-gray-500">
                                            <p class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-miruku-blue flex-shrink-0 mt-0.5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                {{ $store->address }}, {{ $store->formatted_city }}
                                            </p>
                                            @if ($store->phone)
                                                <p class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-miruku-blue flex-shrink-0" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                    </svg>
                                                    {{ $store->phone }}
                                                </p>
                                            @endif
                                            @if ($store->open_time && $store->close_time)
                                                <p class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-miruku-blue flex-shrink-0" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($store->open_time)->format('H:i') }} –
                                                    {{ \Carbon\Carbon::parse($store->close_time)->format('H:i') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>

                    <div class="text-center mt-12" data-aos="fade-up">
                        <a href="{{ route('stores.index') }}"
                            class="inline-flex items-center gap-2 border-2 border-miruku-blue text-miruku-blue hover:bg-miruku-blue hover:text-white font-semibold px-8 py-3.5 rounded-full transition-all duration-300">
                            {{ __('home.view_all_locations') ?? 'Liat Semua Lokasi' }}
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($stores as $store)
                        <div data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}"
                            class="bg-gray-50 rounded-2xl shadow-md overflow-hidden border border-gray-100">
                            @if ($store->map_embed)
                                <div class="h-40 bg-gray-200 overflow-hidden">
                                    <iframe src="{{ $store->map_embed }}" class="w-full h-full border-0"
                                        loading="lazy"></iframe>
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
     8. CTA SECTION
     ============================================= --}}
    <section id="cta" class="relative py-24 lg:py-32 bg-miruku-blue miruku-pattern text-white">
        <div class="absolute inset-0 bg-miruku-dark/20 pointer-events-none"></div>

        <!-- Wave transition from Stores to CTA -->
        <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] transform -translate-y-full translate-z-0">
            <svg fill="white" class="relative block w-[calc(100%+1.3px)] h-[60px]" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z">
                </path>
            </svg>
        </div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-10 lg:pt-20" data-aos="fade-up">
            <h2 class="text-3xl lg:text-5xl font-bold mb-8 font-cormorant leading-tight text-white text-shadow-premium">
                {!! $sections['cta']->title ?? __('home.switch_now') !!}
            </h2>

            <div class="max-w-4xl mx-auto mb-16 rounded-3xl overflow-hidden shadow-[0_30px_70px_-15px_rgba(0,0,0,0.5)] border border-white/20 ring-1 ring-white/30 animate-fade-in"
                style="animation-delay: 100ms">
                <div class="aspect-video relative">
                    <iframe class="w-full h-full"
                        src="{{ ($sections['cta']->youtube_embed_url ?? 'https://www.youtube.com/embed/CH3rulpG7ac') . (strpos($sections['cta']->youtube_embed_url ?? '', '?') !== false ? '&' : '?') }}vq=hd1080&rel=0"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
            </div>

            <p class="text-blue-100 text-lg lg:text-xl mb-12 max-w-2xl mx-auto opacity-95 animate-slide-up text-shadow-premium"
                style="animation-delay: 200ms">
                {!! $sections['cta']->subtitle ?? __('home.join_customers') !!}
            </p>

            <!-- Optimized Newsletter Form -->
            <div class="max-w-xl mx-auto pt-8 animate-fade-in" style="animation-delay: 400ms">
                <div class="relative z-10 text-center">
                    <p class="text-blue-50 text-sm mb-6 opacity-80 tracking-widest uppercase font-bold">
                        {{ __('footer.newsletter_description') }}
                    </p>

                    <div
                        class="bg-white/10 backdrop-blur-md p-1.5 rounded-[2rem] border border-white/20 shadow-2xl relative group transition-all duration-500 hover:border-white/40">
                        <form id="newsletter-form" class="flex flex-col sm:flex-row gap-2">
                            @csrf
                            <input type="email" name="email" placeholder="{{ __('footer.email_placeholder') }}"
                                id="newsletter-email" required
                                class="flex-1 bg-transparent border-none text-white placeholder-blue-100 px-6 py-4 focus:outline-none focus:ring-0 text-base">

                            <button type="submit" id="newsletter-submit"
                                class="bg-white text-miruku-blue hover:bg-blue-50 px-10 py-4 rounded-[1.5rem] font-bold transition-all shadow-xl hover:shadow-white/20 flex items-center justify-center gap-2 group/btn whitespace-nowrap text-base active:scale-95">
                                <span id="submit-text">{{ __('footer.join') }}</span>
                                <span id="submit-loader"
                                    class="hidden w-5 h-5 border-3 border-miruku-blue border-t-transparent rounded-full animate-spin"></span>
                                <svg class="w-5 h-5 transition-transform group-hover/btn:translate-x-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <div class="mt-6 flex flex-col items-center gap-4">
                        <div class="g-recaptcha scale-90 sm:scale-100"
                            data-sitekey="{{ config('services.recaptcha.site_key') }}" data-theme="dark"></div>
                        <p id="newsletter-message" class="text-sm font-medium hidden animate-fade-in text-shadow-premium">
                        </p>
                    </div>
                </div>
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
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                },
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
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
                    640: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    },
                },
                pagination: {
                    el: '.reviews-swiper .swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false
                },
            });
        });
    </script>
@endpush

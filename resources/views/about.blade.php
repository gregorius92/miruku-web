@extends('layouts.app')

@section('content')
<div class="pt-24 pb-20">
    <!-- Hero Section -->
    <section class="relative py-20 lg:py-32 overflow-hidden bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('about.hero_badge') }}</span>
                <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 mb-6 font-cormorant leading-tight">{{ __('about.hero_title') }}</h1>
                <p class="text-gray-600 text-xl leading-relaxed">{{ __('about.hero_subtitle') }}</p>
            </div>
        </div>
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-blue-100/50 to-transparent"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-white rounded-full blur-3xl opacity-50"></div>
    </section>

    <!-- Our Story -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="order-2 lg:order-1">
                    <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('images/miruku-about-me.png') }}" alt="Miruku Story" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <h2 class="text-4xl font-bold text-gray-900 mb-8 font-cormorant">{{ __('about.story_title') }}</h2>
                    <div class="space-y-6 text-gray-600 leading-relaxed text-lg">
                        <p>{!! __('about.story_p1') !!}</p>
                        <p>{!! __('about.story_p2') !!}</p>
                        <p>{{ __('about.story_p3') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 font-cormorant">{{ __('about.values_title') }}</h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">{{ __('about.values_subtitle') }}</p>
            </div>
            <div class="grid md:grid-cols-3 gap-10">
                @foreach([
                    ['icon' => '🏅', 'title' => __('about.value_1_title'), 'desc' => __('about.value_1_desc')],
                    ['icon' => '🔬', 'title' => __('about.value_2_title'), 'desc' => __('about.value_2_desc')],
                    ['icon' => '❤️', 'title' => __('about.value_3_title'), 'desc' => __('about.value_3_desc')],
                ] as $value)
                <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="text-5xl mb-6">{{ $value['icon'] }}</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 font-cormorant">{{ $value['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $value['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Join the movement CTA -->
    <section class="section-blue !pt-24 mt-12">
        <div class="max-w-4xl mx-auto px-4 text-center text-white relative z-10">
            <h2 class="text-4xl font-bold mb-6 font-cormorant">{{ __('about.cta_title') }}</h2>
            <p class="text-blue-100 text-lg mb-10 opacity-90">{{ __('about.cta_subtitle') }}</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-white text-miruku-blue font-bold px-10 py-4 rounded-full hover:bg-blue-50 transition-all shadow-xl">{{ __('about.cta_button') }}</a>
        </div>
    </section>
</div>
@endsection

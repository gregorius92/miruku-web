@extends('layouts.app')

@section('content')
<div class="pt-24 pb-20">
    <!-- Hero -->
    <section class="section-blue !pt-20 !pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="text-blue-200 font-semibold text-sm uppercase tracking-widest mb-4 block">{{ __('benefits.hero_badge') }}</span>
                <h1 class="text-5xl lg:text-7xl font-bold mb-6 font-cormorant leading-tight">{{ __('benefits.hero_title') }}</h1>
                <p class="text-blue-100 text-xl leading-relaxed opacity-90">{{ __('benefits.hero_subtitle') }}</p>
            </div>
        </div>
    </section>

    <!-- Key Benefits Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center mb-32">
                <div data-aos="fade-right">
                    <h2 class="text-4xl font-bold text-gray-900 mb-8 font-cormorant">{{ __('benefits.benefit_1_title') }}</h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">{{ __('benefits.benefit_1_desc') }}</p>
                    <ul class="space-y-4">
                        @foreach(__('benefits.benefit_1_list') as $item)
                        <li class="flex items-center gap-3 text-gray-700">
                            <svg class="w-5 h-5 text-miruku-blue" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-blue-50 rounded-3xl p-12 text-center" data-aos="fade-left">
                    <div class="text-[120px] mb-4">😌</div>
                    <p class="text-miruku-blue font-bold text-2xl font-cormorant">99.9% Digestive Friendly</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 bg-blue-50 rounded-3xl p-12 text-center" data-aos="fade-right">
                    <div class="text-[120px] mb-4">💪</div>
                    <p class="text-blue-500 font-bold text-2xl font-cormorant">100% Nutrisi Tetap Terjaga</p>
                </div>
                <div class="order-1 lg:order-2" data-aos="fade-left">
                    <h2 class="text-4xl font-bold text-gray-900 mb-8 font-cormorant">{{ __('benefits.benefit_2_title') }}</h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">{{ __('benefits.benefit_2_desc') }}</p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="border-l-4 border-miruku-blue pl-4">
                            <p class="text-3xl font-bold text-gray-900 font-cormorant">{{ __('benefits.nutrients.calcium') }}</p>
                            <p class="text-gray-500 text-sm">{{ __('benefits.nutrients.calcium_desc') }}</p>
                        </div>
                        <div class="border-l-4 border-miruku-blue pl-4">
                            <p class="text-3xl font-bold text-gray-900 font-cormorant">{{ __('benefits.nutrients.protein') }}</p>
                            <p class="text-gray-500 text-sm">{{ __('benefits.nutrients.protein_desc') }}</p>
                        </div>
                        <div class="border-l-4 border-miruku-blue pl-4">
                            <p class="text-3xl font-bold text-gray-900 font-cormorant">{{ __('benefits.nutrients.vit_d') }}</p>
                            <p class="text-gray-500 text-sm">{{ __('benefits.nutrients.vit_d_desc') }}</p>
                        </div>
                        <div class="border-l-4 border-miruku-blue pl-4">
                            <p class="text-3xl font-bold text-gray-900 font-cormorant">{{ __('benefits.nutrients.b12') }}</p>
                            <p class="text-gray-500 text-sm">{{ __('benefits.nutrients.b12_desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-gray-900 mb-12 text-center font-cormorant">{{ __('benefits.faq_title') }}</h2>
            <div class="space-y-4" x-data="{ active: 1 }">
                @foreach(__('benefits.faqs') as $id => $faq)
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                    <button @click="active = {{ $id }}" class="w-full px-6 py-5 text-left flex justify-between items-center bg-white hover:bg-gray-50 transition-colors">
                        <span class="font-bold text-gray-900">{{ $faq['q'] }}</span>
                        <svg class="w-5 h-5 transition-transform" :class="active === {{ $id }} ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === {{ $id }}" x-collapse class="px-6 py-5 text-gray-600 border-t border-gray-50 leading-relaxed">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="pt-24 pb-20">
    <!-- Hero -->
    <section class="section-blue !pt-20 !pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="text-blue-200 font-semibold text-sm uppercase tracking-widest mb-4 block">Edukasi Kesehatan</span>
                <h1 class="text-5xl lg:text-7xl font-bold mb-6 font-cormorant leading-tight">Manfaat Luar Biasa Susu Lactose-Free</h1>
                <p class="text-blue-100 text-xl leading-relaxed opacity-90">Mengapa beralih ke Miruku adalah investasi terbaik untuk kesehatan jangka panjang Anda.</p>
            </div>
        </div>
    </section>

    <!-- Key Benefits Grid -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center mb-32">
                <div data-aos="fade-right">
                    <h2 class="text-4xl font-bold text-gray-900 mb-8 font-cormorant">01. Perut Nyaman, Bebas Kembung</h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">Lactose intolerance terjadi ketika tubuh kekurangan enzim laktase untuk mencerna gula dalam susu (laktosa). Miruku sudah melalui proses laktase alami yang memecah laktosa menjadi dua gula sederhana yang mudah diserap tubuh.</p>
                    <ul class="space-y-4">
                        @foreach(['Tidak ada rasa mual setelah minum', 'Bebas kembung dan begah', 'Pencernaan jauh lebih lancar'] as $item)
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
                    <h2 class="text-4xl font-bold text-gray-900 mb-8 font-cormorant">02. Nutrisi Lengkap Tanpa Kompromi</h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">Meskipun bebas laktosa, Miruku tidak kehilangan nutrisi esensialnya. Anda tetap mendapatkan semua kebaikan susu sapi asli yang dibutuhkan tubuh.</p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="border-l-4 border-miruku-blue pl-4">
                            <p class="text-3xl font-bold text-gray-900 font-cormorant">Kalsium</p>
                            <p class="text-gray-500 text-sm">Untuk tulang & gigi kuat</p>
                        </div>
                        <div class="border-l-4 border-miruku-blue pl-4">
                            <p class="text-3xl font-bold text-gray-900 font-cormorant">Protein</p>
                            <p class="text-gray-500 text-sm">Pemulihan jaringan & otot</p>
                        </div>
                        <div class="border-l-4 border-miruku-blue pl-4">
                            <p class="text-3xl font-bold text-gray-900 font-cormorant">Vit D</p>
                            <p class="text-gray-500 text-sm">Membantu penyerapan kalsium</p>
                        </div>
                        <div class="border-l-4 border-miruku-blue pl-4">
                            <p class="text-3xl font-bold text-gray-900 font-cormorant">B12</p>
                            <p class="text-gray-500 text-sm">Mendukung fungsi saraf</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-gray-900 mb-12 text-center font-cormorant">Pertanyaan Populer</h2>
            <div class="space-y-4" x-data="{ active: 1 }">
                @foreach([
                    1 => ['q' => 'Apakah Miruku aman untuk anak-anak?', 'a' => 'Ya, sangat aman. Miruku adalah susu sapi asli yang hanya dihilangkan laktosanya. Sangat baik untuk mendukung pertumbuhan tulang mereka.'],
                    2 => ['q' => 'Apakah rasa Miruku berbeda dengan susu biasa?', 'a' => 'Berkat proses pemecahan laktosa menjadi glukosa dan galaktosa, Miruku memiliki rasa yang sedikit lebih manis secara alami dan tekstur yang lebih creamy.'],
                    3 => ['q' => 'Dapatkah saya menggunakan Miruku untuk kopi atau sereal?', 'a' => 'Tentu saja! Miruku sangat populer di kalangan barista karena kemampuan frothing-nya yang luar biasa dan rasa yang tidak mengubah karakter kopi.'],
                ] as $id => $faq)
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

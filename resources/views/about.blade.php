@extends('layouts.app')

@section('content')
<div class="pt-24 pb-20">
    <!-- Hero Section -->
    <section class="relative py-20 lg:py-32 overflow-hidden bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <span class="text-miruku-blue font-semibold text-sm uppercase tracking-widest mb-4 block">Tentang Kami</span>
                <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 mb-6 font-cormorant leading-tight">Mewujudkan Gaya Hidup Sehat Tanpa Batas</h1>
                <p class="text-gray-600 text-xl leading-relaxed">Miruku lahir dari sebuah visi sederhana: memberikan kebebasan bagi setiap orang untuk menikmati keajaiban susu tanpa kompromi kesehatan.</p>
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
                        <img src="https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&fit=crop&q=80&w=1000" alt="Susu Segar" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <h2 class="text-4xl font-bold text-gray-900 mb-8 font-cormorant">Sebuah Perjalanan Rasa</h2>
                    <div class="space-y-6 text-gray-600 leading-relaxed text-lg">
                        <p>Kisah Miruku dimulai ketika kami menyadari banyaknya orang Indonesia yang harus melepaskan kenikmatan minum susu karena kondisi <em>lactose intolerance</em>. Kembung, nyeri perut, dan rasa tidak nyaman seringkali menjadi penghalang untuk mendapatkan nutrisi penting dari susu.</p>
                        <p>Kami melakukan riset mendalam dan bekerja sama dengan ahli nutrisi untuk menciptakan formula susu yang tidak hanya bebas laktosa, tetapi juga mempertahankan cita rasa asli susu yang <strong>creamy dan premium</strong>.</p>
                        <p>Nama "Miruku" sendiri diambil dari cara pelafalan "Milk" dalam bahasa Jepang, mencerminkan estetika minimalis, kebersihan, dan dedikasi terhadap kualitas sempurna yang kami usung.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 font-cormorant">Nilai-Nilai Kami</h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Tiga pilar utama yang mendasari setiap tetes susu Miruku yang Anda nikmati.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-10">
                @foreach([
                    ['icon' => '🏅', 'title' => 'Kualitas Tanpa Kompromi', 'desc' => 'Kami hanya menggunakan susu dari peternakan terbaik dengan standar kebersihan kelas dunia.'],
                    ['icon' => '🔬', 'title' => 'Inovasi Berkelanjutan', 'desc' => 'Teknologi enzim laktase kami memastikan 99.9% bebas laktosa tanpa merusak nutrisi alami.'],
                    ['icon' => '❤️', 'title' => 'Dedikasi untuk Konsumen', 'desc' => 'Setiap masukan Anda adalah inspirasi kami untuk terus menghadirkan varian rasa yang inovatif.'],
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
            <h2 class="text-4xl font-bold mb-6 font-cormorant">Mari Menjadi Bagian dari Keluarga Miruku</h2>
            <p class="text-blue-100 text-lg mb-10 opacity-90">Mulailah hari Anda dengan energi positif dan perut yang nyaman. Susu yang sehat, untuk hidup yang lebih hebat.</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-white text-miruku-blue font-bold px-10 py-4 rounded-full hover:bg-blue-50 transition-all shadow-xl">Lihat Produk Kami</a>
        </div>
    </section>
</div>
@endsection

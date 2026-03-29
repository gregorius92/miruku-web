<footer class="miruku-wavy miruku-pattern text-white relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <!-- Brand -->
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shadow-lg">
                        <span class="text-miruku-blue font-bold text-xl font-cormorant">M</span>
                    </div>
                    <span class="text-3xl font-bold tracking-tight font-cormorant">Miruku</span>
                </a>
                <p class="text-blue-100 text-sm leading-relaxed mb-8 opacity-90">
                    Susu lactose-free premium terinspirasi dari dedikasi dan kemurnian. 0% laktosa, 100% nutrisi asli.
                </p>
                <!-- Social Media -->
                <div class="flex gap-4">
                    @foreach([
                        ['icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z', 'label' => 'Instagram'],
                        ['icon' => 'M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.27 6.27 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.76a4.85 4.85 0 01-1.01-.07z', 'label' => 'TikTok'],
                        ['icon' => 'M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z', 'label' => 'YouTube'],
                    ] as $social)
                    <a href="{{ $global_seo[strtolower($social['label'])] ?? '#' }}" class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center hover:bg-white hover:text-miruku-blue transition-all duration-300 transform hover:-translate-y-1" aria-label="{{ $social['label'] }}">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="{{ $social['icon'] }}"/></svg>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Navigation -->
            <div>
                <h3 class="text-white font-bold mb-6 text-sm uppercase tracking-widest border-b border-white/20 pb-2 inline-block">Menu</h3>
                <ul class="space-y-4">
                    @foreach([
                        ['route' => 'home', 'label' => 'Beranda'],
                        ['route' => 'products.index', 'label' => 'Koleksi Produk'],
                        ['route' => 'about', 'label' => 'Kisah Miruku'],
                        ['route' => 'benefits', 'label' => 'Edukasi Sehat'],
                    ] as $link)
                    <li>
                        <a href="{{ route($link['route']) }}" class="text-blue-50 hover:text-white text-sm transition-all duration-200 flex items-center gap-2 group">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-300 group-hover:bg-white transition-colors"></span>
                            {{ $link['label'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Shop -->
            <div>
                <h3 class="text-white font-bold mb-6 text-sm uppercase tracking-widest border-b border-white/20 pb-2 inline-block">Belanja Online</h3>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ $global_seo['shopee_link'] ?? '#' }}" class="text-blue-50 hover:text-white text-sm transition-all duration-200 flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-orange-400"></span> Shopee Official
                        </a>
                    </li>
                    <li>
                        <a href="{{ $global_seo['tokopedia_link'] ?? '#' }}" class="text-blue-50 hover:text-white text-sm transition-all duration-200 flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-green-400"></span> Tokopedia Official
                        </a>
                    </li>
                    <li>
                        <a href="/#stores" class="text-blue-50 hover:text-white text-sm transition-all duration-200 flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-blue-300"></span> Cari Toko Offline
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-white font-bold mb-6 text-sm uppercase tracking-widest border-b border-white/20 pb-2 inline-block">Hubungi Kami</h3>
                <div class="space-y-4 mb-6">
                    <p class="text-blue-50 text-sm flex items-center gap-3">
                        <svg class="w-5 h-5 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $global_seo['contact_email'] ?? 'hello@miruku.id' }}
                    </p>
                    <p class="text-blue-50 text-sm flex items-center gap-3">
                        <svg class="w-5 h-5 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $global_seo['contact_phone'] ?? '+62 812-3456-7890' }}
                    </p>
                </div>
                <form class="flex gap-2">
                    <input type="email" placeholder="Email kamu" id="newsletter-email"
                           class="flex-1 bg-white/10 border border-white/20 text-white placeholder-blue-200 text-sm px-4 py-3 rounded-lg focus:outline-none focus:bg-white/20 transition-all">
                    <button type="submit" class="bg-white text-miruku-blue hover:bg-blue-50 px-5 py-3 rounded-lg text-sm font-bold transition-all shadow-lg">
                        Gabung
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-blue-100 text-xs opacity-70">
                &copy; {{ date('Y') }} {{ $global_seo['site_name'] ?? 'Miruku' }}. All rights reserved. | Crafted with passion for a healthier Indonesia.
            </p>
            <div class="flex gap-8">
                <a href="#" class="text-blue-100 hover:text-white text-xs opacity-70 transition-colors uppercase tracking-widest">Privacy</a>
                <a href="#" class="text-blue-100 hover:text-white text-xs opacity-70 transition-colors uppercase tracking-widest">Terms</a>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-200 hover:text-white text-xs opacity-50 transition-colors">Access</a>
            </div>
        </div>
    </div>
</footer>

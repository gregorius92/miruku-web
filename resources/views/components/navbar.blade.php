
<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
     :class="(scrolled || {{ request()->routeIs('home') ? 'false' : 'true' }}) ? 'bg-miruku-blue miruku-pattern shadow-lg border-b border-white/10' : 'bg-transparent'">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ request()->routeIs('home') ? 'javascript:void(0)' : route('home') }}" 
               @click="{{ request()->routeIs('home') ? 'window.scrollTo({top: 0, behavior: \'smooth\'})' : '' }}"
               class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo-white.png') }}" alt="Miruku Logo"
                     class="h-12 w-auto transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-8">
                @foreach([
                    ['route' => 'home', 'label' => __('navbar.home')],
                    ['route' => 'products.index', 'label' => __('navbar.products')],
                    ['route' => 'about', 'label' => __('navbar.about')],
                    ['route' => 'benefits', 'label' => __('navbar.benefits')],
                ] as $link)
                <a href="{{ ($link['route'] === 'home' && request()->routeIs('home')) ? 'javascript:void(0)' : route($link['route']) }}"
                   @if($link['route'] === 'home' && request()->routeIs('home')) @click="window.scrollTo({top: 0, behavior: 'smooth'})" @endif
                   class="text-sm font-medium transition-all duration-300 hover:opacity-70 relative group text-white">
                    {{ $link['label'] }}
                    <span class="absolute -bottom-1 left-0 h-0.5 w-0 bg-white transition-all duration-300 group-hover:w-full"></span>
                </a>
                @endforeach
            </div>

            <!-- CTA -->
            <div class="hidden md:flex items-center gap-6">
                

                <div class="flex items-center gap-4">
                    <a href="#stores"
                       class="text-sm font-medium transition-all duration-300 text-white/80 hover:text-white">
                        {{ __('navbar.find_store') }}
                    </a>
                    <a href="{{ route('products.index') }}"
                       class="px-5 py-2.5 text-sm font-semibold rounded-full transition-all duration-300 hover:scale-105 shadow-lg bg-white text-miruku-blue hover:bg-blue-50">
                        {{ __('navbar.buy_now') }}
                    </a>
                </div>
                <!-- Desktop Language Switcher -->
                <div class="flex items-center bg-white/10 backdrop-blur-sm border border-white/20 rounded-full p-1 gap-1">
                    <a href="{{ route('lang.switch', 'id') }}" 
                       class="px-3 py-1 rounded-full text-[10px] font-bold transition-all {{ App::getLocale() == 'id' ? 'bg-white text-miruku-blue' : 'text-white/60 hover:text-white' }}">
                        ID
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}" 
                       class="px-3 py-1 rounded-full text-[10px] font-bold transition-all {{ App::getLocale() == 'en' ? 'bg-white text-miruku-blue' : 'text-white/60 hover:text-white' }}">
                        EN
                    </a>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenu = !mobileMenu"
                    class="md:hidden p-2 rounded-lg transition-colors duration-200 text-white hover:bg-white/20">
                <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileMenu" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenu"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-miruku-dark border-t border-white/10 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 py-6 space-y-4">
            <div class="flex items-center justify-between mb-6">
                <span class="text-xs font-bold text-white/40 uppercase tracking-widest">{{ __('navbar.select_language') }}</span>
                <div class="flex items-center bg-white/5 rounded-full p-1 gap-1 text-[10px] font-bold">
                    <a href="{{ route('lang.switch', 'id') }}" 
                       class="px-4 py-1.5 rounded-full transition-all {{ App::getLocale() == 'id' ? 'bg-white text-miruku-blue' : 'text-white/60' }}">
                        ID
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}" 
                       class="px-4 py-1.5 rounded-full transition-all {{ App::getLocale() == 'en' ? 'bg-white text-miruku-blue' : 'text-white/60' }}">
                        EN
                    </a>
                </div>
            </div>
            
            <a href="{{ request()->routeIs('home') ? 'javascript:void(0)' : route('home') }}" 
               @click="{{ request()->routeIs('home') ? 'window.scrollTo({top: 0, behavior: \'smooth\'}); mobileMenu = false' : '' }}"
               class="block text-white/90 font-medium py-2 hover:text-white transition-colors border-b border-white/5">{{ __('navbar.home') }}</a>
            <a href="{{ route('products.index') }}" class="block text-white/90 font-medium py-2 hover:text-white transition-colors border-b border-white/5">{{ __('navbar.products') }}</a>
            <a href="{{ route('about') }}" class="block text-white/90 font-medium py-2 hover:text-white transition-colors border-b border-white/5">{{ __('navbar.about') }}</a>
            <a href="{{ route('benefits') }}" class="block text-white/90 font-medium py-2 hover:text-white transition-colors border-b border-white/5">{{ __('navbar.benefits') }}</a>
            <a href="{{ route('products.index') }}" class="block w-full text-center bg-white text-miruku-blue font-bold py-3 rounded-full hover:bg-blue-50 transition-colors mt-4 shadow-lg">
                {{ __('navbar.buy_now') }}
            </a>
        </div>
    </div>
</nav>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <title>{{ $seo['title'] ?? ($global_seo['meta_title'] ?? 'Miruku – Susu Lactose-Free Premium') }}</title>
    <meta name="description" content="{{ $seo['description'] ?? ($global_seo['meta_description'] ?? 'Miruku adalah susu lactose-free premium terbaik di Indonesia.') }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? ($global_seo['meta_keywords'] ?? 'susu lactose free, susu sehat, miruku') }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $seo['title'] ?? ($global_seo['meta_title'] ?? 'Miruku') }}">
    <meta property="og:description" content="{{ $seo['description'] ?? ($global_seo['meta_description'] ?? '') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $global_seo['og_image'] ?? asset('images/og-image.jpg') }}">
    <meta property="og:site_name" content="{{ $global_seo['site_name'] ?? 'Miruku' }}">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['title'] ?? ($global_seo['meta_title'] ?? 'Miruku') }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? ($global_seo['meta_description'] ?? '') }}">
    <meta name="twitter:image" content="{{ $global_seo['og_image'] ?? asset('images/og-image.jpg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Vite Assets (TailwindCSS + Alpine.js) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Organization Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ $global_seo['site_name'] ?? 'Miruku' }}",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/miruku-logo.png') }}",
        "sameAs": [
            "{{ $global_seo['instagram'] ?? '#' }}",
            "{{ $global_seo['tiktok'] ?? '#' }}"
        ],
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{ $global_seo['contact_phone'] ?? '' }}",
            "contactType": "customer service",
            "areaServed": "ID",
            "availableLanguage": "Indonesian"
        }
    }
    </script>

    @stack('head')
</head>
<body class="antialiased bg-white text-gray-900 font-inter" x-data="{ mobileMenu: false, scrolled: false }" @scroll.window="scrolled = window.scrollY > 50">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @stack('scripts')

    <!-- Flash Messages -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
         class="fixed bottom-6 right-6 z-50 bg-green-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
    @endif
</body>
</html>

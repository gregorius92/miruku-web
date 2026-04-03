@extends('layouts.app')

@section('content')
    <section class="relative min-h-[450px] lg:min-h-[550px] flex flex-col justify-center overflow-hidden bg-miruku-blue miruku-pattern text-white" style="background-position: center 40%;">
        <div class="absolute inset-0 bg-miruku-dark/60 pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10 pt-20 pb-20" data-aos="fade-up">
            <h1 class="text-5xl lg:text-7xl font-bold font-cormorant mb-6 text-shadow-premium leading-tight">{{ __('home.stores_title') }}</h1>
            <p class="text-blue-50 text-lg lg:text-xl max-w-2xl mx-auto opacity-95 text-shadow-premium">
                {{ __('home.stores_subtitle') }}
            </p>
        </div>

        <!-- Wave Decoration -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] transform translate-y-[1px]">
            <svg fill="white" class="relative block w-[calc(100%+1.3px)] h-[60px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
            </svg>
        </div>
    </section>

    <section class="py-16 bg-white min-h-[600px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Section -->
            <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl shadow-gray-200/50 p-8 -mt-24 relative z-20 border border-gray-100 mb-16" data-aos="fade-up" data-aos-delay="100">
                <form action="{{ route('stores.index') }}" method="GET" id="filterForm">
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 items-end">
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400">{{ __('home.province') }}</label>
                            <select name="province" id="provinceSelect" class="w-full select2-basic" onchange="document.getElementById('citySelect').value = ''; this.form.submit()">
                                <option value="">{{ __('home.all_province') }}</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province }}" {{ request('province') == $province ? 'selected' : '' }}>{{ $province }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400">{{ __('home.city') }}</label>
                            <select name="city" id="citySelect" class="w-full select2-basic" onchange="this.form.submit()">
                                <option value="">{{ __('home.all_city') }}</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                        {{ ucwords(strtolower(preg_replace(['/^kota\s+/i', '/^kabupaten\s+/i'], ['', 'Kab. '], $city))) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2 col-span-2 lg:col-span-1">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-400">{{ __('home.search') }}</label>
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('home.search_placeholder') }}" 
                                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-miruku-blue transition-all">
                                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-miruku-blue">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="col-span-2 lg:col-span-1">
                            <a href="{{ route('stores.index') }}" class="inline-block w-full text-center bg-gray-50 hover:bg-gray-100 text-gray-400 hover:text-gray-600 font-bold py-3 rounded-xl transition-all text-xs border border-gray-100 uppercase tracking-widest leading-none">
                                {{ __('home.reset_filter') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Stores Grid -->
            @if($stores->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($stores as $store)
                        <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 group" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                            @if($store->map_embed)
                                <div class="h-48 bg-gray-100 overflow-hidden relative">
                                    <iframe src="{{ $store->map_embed }}" class="w-full h-full border-0 grayscale group-hover:grayscale-0 transition-all duration-700" loading="lazy"></iframe>
                                    <div class="absolute inset-x-0 bottom-0 h-10 bg-gradient-to-t from-white to-transparent"></div>
                                </div>
                            @endif
                            <div class="p-8">
                                <span class="inline-block px-3 py-1 bg-blue-50 text-miruku-blue text-[10px] font-bold uppercase tracking-widest rounded-full mb-4">
                                    {{ $store->formatted_city }}
                                </span>
                                <h3 class="text-2xl font-bold text-gray-900 mb-4 font-cormorant">{{ $store->name }}</h3>
                                <div class="space-y-4 text-gray-500 text-sm">
                                    <p class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-miruku-blue flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $store->address }}
                                    </p>
                                    @if($store->phone)
                                        <p class="flex items-center gap-3">
                                            <svg class="w-5 h-5 text-miruku-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2" />
                                            </svg>
                                            {{ $store->phone }}
                                        </p>
                                    @endif
                                    @if($store->open_time && $store->close_time)
                                        <p class="flex items-center gap-3">
                                            <svg class="w-5 h-5 text-miruku-blue flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($store->open_time)->format('H:i') }} – {{ \Carbon\Carbon::parse($store->close_time)->format('H:i') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="mt-8">
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($store->name . ' ' . $store->address) }}" target="_blank"
                                        class="inline-flex items-center gap-2 bg-gray-900 group-hover:bg-miruku-blue text-white font-bold px-6 py-3 rounded-2xl transition-all duration-300 w-full justify-center shadow-lg hover:shadow-miruku-blue/40">
                                        {{ __('home.directions') }}
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-16">
                    {{ $stores->links() }}
                </div>
            @else
                <div class="text-center py-24 bg-gray-50 rounded-4xl border border-gray-100" data-aos="fade-up">
                    <div class="text-6xl mb-6 grayscale opacity-40">📍</div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-3 font-cormorant">{{ __('home.not_found_title') }}</h3>
                    <p class="text-gray-500 max-w-md mx-auto">{{ __('home.not_found_subtitle') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Partner CTA -->
    <section class="py-24 bg-gray-50 overflow-hidden relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10" data-aos="fade-up">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-8 font-cormorant">{{ __('home.partner_title') }}</h2>
            <p class="text-gray-500 text-lg mb-12 opacity-80">
                {{ __('home.partner_subtitle') }}
            </p>
            <a href="https://wa.me/628123456789" target="_blank"
                class="inline-flex items-center gap-3 bg-miruku-blue hover:bg-miruku-dark text-white font-bold px-10 py-5 rounded-full transition-all duration-300 hover:scale-105 shadow-2xl shadow-miruku-blue/30 lg:text-lg">
                {{ __('home.contact_whatsapp') }}
            </a>
        </div>
    </section>
@endsection

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            height: 46px;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            display: flex;
            items-center: center;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 46px;
            padding-left: 1rem;
            color: #374151;
            font-size: 0.875rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 44px;
        }
        .select2-dropdown {
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 50;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.select2-basic').select2({
                    placeholder: 'Pilih...',
                    allowClear: true,
                    width: '100%'
                });
            }, 100);
        });
    </script>
@endpush

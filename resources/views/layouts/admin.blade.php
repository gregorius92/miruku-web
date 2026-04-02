<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('miruku.ico') }}">
    <title>@yield('title', 'Admin') — Miruku Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <style>
        .note-editor.note-frame {
            border-radius: 0.75rem !important;
            border-color: #f3f4f6 !important;
            overflow: hidden;
            box-shadow: none !important;
        }

        .note-toolbar {
            background: #f9fafb !important;
            border-bottom: 1px solid #f3f4f6 !important;
            padding: 0.5rem !important;
        }

        .note-editable {
            min-height: 300px;
            background: white !important;
            padding: 1.5rem !important;
            font-size: 0.875rem !important;
            line-height: 1.6 !important;
        }

        .note-btn {
            border-radius: 0.5rem !important;
            border-color: #f3f4f6 !important;
            padding: 0.25rem 0.5rem !important;
        }

        .note-btn:hover {
            background-color: #f3f4f6 !important;
        }

        /* Fix for Tailwind CSS resetting list styles */
        .note-editable ul,
        .ck-content ul {
            list-style-type: disc !important;
            padding-left: 1.5rem !important;
            margin-bottom: 1rem !important;
        }

        .note-editable ol,
        .ck-content ol {
            list-style-type: decimal !important;
            padding-left: 1.5rem !important;
            margin-bottom: 1rem !important;
        }
    </style>
    <script>
        // Global Auto-Translate Helpers
        const debounce = (func, delay) => {
            let timeout;
            return (...args) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        };

        const autoTranslate = (sourceId, targetId) => {
            const source = document.getElementById(sourceId);
            const target = document.getElementById(targetId);
            if (!source || !target || source === target) return;
            
            let manualEdit = false;
            target.addEventListener('input', () => { manualEdit = true; });

            const translate = debounce(async (text) => {
                const currentTargetValue = target.value.trim();
                // ONLY translate if target is empty AND has NOT been manually edited
                if (!text.trim() || currentTargetValue !== '' || manualEdit) return;

                target.style.opacity = '0.5';
                target.classList.add('animate-pulse');

                try {
                    const response = await fetch('{{ route("admin.translate") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ text, target: 'en' })
                    });
                    
                    const data = await response.json();
                    // DOUBLE CHECK target is still empty and not manually edited before assigning
                    if (data.success && target.value.trim() === '' && !manualEdit) {
                        target.value = data.translatedText;
                    }
                } catch (error) {
                    console.error('Translation error:', error);
                } finally {
                    target.style.opacity = '1';
                    target.classList.remove('animate-pulse');
                }
            }, 1000);

            source.addEventListener('input', (e) => translate(e.target.value));
        };

        const autoTranslateSummernote = (sourceName, targetName) => {
            if (sourceName === targetName) return;
            let manualEdit = false;

            const checkEditors = setInterval(() => {
                const $source = $(`[name="${sourceName}"]`);
                const $target = $(`[name="${targetName}"]`);
                
                if ($source.length && $target.length && $source.data('summernote') && $target.data('summernote')) {
                    clearInterval(checkEditors);
                    
                    const $targetEditor = $target.next('.note-editor');
                    $targetEditor.find('.note-editable').on('keydown', () => { manualEdit = true; });

                    const translate = debounce(async (html) => {
                        const targetHtml = $target.summernote('code');
                        const isTargetEmpty = targetHtml === '' || targetHtml === '<p><br></p>' || targetHtml === '<br>';

                        // ONLY translate if target is empty AND has NOT been manually edited
                        if (!html.trim() || html === '<p><br></p>' || !isTargetEmpty || manualEdit) return;

                        $targetEditor.css('opacity', '0.5');
                        $targetEditor.addClass('animate-pulse');

                        try {
                            const response = await fetch('{{ route("admin.translate") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ text: html, target: 'en' })
                            });
                            
                            const data = await response.json();
                            const currentTargetHtml = $target.summernote('code');
                            const isStillEmpty = currentTargetHtml === '' || currentTargetHtml === '<p><br></p>' || currentTargetHtml === '<br>';

                            // DOUBLE CHECK target is still empty and not manually edited before assigning
                            if (data.success && isStillEmpty && !manualEdit) {
                                $target.summernote('code', data.translatedText);
                            }
                        } catch (error) {
                            console.error('Summernote Translation error:', error);
                        } finally {
                            $targetEditor.css('opacity', '1');
                            $targetEditor.removeClass('animate-pulse');
                        }
                    }, 1500);

                    $source.on('summernote.change', (we, contents) => translate(contents));
                }
            }, 500);
        };
    </script>
</head>

<body class="bg-gray-50 font-inter" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside
            class="w-64 bg-miruku-blue miruku-pattern text-white flex flex-col fixed inset-y-0 left-0 z-50 transition-transform duration-300 lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
            <div class="absolute inset-0 bg-miruku-dark/40 pointer-events-none"></div>
            <div class="relative flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center gap-3 px-6 py-6 border-b border-white/10">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                        <img src="{{ asset('images/logo-white.png') }}" alt="Miruku Logo"
                            class="h-8 w-auto transition-transform duration-300 group-hover:scale-105">
                        <span class="text-xl font-bold tracking-wide">Miruku</span>
                    </a>
                    <span class="text-xs bg-miruku-blue text-white px-2 py-0.5 rounded-full ml-auto">Admin</span>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-1">
                    @foreach ([
        ['route' => 'admin.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => __('admin.sidebar.dashboard')],
        ['route' => 'admin.carousels.index', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'label' => __('admin.sidebar.carousels')],
        ['route' => 'admin.sections.index', 'icon' => 'M4 6h16M4 10h16M4 14h16M4 18h16', 'label' => __('admin.sidebar.sections')],
        ['route' => 'admin.products.index', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'label' => __('admin.sidebar.products')],
        ['route' => 'admin.product_units.index', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'label' => __('admin.sidebar.product_units')],
        ['route' => 'admin.variants.index', 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01', 'label' => __('admin.sidebar.variants')],
        ['route' => 'admin.reviews.index', 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z', 'label' => __('admin.sidebar.reviews')],
        ['route' => 'admin.stores.index', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'label' => __('admin.sidebar.stores')],
        ['route' => 'admin.posts.index', 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 4v4h4', 'label' => __('admin.sidebar.posts')],
        ['route' => 'admin.settings.index', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'label' => __('admin.sidebar.settings')],
        ['route' => 'admin.newsletter.index', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => __('admin.sidebar.newsletter')],
    ] as $navItem)
                        <a href="{{ route($navItem['route']) }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
                      {{ request()->routeIs($navItem['route']) ? 'bg-miruku-blue text-white shadow-lg shadow-miruku-blue/20' : 'text-gray-400 hover:bg-white/10 hover:text-white' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $navItem['icon'] }}" />
                            </svg>
                            {{ $navItem['label'] }}
                        </a>
                    @endforeach
                </nav>

                <!-- User & Logout -->
                <div class="px-4 py-4 border-t border-white/10">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="w-8 h-8 rounded-full bg-miruku-blue flex items-center justify-center text-white text-sm font-semibold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'Admin' }}
                            </p>
                            <p class="text-xs text-gray-400 truncate">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('home') }}" target="_blank"
                            class="flex-1 text-center text-xs text-gray-400 hover:text-white py-1.5 rounded-lg hover:bg-white/10 transition-colors">
                            {{ __('admin.sidebar.view_site') }}
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="flex-1">
                            @csrf
                            <button
                                class="w-full text-xs text-gray-400 hover:text-white py-1.5 rounded-lg hover:bg-white/10 transition-colors">
                                {{ __('admin.sidebar.logout') }}
                            </button>
                        </form>
                    </div>
                </div>
        </aside>

        <!-- Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
            <!-- Top Bar -->
            <header
                class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="lg:hidden flex items-center">
                        <img src="{{ asset('images/logo-white.png') }}" alt="Miruku Logo"
                            class="h-8 w-auto bg-miruku-blue p-1.5 rounded-lg">
                    </div>
                    <h2 class="text-lg font-semibold text-gray-900">@yield('title', 'Dashboard')</h2>
                </div>

                <!-- Admin Language Switcher -->
                <div class="flex items-center bg-gray-100 rounded-lg p-1 gap-1">
                    <a href="{{ route('lang.switch', 'id') }}"
                        class="px-3 py-1 text-xs font-bold rounded-md transition-all {{ App::getLocale() == 'id' ? 'bg-white text-miruku-blue shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                        ID
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="px-3 py-1 text-xs font-bold rounded-md transition-all {{ App::getLocale() == 'en' ? 'bg-white text-miruku-blue shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                        EN
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                        class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm flex items-center gap-2 shadow-sm">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div
                        class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm shadow-sm">
                        <div class="flex items-center gap-2 mb-2 font-semibold">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ __('admin.common.errors_found') }}
                        </div>
                        <ul class="list-disc list-inside space-y-1 ml-1 text-xs opacity-90">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('admin-content')
            </main>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.editor').each(function() {
                var $editor = $(this);
                $editor.summernote({
                    height: 300,
                    tabsize: 2,
                    fontNames: ['Inter', 'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    callbacks: {
                        onImageUpload: function(files) {
                            uploadImage(files[0], this);
                        }
                    }
                });
            });
        });

        function uploadImage(file, editor) {
            let data = new FormData();
            data.append("upload", file);
            
            $.ajax({
                url: "{{ route('admin.upload-image') }}",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.url) {
                        $(editor).summernote('insertImage', response.url);
                    }
                },
                error: function(data) {
                    console.error("Image upload failed:", data);
                    let message = "The image failed to upload.";
                    if (data.responseJSON && data.responseJSON.error && data.responseJSON.error.message) {
                        message = data.responseJSON.error.message;
                    } else if (data.status === 413) {
                        message = "File too large. Maximum size is 100MB.";
                    }
                    alert(message);
                }
            });
        }
    </script>
</body>

</html>

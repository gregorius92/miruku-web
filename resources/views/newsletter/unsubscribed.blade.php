<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berhenti Berlangganan — Miruku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-cream-50 font-inter min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl shadow-miruku-blue/10 overflow-hidden border border-miruku-blue/5">
        <div class="bg-miruku-blue p-8 text-center bg-[url('/images/bg-pattern-blue.png')] bg-cover">
            <a href="{{ route('home') }}" class="inline-block transition-transform hover:scale-105">
                <img src="{{ asset('images/logo-white.png') }}" alt="Miruku Logo" class="h-12 w-auto mx-auto">
            </a>
        </div>
        
        <div class="p-8 text-center">
            @if($status === 'success')
                <div class="w-16 h-16 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-3">Berhasil!</h1>
            @else
                <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-3">Mohon Maaf</h1>
            @endif

            <p class="text-gray-600 mb-8 leading-relaxed">
                {{ $message }}
            </p>

            <a href="{{ route('home') }}" class="inline-block bg-miruku-blue text-white font-bold px-8 py-3 rounded-xl hover:bg-miruku-dark transition-colors shadow-lg shadow-miruku-blue/20">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; margin: 0; padding: 0; background-color: #fdfaf5; -webkit-font-smoothing: antialiased; }
        .wrapper { width: 100%; table-layout: fixed; background-color: #fdfaf5; padding-bottom: 40px; }
        .main { background-color: #ffffff; width: 100%; max-width: 600px; margin: 0 auto; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 6px rgba(52, 116, 162, 0.05); }
        .header { background-color: #3474a2; padding: 40px 20px; text-align: center; }
        .logo { max-width: 150px; height: auto; }
        .content { padding: 40px 30px; color: #374151; line-height: 1.6; }
        h1 { color: #1f2937; font-size: 24px; font-weight: 700; margin-top: 0; margin-bottom: 16px; text-align: center; }
        p { margin-bottom: 20px; font-size: 16px; }
        .btn-container { text-align: center; margin-top: 30px; }
        .btn { display: inline-block; background-color: #3474a2; color: #ffffff !important; padding: 16px 36px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 16px; transition: background-color 0.3s; box-shadow: 0 10px 15px -3px rgba(52, 116, 162, 0.2); }
        .footer { text-align: center; padding: 20px; color: #9ca3af; font-size: 12px; }
        .footer a { color: #9ca3af; text-decoration: underline; }
        
        /* For custom content from Broadcast */
        .custom-content img { max-width: 100%; height: auto; border-radius: 12px; margin: 20px 0; }
        .custom-content h2 { color: #1f2937; font-size: 20px; margin-top: 30px; }
        .custom-content ul { padding-left: 20px; margin-bottom: 20px; }
        .custom-content li { margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <center>
            <div style="height: 40px;"></div>
            <div class="main">
                <div class="header">
                    <img src="{{ config('app.url') }}/images/logo-white.png" alt="Miruku Logo" class="logo">
                </div>
                <div class="content">
                    @yield('content')
                </div>
                <div style="height: 40px;"></div>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Semua Hak Dilindungi.<br>
                Gedung Miruku, Jakarta, Indonesia.</p>
                <div style="height: 10px;"></div>
                <p>
                    Anda menerima email ini karena Anda berlangganan newsletter Miruku.<br>
                    <a href="{{ route('newsletter.unsubscribe', ['email' => $email ?? '', 'token' => $token ?? '']) }}">Berhenti Berlangganan</a>
                </p>
            </div>
        </center>
    </div>
</body>
</html>

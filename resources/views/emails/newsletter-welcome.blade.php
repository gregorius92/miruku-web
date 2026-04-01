@extends('emails.layout')

@section('content')
    <h1>Selamat Bergabung di Keluarga Miruku! 🥛</h1>
    <p>Halo,</p>
    <p>Terima kasih telah bergabung dengan newsletter kami! Kami sangat senang Anda menjadi bagian dari perjalanan kami dalam menyebarkan kebaikan susu premium yang bebas laktosa.</p>
    
    <div style="background-color: #fdfaf5; border-radius: 16px; padding: 24px; margin-bottom: 30px; border: 1px solid #faf0dc;">
        <div style="display: flex; align-items: flex-start; margin-bottom: 12px;">
            <span style="font-size: 18px; margin-right: 12px; margin-top: 2px;">✨</span>
            <span style="font-size: 15px; font-weight: 600; color: #3474a2;">Produk Baru & Inovasi</span>
        </div>
        <div style="display: flex; align-items: flex-start; margin-bottom: 12px;">
            <span style="font-size: 18px; margin-right: 12px; margin-top: 2px;">🎁</span>
            <span style="font-size: 15px; font-weight: 600; color: #3474a2;">Penawaran & Diskon Eksklusif</span>
        </div>
        <div style="display: flex; align-items: flex-start; margin-bottom: 12px;">
            <span style="font-size: 18px; margin-right: 12px; margin-top: 2px;">🥛</span>
            <span style="font-size: 15px; font-weight: 600; color: #3474a2;">Tips Hidup Sehat & Resep Seru</span>
        </div>
        <div style="display: flex; align-items: flex-start; margin-bottom: 12px;">
            <span style="font-size: 18px; margin-right: 12px; margin-top: 2px;">📍</span>
            <span style="font-size: 15px; font-weight: 600; color: #3474a2;">Info Cabang & Lokasi Baru</span>
        </div>
    </div>

    <p>Kami percaya setiap orang berhak menikmati rasa susu yang premium dan lezat tanpa rasa khawatir. Nantikan kejutan menarik dari kami!</p>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ config('app.url') }}" style="display: inline-block; background-color: #3474a2; color: #ffffff !important; padding: 16px 36px; border-radius: 12px; text-decoration: none; font-weight: 700; font-size: 16px; transition: background-color 0.3s; box-shadow: 0 10px 15px -3px rgba(52, 116, 162, 0.2);">Kunjungi Situs Kami</a>
    </div>
@endsection

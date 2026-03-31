@props(['variant' => 'text'])

@if($variant === 'white')
    <img src="{{ asset('images/logo-white.png') }}" {{ $attributes->merge(['class' => 'h-16 w-auto']) }} alt="Miruku Logo">
@else
    <span {{ $attributes->merge(['class' => 'text-3xl font-bold tracking-tight text-miruku-blue']) }}>Miruku</span>
@endif


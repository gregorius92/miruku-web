@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-miruku-blue focus:ring-miruku-blue rounded-md shadow-sm']) !!}>

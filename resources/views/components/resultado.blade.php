@props(['resultado'])

@php
    $classes = match($resultado) {
        1 => 'text-red-500',
        2 => 'text-green-500',
        default => 'text-gray-500',
    };

    $text = match($resultado) {
        1 => 'Positivo',
        2 => 'Negativo',
        default => 'Sin resultado',
    };
@endphp

<p class="{{ $classes }}">
    {{ $text }}
</p>

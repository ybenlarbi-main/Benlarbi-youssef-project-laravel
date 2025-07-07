@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 py-2 text-sm font-medium rounded-full bg-reddit-orange text-white transition-all duration-200'
            : 'inline-flex items-center px-4 py-2 text-sm font-medium rounded-full text-neutral-600 hover:text-neutral-800 hover:bg-neutral-100 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

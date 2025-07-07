@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 rounded-xl text-sm font-medium bg-reddit-orange text-white transition-all duration-200'
            : 'flex items-center px-4 py-3 rounded-xl text-sm font-medium text-neutral-700 hover:bg-neutral-100 transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

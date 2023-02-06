@props([ 'active' => false, 'href' ])

@php
    $classes = 'block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white';

    if ($active) {
        $classes = $classes . ' bg-blue-500 text-white';
    }
@endphp

<li>
    <a
        href="{{ $href }}"
        class="{{ $classes }}"
    >
        {{ $slot }}
    </a>
</li>

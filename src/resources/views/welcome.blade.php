@props(['posts'])

<x-layout>

    @include('_header')

    <x-post-grid :posts="$posts" />
</x-layout>
@props(['posts'])

<x-layout>
    <x-post-grid :posts="$posts" />
</x-layout>
@props(['posts', 'categories', 'currentCategory'])

<x-layout>

    @include('partials/_post-filter')

    <x-post-grid :posts="$posts" />
</x-layout>
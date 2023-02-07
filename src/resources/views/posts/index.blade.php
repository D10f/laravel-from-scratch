@props(['posts', 'categories', 'currentCategory'])

<x-layout>

    @include('posts._filter')

    <x-post-grid :posts="$posts" />
    {{ $posts->links() }}
</x-layout>

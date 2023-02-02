@props(['posts'])

<div class="lg:grid lg:grid-cols-6">
    @if ($posts->count() === 0)
        <p>No posts found...</p>
    @endif

    @foreach ($posts as $post)
        <x-post-card :post="$post" :class="$loop->index < 2 ? 'col-span-3' : 'col-span-2'" />
    @endforeach
</div>
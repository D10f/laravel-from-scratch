@props(['comment'])

<article class="flex space-x-4 bg-gray-100 p-6 mb-4 rounded-xl border border-gray-200">
    <div class="flex-shrink-0">
        <img class="rounded-xl" src="https://i.pravatar.cc/100" alt="" width="60px" height="60px">
    </div>

    <div>
        <header class="mb-4">
            <h3 class="font-bold">{{ $comment->author->username }}</h3>
            <p class="text-sm"><time>{{ $comment->created_at->diffForHumans() }}</time></p>
        </header>
        <p>{{ $comment->body }}</p>
    </div>

</article>

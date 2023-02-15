<x-layout>
    <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
        <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
            <img src="/images/illustration-1.png" alt="" class="rounded-xl">

            <p class="mt-4 block text-gray-400 text-xs">
                Published <time>{{ $post->created_at->diffForHumans() }}</time>
            </p>

            <div class="flex items-center lg:justify-center text-sm mt-4">
                <img src="/images/lary-avatar.svg" alt="Lary avatar">
                <div class="ml-3 text-left">
                    <h5 class="font-bold">
                        <a href="/?author={{ $post->author->username }}">{{ $post->author->name }}</a>
                    </h5>
                    <h6>Mascot at Laracasts</h6>
                </div>
            </div>
        </div>

        <div class="col-span-8">
            <div class="hidden lg:flex justify-between mb-6">
                <a href="/"
                    class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                    <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path class="fill-current"
                                d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                            </path>
                        </g>
                    </svg>

                    Back to Posts
                </a>

                <div class="space-x-2">
                    <a href="/categories/{{ $post->category->slug }}"
                        class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                        style="font-size: 10px">{{ $post->category->name }}</a>
                </div>
            </div>

            <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                {{ $post->title }}
            </h1>

            <div class="space-y-4 lg:text-lg leading-loose">
                {!! $post->body !!}
            </div>
        </div>

        <section class="col-span-8 col-start-5 mt-10">

            <form action="" class="bg-gray-100 p-6 mb-4 rounded-xl border border-gray-200">
                @csrf

                <header class="flex items-center">
                    <img class="rounded-xl" src="https://i.pravatar.cc/100" alt="User avatar" width="60px" height="60px">
                    <h2 class="ml-4">Want to participate?</h2>
                </header>

                <div class="mt-6">
                    <textarea class="w-full text-sm p-2 bg-gray-100 focus:outline-none focus:ring" name="comment" id="comment" placeholder="Quick, think of something to say..." cols="30" rows="5" ></textarea>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white uppercase font-semibold py-2 px-10 text-xs rounded-2xl hover:bg-blue-600">Submit</button>
                </div>
            </form>

            @foreach ($post->comments as $comment)
                <x-post-comment :comment="$comment" />
            @endforeach
        </section>
    </article>
</x-layout>

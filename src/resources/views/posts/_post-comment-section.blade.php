<section class="col-span-8 col-start-5 mt-10">
    @auth
        <form method="POST" action="/post/{{ $post->slug }}/comments" class="bg-gray-100 p-6 mb-4 rounded-xl border border-gray-200">
            @csrf

            <header class="flex items-center">
                <img class="rounded-xl" src="https://i.pravatar.cc/100" alt="User avatar" width="60px" height="60px">
                <h2 class="ml-4">Want to participate?</h2>
            </header>

            <div class="mt-6">
                <textarea class="w-full text-sm p-2 bg-gray-100 focus:outline-none focus:ring" name="body" id="comment" placeholder="Quick, think of something to say..." cols="30" rows="5" required></textarea>
                @error('body')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="bg-blue-500 text-white uppercase font-semibold py-2 px-10 text-xs rounded-2xl hover:bg-blue-600">Submit</button>
            </div>
        </form>
    @else
        <div class="font-semibold pb-6">
            <p><a class="text-blue-500 hover:underline" href="/register">Register</a> or <a class="text-blue-500 hover:underline" href="/login">Login</a> to leave a comment.</p>
        </div>
    @endauth

    @foreach ($post->comments as $comment)
        <x-post-comment :comment="$comment" />
    @endforeach
</section>

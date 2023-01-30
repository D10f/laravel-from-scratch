<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Posts</title>
</head>
<body>
    @foreach ($posts as $post)
        <header>
            <span>
                By <a href="/user/{{ $post->author->username }}">
                    {{ $post->author->username }}
                </a>
            </span>
            <h2>
                <a href="/post/{{$post->slug}}">{{$post->title}}</a>
            </h2>
        </header>
        <aside>
            <span><a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a></span>
        </aside>
        {{ $post->excerpt }}
    @endforeach
</body>
</html>

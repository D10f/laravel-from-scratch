<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Single post</title>
</head>
<body>
        <header>
            <span>
                By <a href="/user/{{ $post->author->username }}">
                    {{ $post->author->username }}
                </a>
            </span>
            <h2>{{$post->title}}</h2>
        </header>
    <aside>
        <span><a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a></span>
    </aside>
    <main>{!! $post->body !!}</main>
    <a href="/">Back</a>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>{{ $post->content }}</title>
</head>
<body>
    <h1>{{ $post->content }}</h1>
    <small>Posted by {{ $post->user->name }}</small>
    <a href="{{ route('posts.index') }}">Back to Posts</a>
</body>
</html>

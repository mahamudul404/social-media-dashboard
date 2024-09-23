<!DOCTYPE html>
<html>
<head>
    <title>All Posts</title>
</head>
<body>
    <h1>All Posts</h1>
    <a href="{{ route('posts.create') }}">Create New Post</a>
    <ul>
        @foreach ($posts as $post)
            <li>
                <p>{{ $post->content }}</p>
                @if($post->image)
                    <img src=" {{ $post->getImageUrl() }} " alt="Post Image" width="100">
                @endif
                <small>Posted by {{ $post->user->name }}</small>
                <a href="{{ route('posts.show', $post) }}">View</a>
                <a href="{{ route('posts.edit', $post) }}">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>

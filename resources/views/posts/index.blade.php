<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>All Posts</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-success">Create New Post</a>
        </div>

        <!-- Display All Posts -->
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="card-text">{{ $post->content }}</p>

                            <!-- Display Post Image if Exists -->
                            @if ($post->image)
                                <img src="{{ $post->getImageUrl() }}" class="img-fluid mb-3" alt="Post Image">
                            @endif

                            <p class="text-muted">Posted by {{ $post->user->name }}</p>

                            <!-- Action Buttons -->
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

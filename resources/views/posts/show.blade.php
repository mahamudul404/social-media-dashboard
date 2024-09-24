<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Post Card -->
        <div class="card mb-3">
            <div class="card-body">
                <!-- Post Content -->
                <h5 class="card-title">{{ $post->user->name }}'s Post</h5>
                <p class="card-text">{{ $post->content }}</p>

                <!-- Display Image if exists -->
                @if ($post->image)
                    <img src="{{ $post->getImageUrl() }}" class="img-fluid mb-3" alt="Post Image">
                @endif

                <!-- Like and Unlike Button -->
                <form action="{{ route('posts.like', $post->id) }}" method="POST">
                    @csrf
                    @if($post->likedByUser(Auth::id()))
                        <button type="submit" class="btn btn-danger">Unlike</button>
                    @else
                        <button type="submit" class="btn btn-primary">Like</button>
                    @endif
                    <span class="ml-2">{{ $post->likes->count() }} Likes</span>
                </form>

                <!-- Post Date -->
                <p class="card-text"><small class="text-muted">Posted on {{ $post->created_at->format('M d, Y') }}</small></p>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="card">
            <div class="card-header">
                Comments ({{ $post->comments->count() }})
            </div>
            <div class="card-body">
                <!-- Display Comments -->
                @if ($post->comments->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach ($post->comments as $comment)
                            <li class="list-group-item">
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->body }}
                                <br>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No comments yet. Be the first to comment!</p>
                @endif

                <!-- Add a Comment -->
                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="comment">Add Comment</label>
                        <textarea class="form-control" id="comment" name="body" rows="3" placeholder="Write your comment here"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Submit Comment</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

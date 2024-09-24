<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    

        <!-- Display the Current Post Image if Exists -->
        @if($post->image)
            <div class="mb-3">
                <label class="form-label">Current Image</label>
                <div>
                    <img src=" {{ $post->getImageUrl() }} " class="img-fluid" alt="Post Image" style="max-width: 200px;">
                </div>
            </div>
        @endif

        <!-- Form to Edit the Post -->
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control" rows="3" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload New Image (Optional)</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

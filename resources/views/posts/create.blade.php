<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
</head>
<body>
    <h1>Create New Post</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="content" placeholder="What's on your mind?" required></textarea>
        <br>
        <input type="file" name="image" accept="image/*">
        <br>
        <button type="submit">Post</button>
    </form>
</body>
</html>

<x-app-layout>
    <div class="container mx-auto py-8">
        <!-- Post Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
            <div class="p-6">
                <!-- Post Content -->
                <h5 class="text-xl font-bold">{{ $post->user->name }}'s Post</h5>
                <p class="mt-2 text-gray-700">{{ $post->content }}</p>

                <!-- Display Image if exists -->
                @if ($post->image)
                    <div class="w-full h-0 aspect-w-16 aspect-h-9 mt-4 mb-4">
                        <img src="{{ $post->getImageUrl() }}" class="w-full h-full object-cover rounded-lg" alt="Post Image">
                    </div>
                @endif

                <!-- Like and Unlike Button -->
                <form action="{{ route('posts.like', $post->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="flex items-center">
                        @if($post->likedByUser(Auth::id()))
                            <!-- Unlike Button -->
                            <button type="submit" class="flex items-center text-red-500 bg-gray-100 hover:bg-gray-200 font-bold py-2 px-4 rounded-lg transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                                Unlike
                            </button>
                        @else
                            <!-- Like Button -->
                            <button type="submit" class="flex items-center text-blue-500 bg-gray-100 hover:bg-gray-200 font-bold py-2 px-4 rounded-lg transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                                Like
                            </button>
                        @endif
                        <span class="ml-4 text-gray-600">{{ $post->likes->count() }} Likes</span>
                    </div>
                </form>

                <!-- Post Date -->
                <p class="mt-4 text-sm text-gray-500">Posted on {{ $post->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
            <div class="border-b pb-4 mb-4">
                <h5 class="text-lg font-semibold">Comments ({{ $post->comments->count() }})</h5>
            </div>

            <!-- Display Comments -->
            @if ($post->comments->count() > 0)
                <ul class="space-y-4">
                    @foreach ($post->comments as $comment)
                        <li class="bg-gray-100 p-4 rounded-lg">
                            <strong class="text-gray-800">{{ $comment->user->name }}:</strong> 
                            <p class="mt-2 text-gray-700">{{ $comment->body }}</p>
                            <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600">No comments yet. Be the first to comment!</p>
            @endif

            <!-- Add a Comment -->
            <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="comment" class="block text-gray-700 font-medium">Add Comment</label>
                    <textarea id="comment" name="body" rows="3" class="w-full p-3 border border-gray-300 rounded-lg mt-2" placeholder="Write your comment here"></textarea>
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">
                    Submit Comment
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

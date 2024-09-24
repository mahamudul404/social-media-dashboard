<x-app-layout>
    <div class="container mx-auto py-8">
        <!-- Post Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
            <div class="p-6">
                <!-- Post Header -->
                <div class="flex items-center mb-6">
                    <img src="{{ $post->user->profile_image_url }}" class="w-12 h-12 rounded-full object-cover mr-4" alt="">
                    <div>
                        <h5 class="text-2xl font-bold text-gray-900">{{ $post->user->name }}</h5>
                        <p class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <!-- Post Content -->
                <p class="text-gray-800 text-lg mb-4">{{ $post->content }}</p>

                <!-- Display Image if exists -->
                @if ($post->image)
                    <div class="w-full rounded-lg overflow-hidden mb-6">
                        <img src="{{ $post->getImageUrl() }}" class="w-full h-80 object-cover shadow-md" alt="Post Image">
                    </div>
                @endif

                <!-- Like and Unlike Button -->
                <form action="{{ route('posts.like', $post->id) }}" method="POST" class="flex items-center space-x-4 mb-4">
                    @csrf
                    @if($post->likedByUser(Auth::id()))
                        <!-- Unlike Button -->
                        <button type="submit" class="flex items-center bg-red-600 hover:bg-red-700 text-gray-400 font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out shadow-md transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 fill-current" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            Unlike
                        </button>
                    @else
                        <!-- Like Button -->
                        <button type="submit" class="flex items-center bg-gray-600 hover:bg-red-700 text-black font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out shadow-md transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 fill-current" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            Like
                        </button>
                    @endif
                    <span class="text-gray-700 font-medium">{{ $post->likes->count() }} Likes</span>
                </form>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
            <div class="border-b pb-4 mb-6">
                <h5 class="text-lg font-semibold text-gray-800">Comments ({{ $post->comments->count() }})</h5>
            </div>

            <!-- Display Comments -->
            @if ($post->comments->count() > 0)
                <ul class="space-y-4">
                    @foreach ($post->comments as $comment)
                        <li class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <div class="flex items-center mb-2">
                                <img src="{{ $comment->user->profile_image_url }}" class="w-8 h-8 rounded-full object-cover mr-3" alt="">
                                <div>
                                    <strong class="text-gray-800">{{ $comment->user->name }}:</strong>
                                    <p class="text-gray-700 mt-1">{{ $comment->body }}</p>
                                    <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
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
                    <textarea id="comment" name="body" rows="3" class="w-full p-3 border border-gray-300 rounded-lg mt-2 focus:ring-2 focus:ring-blue-500" placeholder="Write your comment here"></textarea>
                </div>
                <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-red-400 font-semibold py-2 px-4 rounded-lg transition duration-300 ease-in-out">
                    Submit Comment
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

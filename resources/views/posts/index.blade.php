<x-app-layout title="Home - Recent Posts">
    <div class="container mx-auto py-8">
        <div class="flex flex-col items-center">
            <h1 class="text-3xl font-bold mb-6 text-center">Recent Posts</h1>

            <!-- Posts -->
            @foreach ($posts as $post)
                <div class="bg-white shadow-md rounded-lg w-full max-w-xl mb-6">
                    <!-- Post Header (User Info) -->
                    <div class="flex items-center bg-blue-600 text-white p-4 rounded-t-lg">
                        <img src="{{ $post->getImageUrl() }}" alt="Image" class="rounded-full w-12 h-12 mr-4">
                        <div>
                            <h5 class="text-lg font-semibold">{{ $post->user->name }}</h5>
                            <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="p-4">
                        <p class="text-gray-700 mb-3">{{ $post->content }}</p>

                        <!-- Post Image (if available) -->
                        @if ($post->image)
                            <img src="{{ $post->getImageUrl() }}" src="{{ asset('storage/images/' . $post->image) }}" class="w-full h-auto rounded-lg mb-4" alt="Post Image">
                        @endif

                        <div class="flex justify-between items-center">
                            <!-- Interaction Buttons -->
                            <div class="flex space-x-4">
                                <button class="text-blue-500 hover:text-blue-600">
                                    <i class="fas fa-thumbs-up"></i> Like
                                </button>
                                <button class="text-gray-500 hover:text-gray-600">
                                    <i class="fas fa-comment"></i> Comment
                                </button>
                            </div>

                            <!-- Read More -->
                            <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="mt-4">
                {{-- {{ $posts->links() }} --}}
            </div>
        </div>
    </div>
</x-app-layout>

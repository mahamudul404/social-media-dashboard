<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Create a New Post</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to Create a New Post -->
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-medium mb-2">Content</label>
                <textarea name="content" id="content" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" rows="4" placeholder="What's on your mind?" required></textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-medium mb-2">Upload Image</label>
                <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500" accept="image/*">
            </div>

            <button type="submit" class="bg-gray-500 hover:bg-gray-900 text-white-500 font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                Post
            </button>
        </form>
    </div>
</x-app-layout>

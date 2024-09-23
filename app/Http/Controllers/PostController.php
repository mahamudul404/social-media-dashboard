<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Display a listing of the posts
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    // Show the form for creating a new post
    public function create()
    {
        return view('posts.create');
    }

    // Store a newly created post in storage
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'content' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
        ]);

        $imageName = null;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension(); // Generate a unique name for the image
            $image->storeAs('images', $imageName,'public'); // Store the image in the public/images directory
        }

        // Create a new post
        Post::create([
            'user_id' => Auth::id(), // Get the ID of the currently authenticated user
            'content' => $request->input('content'),
            'image' => $imageName, // Store the image file name
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Display the specified post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Update the specified post in storage
    public function update(Request $request, Post $post)
    {
        // Validate the incoming request
        $request->validate([
            'content' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
        ]);

        $imageName = $post->image;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($imageName && Storage::exists('public/images/' . $imageName)) {
                Storage::delete('public/images/' . $imageName);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension(); // Generate a unique name for the image
            $image->storeAs('public/images', $imageName); // Store the new image
        }

        // Update the post
        $post->update([
            'content' => $request->input('content'),
            'image' => $imageName, // Update the image file name
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Remove the specified post from storage
    public function destroy(Post $post)
    {
        // Delete the image if it exists
        if ($post->image && Storage::exists('public/images/' . $post->image)) {
            Storage::delete('public/images/' . $post->image);
        }

        // Delete the post
        $post->delete();

        // Redirect to the index page with a success message
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Display a listing of the posts
    public function index()
    {
        // Retrieve all posts with their associated user, sorted by the latest
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
        ]);

        // Create a new post
        Post::create([
            'user_id' => Auth::id(), // Get the ID of the currently authenticated user
            'content' => $request->input('content'),
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Display the specified post
    public function show(Post $post)
    {
        // Show the post details
        return view('posts.show', compact('post'));
    }

    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        // Show the form to edit the post
        return view('posts.edit', compact('post'));
    }

    // Update the specified post in storage
    public function update(Request $request, Post $post)
    {
        // Validate the incoming request
        $request->validate([
            'content' => 'required|max:255',
        ]);

        // Update the post
        $post->update([
            'content' => $request->input('content'),
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Remove the specified post from storage
    public function destroy(Post $post)
    {
        // Delete the post
        $post->delete();

        // Redirect to the index page with a success message
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}

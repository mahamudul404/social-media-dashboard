<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnSelf;

class CommentController extends Controller
{
    public function store(Request $request, Post $post){

        $request->validate([
            'body' => 'required|max:500',
        ]);
        Comment::create([
            'body' => $request->input('body'),
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);

        return redirect()->route('posts.show', $post->id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        
        $post->comments()->create($data);

        return redirect()->route('post', $post)->with('success', 'Comment added successfully!');
    }

    
    public function destroy(Comment $comment)
    {
        $post = $comment->post;
        $comment->delete();

        return redirect()->route('post', $post)->with('success', 'Comment deleted successfully!');
    }
}
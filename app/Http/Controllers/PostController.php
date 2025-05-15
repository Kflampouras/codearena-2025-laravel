<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
   public function index(?User $user = null)
    {

    $posts = Post::when($user, function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })
    ->whereNotNull('image')        
    ->where('image', '!=', '') 
    ->where('published_at', '<=', now())  
    ->orderByDesc('promoted') 
    ->orderBy('published_at', 'desc')  
    ->paginate(9);


        $authorsWithPublishedPosts = User::whereHas('posts', function ($query) {
        $query->whereNotNull('published_at')
              ->where('published_at', '<=', now());
        })->get();

        return view('posts.index', compact('posts', 'authorsWithPublishedPosts'));
    }

    public function show(Post $post)
    {
        if (! $post->published_at) {
            abort(404);
        }

          

        $comments = $post->comments()->orderBy('created_at', 'desc')->get();

        
        return view('posts.show', compact('post', 'comments'));
        



    }

    public function promoted()
    {
        $promotedPosts = Post::where('promoted', true)
                            ->whereNotNull('published_at')
                            ->orderBy('published_at', 'desc')
                            ->get();

        return view('posts.promoted', compact('promotedPosts'));
    }





}

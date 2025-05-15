<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(?User $user = null)
    {
        $posts = Post::when($user, function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })
        ->where('image', '!=', null)
        ->where('published_at', '!=', null)
        ->orderBy('promoted', 'desc')
        ->orderBy('published_at' , 'desc')
        ->paginate(9);
        
        $authors = User::whereIn('id', $posts->pluck('user_id'))->get();

        return view('posts.index', compact('posts','authors'));
    }

    public function show(Post $post)
    {
        abort_if($post->published_at === null, 404);
        return view('posts.show', compact('post'));
    }

    public function promoted(?User $user = null)
    {
        $promoted_posts= Post::when($user, function ($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->where('promoted', true)
        ->where('published_at', '!=', null)
        ->orderBy('published_at', 'desc')
        ->get();

        return view('posts.promoted', compact('promoted_posts'));
    }
}


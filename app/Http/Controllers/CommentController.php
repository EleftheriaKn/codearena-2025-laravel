<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'exists:posts,id',
            'name' => 'required|string',
            'body' => 'required|string',
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'name' => $request->name,
            'body' => $request->body,
        ]);
        $post = Post::find($request->post_id);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')
                            ->get();
        return view('comments.index', compact('comments'));
    }

    public function delete(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('post',$comment->post)->with('success', 'Comment deleted successfully.');
    }
}
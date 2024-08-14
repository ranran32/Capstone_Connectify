<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class CommentController extends Controller
{
    public function show($postId) {
        $post= Post::findOrFail($postId);
        $comments = Comment::where('post_id', $postId)->get();
        return view('comment.show',compact('post','comments'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'content' => 'required|string|max:255',
            'post_id' => 'required|exists:posts,id',
        ]);
    
        // Create a new Comment instance
        $comment = new Comment();
    
        // Set the attributes
        $comment->content = $validatedData['content'];
        $comment->post_id = $validatedData['post_id'];
        $comment->user_id = auth()->id();
    
        // Save the comment to the database
        $comment->save();
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Comment added successfully!');
    }
    
}

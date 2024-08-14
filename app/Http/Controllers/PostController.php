<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{


    public function create() {
        return view('post.create');
    }

    public function store(Request $request)
{
    $user = Auth::user();

    $validatedData = $request->validate([
        'content' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $post = new Post();
    $post->content = $validatedData['content'];
    $post->user()->associate($user);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images/posts');
        $fileName = basename($imagePath);
        $imageUrl = '/storage/app/images/posts/' . $fileName;
        
        $post->image = $imageUrl;
    }

    $post->save();

    return redirect()->route('dashboard')->with('success', 'Post created successfully.');
}


public function getEdit($postId) {
    $post= Post::findOrFail($postId);
    return view('post.update', compact('post'));
}

    public function update(Request $request, $postId) {
        $post= Post::findOrFail($postId);
        $post->content= $request->input('content');
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }

    public function delete($postId) {
       $post= Post::findOrFail($postId);
       $post->delete();

       return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
       
    }

}

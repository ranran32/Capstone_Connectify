<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    protected $like;

    public function __construct()
    {
        $this->like= new Like;
    }

    public function like(Request $request){
        $id= $request->id;
        $data= [
            'user_id'=> auth()->id(),
            'post_id'=> $id
        ];
      $this->like->likePost($data);
      return response()->json([
        'status'=> 'success'
      ]);
    }

    public function unlike(Request $request){
        $id= $request->id;
        $this->like->deletePost($id);

        return response()->json([
            'status'=> 'success'
        ]);
    }





    // public function like($postId) {
    //     $post= Post::findOrFail($postId);
    //     if($post->likes()->where('user_id', auth()->id())->exists()){
    //         return redirect()->back()-> with('error', 'You are already like this post.');
    //     }

    //     $like= new Like();
    //     $like->post_id= $postId;
    //     $like->user_id= auth()->id();
    //     $like->save();


    //     return redirect()->back();

    // }

    // public function unlike($postId) {
    //     $post= Post::findOrFail($postId);

    //     $like=$post->likes()->where('user_id', auth()->id())->first();
    //     if(!$like) {
    //         return redirect()->back()->with('error', 'You did not liked this post.');
    //     }

    //     $like->delete();

    //     return redirect()->back();
    // }
}

<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Following;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
    protected $follower;
    protected $following;

    public function __construct()
    {
        $this->follower= new Follower;
        $this->following= new Following;
    }

    public function follow(Request $request) {
        $followerData=[
            'user_id'=> $request->id,
            'follower_id'=> auth()->id()
        ];
      
        $this->follower->addFollower($followerData);
        
        $followingData=[
            'user_id'=>auth()->id(),
            'followed_id'=> $request->id
        ];

        $this->following->addFollowing($followingData);

        return response()->json([
            'status'=> 'success',
        ]);

    //     $user= User::findOrFail($userId);

    //     if($user->followers()->where('follower_id', auth()->id())->exists()) {
    //         return redirect()->back()-> with('error', 'You are already following this user.');
    //     }

    //     $follower= new Follower();
    //     $follower->user_id=$userId;
    //     $follower->follower_id=auth()->id();
    //     $follower->save();

    //     $following = new Following();
    //     $following->user_id = auth()->id();
    //     $following->followed_id = $userId;
    //     $following->save();

    //     return redirect()->back()->with('success', 'following ');
     }

    public function unfollow(Request $request)
    {
        $followerData= [
            'user_id'=> $request->id,
            'follower_id'=> auth()->id()
        ];

        $this->follower->deleteFollower($request->id);



        $followingData= [
            'user_id'=> auth()->id(),
            'followed_id'=> $request->id
        ];
        
        $this->following->deleteFollowing($request->id);

        return response()->json([
            'status'=> 'success'
        ]);


    //     $user = User::findOrFail($userId);

    //     $follower = $user->followers()->where('follower_id', auth()->id())->first();
    //     if (!$follower) {
    //         return redirect()->back()->with('error', 'You are not following this user.');
    //     }

    //     $follower->delete();

    //     $following = auth()->user()->followings()->where('followed_id', $userId)->first();
    //     if (!$following) {
    //     return redirect()->back()->with('error', 'You are not following this user.');
    // }

    //     $following->delete();

    //     return redirect()->back()->with('success', 'unfollowed');
    }
}

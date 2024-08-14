<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    //
    public function show ($userId) {
        $user= User::findOrFail($userId);
        
        $following=$user->followings()->orderBy('id','desc')->get();

        return view('feed.followings',compact('following'));
    }
}

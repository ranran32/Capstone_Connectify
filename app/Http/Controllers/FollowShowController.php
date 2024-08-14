<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowShowController extends Controller
{
    //

    public function follower($userId) {
        $user= User::findOrFail($userId);

        $follower= $user->followers()->get();
        return view('follow.followers', compact('follower'));
    }

    public function following($userId) {
        $user= User::findOrFail($userId);

        $following=$user->followings()->get();
        return view('follow.followings', compact('following'));
    }
}

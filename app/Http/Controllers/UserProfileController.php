<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    //

  public function showProfile($userId) {
    $user= User::findOrFail($userId);
    $post= Post::where('user_id', $userId)-> orderBy('id','desc')->get();
    return view('user.profile', compact('user', 'post'));
  }

  public function create() {
    $user= auth()-> user();
    return view ('user.profileForm', compact('user'));
  }

  public function store(Request $request){
    $user = Auth::user();

    $request->validate([
      'age' => 'required|integer|min:0',
      'address' => 'required|string|max:255',
      'phone_number' => 'required|string|max:20',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
  ]);

    $userProfile = $user->userProfile()->updateOrCreate(
        [],
        [
            'age' => $request->age,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]
    );
  
  if ($request->hasFile('image')) {
    $imagePath = $request->file('image')->store('images/profile');
    $fileName = basename($imagePath);
    $imageUrl = '/storage/app/images/profile/' . $fileName;
    
    $userProfile->image = $imageUrl;
    $userProfile->save();
}

   

    return redirect('profile/' . auth()->id())->with('message', 'Added profile details successfully');
}



}

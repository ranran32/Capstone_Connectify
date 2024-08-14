<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function show() {
        $users= User::all();
        
        return view('search.show', compact('users'));
    }

    public function userSearch(Request $request) {

        $userNameSearch = $request->search_key;

        $users = User::where("name", "LIKE", "%$userNameSearch%")->get();
    
     
        $html = '';
    
        foreach ($users as $user) {
            $html .= '<div class="row justify-content-center">';
            $html .= '<div class="col-md-5 mb-4">';
            $html .= '<div class="card" style="width: 30rem; height:5rem">';
            $html .= '<div class="card-body d-flex justify-content-between ">'; 
            $html .= '<div>';
            $html .= '<a href="' . url('profile/'.$user->id) . '" style="text-decoration: none; color: black;">';
            $html .= '<h5 class="text-capitalize " >';
            if ($user->userProfile && $user->userProfile->image) {
                $html .= '<img src="' . asset($user->userProfile->image) . '" class="card-img-top img-thumbnail" style="border-radius: 50%; height: 50px; object-fit: cover; width: 50px" alt="User Image">';
            } else {
                $html .= '<img src="' . asset('storage/images/default/default_pic.jpg') . '" class="card-img-top img-thumbnail" style="border-radius: 50%; height: 50px; object-fit: cover; width: 50px" alt="Default Image">';
            }
            $html .= $user->name;
            $html .= '</h5>';
            $html .= '</a>';
            $html .= '</div>'; 
            $html .= '<div>';
            if (auth()->check() && auth()->user()->id !== $user->id) {
                if (auth()->user()->followings()->where('followed_id', $user->id)->exists()) {
                    $html .= '<button type="submit" class="unfollowBtn btn border-danger btn-sm" data-id="' .$user->id . '">Unfollow</button>';
                } else {
                    $html .= '<button type="submit" class="followBtn btn border-primary btn-sm" data-id="' .$user->id . '">Follow</button>';
                }
            }
            $html .= '</div>'; 
            $html .= '</div>';
            $html .= '</div>'; 
            $html .= '</div>'; 
            $html .= '</div>'; 
            

        }
    
        return response()->json($html);
    }
    

}

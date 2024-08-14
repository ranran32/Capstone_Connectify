<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\FollowShowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route:: get('profile/create',[UserProfileController::class, 'create']);
Route:: post('profile', [UserProfileController::class, 'store']);
Route:: get('profile/{userId}',[UserProfileController::class, 'showProfile']);


Route::get('post/create',[PostController::class, 'create']);
Route::post('post/store',[PostController::class, 'store']);
Route::get('post/update/{id}',[PostController::class, 'getEdit']);
Route::post('post/save/{id}',[PostController::class, 'update']);
Route::post('post/delete/{id}',[PostController::class,'delete']);


Route::get('comment/{id}',[CommentController::class, 'show']);
Route::post('comment',[CommentController::class, 'store']);

Route::post('follow',[FollowController::class, 'follow'])->name('followUser');
Route::delete('unfollow', [FollowController::class, 'unfollow'])->name('unfollowUser');
Route::get('followers/{id}',[FollowShowController::class, 'follower']);
Route::get('followings/{id}',[FollowShowController::class, 'following']);


//feed
Route::get('myFollowing/{id}',[FollowingController::class, 'show']);


//search

Route::get('search',[SearchController::class, 'show']);
Route::post('user-search',[SearchController::class, 'userSearch']);

//like
Route::post('like', [LikeController::class, 'like'])->name('likePost');
Route::delete('unlike',[LikeController::class, 'unlike'])->name('unlikePost');
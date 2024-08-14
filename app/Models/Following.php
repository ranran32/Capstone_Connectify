<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;

    protected $table = 'followings';

    protected $fillable= [
        'user_id','followed_id',
    ];

    public function addFollowing($data){
        $this->create($data);
    }
    public function deleteFollowing($id){
        $user= $this->where('user_id', auth()->id())->where('followed_id', $id);
        $user->delete();
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function followed() {
        return $this->belongsTo(User::class, 'followed_id');
    }
}

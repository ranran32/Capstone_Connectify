<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $table= 'follower';

    protected $fillable= [
        'user_id', 'follower_id',
    ];
    public function addFollower($data){
        $this->create($data);
    }
    public function deleteFollower($id){
        $user= $this->where('user_id', $id)->where('follower_id', auth()->id());
        $user->delete();
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function follower() {
        return $this->belongsTo(User::class, 'follower_id');
    }
    
}

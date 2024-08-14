<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table= 'likes';

    protected $fillable= [
        'user_id', 'post_id',
    ];

    public function likePost($data){
       $this->create($data);
    }
    public function deletePost($id){
      $like= $this-> where('post_id', $id)
                    ->where('user_id', auth()->id())
                    ->first();
        $like->delete();
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }


}

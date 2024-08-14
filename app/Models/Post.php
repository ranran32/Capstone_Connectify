<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $table= 'posts';

    protected $fillable= [
        'content',
        'image',

    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments () :HasMany {
        return $this-> hasMany(Comment::class, 'post_id', 'id');
    }

    public function likes() : HasMany {
        return $this ->hasMany(Like::class, 'post_id', 'id');
        
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userProfile():HasOne {
        return $this-> hasOne(UserProfile::class,'user_id','id' );
    }
    
    public function post() : HasMany {
        return $this-> hasMany(Post::class, 'user_id', 'id');
    }

    public function comments () :HasMany {
        return $this-> hasMany(Comment::class, 'user_id', 'id');
    }

    public function followers() : HasMany {
        return $this-> hasMany(Follower::class, 'user_id', 'id');
    }

    public function followings(): HasMany
    {
        return $this->hasMany(Following::class, 'user_id', 'id');
    }
    
    public function likes() : HasMany {
        return $this->hasMany(Like::class, 'user_id', 'id');
        
    }
}

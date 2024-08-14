<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table= 'user_profiles';

    protected $fillable= [
        'age',
        'address',
        'phone_number',
        'image'
    ];

    public function user() {
        return $this-> belongsTo(User::class, 'user_id', 'id');
    }
}

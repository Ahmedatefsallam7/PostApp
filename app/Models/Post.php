<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['content', 'user_id'];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    function likes()
    {
        return $this->hasMany(Like::class);
    }

    function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    function OwnedBy(User $user)
    {
        return $user->id === $this->user_id;
    }
}
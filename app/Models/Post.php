<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'image',
    ];

    /**
     * Relationship: A post belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: A post can have many comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relationship: A post can have many likes.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }



    public function getImageUrl()
    {
        return asset('storage/images/' . $this->image);
    }
}

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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commets(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function getImageUrl(){
        if ($this->image) {
            return asset('storage/images/' . $this->image);
        }
        return null;
    }
}

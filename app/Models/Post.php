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
        'likes'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(PostComment::class)->latest();
    }

    public function reviews() {
        return $this->hasMany(PostReview::class);
    }

    public function user_likes() {
        return $this->belongsToMany(User::class);
    }
}

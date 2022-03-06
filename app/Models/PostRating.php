<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_review_id',
        'rating'
    ];

    public function review() {
        return $this->belongsTo(PostReview::class);
    }
}

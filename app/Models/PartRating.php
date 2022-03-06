<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_review_id',
        'rating'
    ];

    public function review() {
        return $this->belongsTo(PartReview::class);
    }
}

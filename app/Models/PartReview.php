<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'user_id',
        'text'
    ];

    public function part() {
        return $this->belongsTo(Part::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rating() {
        return $this->hasOne(PartRating::class);
    }
}

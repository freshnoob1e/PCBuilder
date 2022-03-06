<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartSpec extends Model
{
    use HasFactory;

    protected $fillable = [
        'part_id',
        'properties'
    ];

    public function part() {
        return $this->belongsTo(Part::class);
    }
}

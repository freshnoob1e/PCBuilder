<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function parts() {
        return $this->hasMany(Part::class);
    }

    public function specs() {
        return $this->hasMany(CategorySpec::class);
    }
}

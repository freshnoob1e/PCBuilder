<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySpec extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'datatype',
        'measurement',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

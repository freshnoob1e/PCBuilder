<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatroom extends Model
{
    use HasFactory;

    public function users() {
        return $this->hasMany(User::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
}

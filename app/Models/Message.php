<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chatroom_id',
        'text'
    ];

    public function chatroom() {
        return $this->belongsTo(Chatroom::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

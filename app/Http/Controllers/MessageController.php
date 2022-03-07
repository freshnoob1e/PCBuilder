<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $req){
        $data = $req->validate([
            'user_id' => ['required', 'exists:users,id'],
            'chatroom_id' => ['required', 'exists:chatrooms,id'],
            'text' => ['required', 'string']
        ]);

        Message::create($data);
    }
}

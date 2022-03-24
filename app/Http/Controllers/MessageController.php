<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $req){

        // $user = Auth::user();
        // $isMember = false;
        // foreach($chatroom->users as $roomUser){
        //     if($roomUser->id == $user->id){
        //         $isMember = true;
        //         break;
        //     }
        // }
        // if(!$isMember){
        //     abort(401);
        // }
        // $req->validate([
        //     'text' => ['required', 'string', 'max:2500']
        // ]);

        // Message::create([
        //     'user_id' => $user->id,
        //     'chatroom_id' => $chatroom->id,
        //     'text' => $req->text
        // ]);
        // return redirect()->route('chat-show', $chatroom->id);
    }
}

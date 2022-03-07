<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatroomController extends Controller
{
    public function index(){
        $chatrooms = Chatroom::latest()->with('users')->get();
        return view('chatrooms.index', ['chatrooms' => $chatrooms]);
    }

    public function show(Chatroom $chatroom){
        return view('chatrooms.show', [
            'chatroom' => $chatroom->load(['users', 'messages'])
        ]);
    }

    public function store(Request $req){
        $user1 = Auth::user()->id;
        $req->validate([
            'user_id' => ['required', 'exists:users,id']
        ]);
        $user2 = $req->user_id;

        $chatroom = Chatroom::create();
        $chatroom->users()->toggle([$user1, $user2]);
        return redirect()->route('chatrooms-show', $chatroom->id);
    }

    public function destroy(Chatroom $chatroom){
        $chatroom->delete();

    }
}

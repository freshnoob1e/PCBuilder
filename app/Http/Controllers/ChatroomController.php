<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatroomController extends Controller
{
    public function index(){
        $chatrooms = Auth::user()->chatrooms;
        return view('chatrooms.index', ['chatrooms' => $chatrooms->load(['users', 'messages.user'])]);
    }

    public function startChat(User $user){
        $authUser = Auth::user();
        // Check if already has chatroom
        $existingRooms = $authUser->chatrooms->load('users');
        foreach($existingRooms as $existingRoom){
            foreach($existingRoom->users as $otherUser){
                if($otherUser->id == $user->id){
                    return redirect()->route('chat-show', $existingRoom->id);
                }
            }
        }
        // Else create new chatroom with user
        $newChatroom = Chatroom::create();
        $newChatroom->users()->attach([$user->id, $authUser->id]);
        return redirect()->route('chat-show', $newChatroom->id);
    }

    public function show(Chatroom $chatroom){
        $authUser = Auth::user();
        $chatroom = $chatroom->load(['users', 'messages.user']);
        $isMember = false;
        foreach($chatroom->users as $user){
            if($user->id == $authUser->id){
                $isMember = true;
                break;
            }
        }
        if(!$isMember){
            abort(401);
        }
        return view('chatrooms.show', [
            'chatroom' => $chatroom
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

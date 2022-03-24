<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class ChatroomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $chatroomsJson = Http::get(env('CHAT_APP_URL') . 'chatroom/all/' . $user->id)->body();
        $chatrooms = json_decode($chatroomsJson, true);
        for ($x = 0; $x < count($chatrooms); $x++) {
            $time_ago = Carbon::createFromFormat('m/d/Y G:i:s', date('m/d/Y G:i:s', strtotime($chatrooms[$x]['messages'][0]['date_created'])))->diffForHumans();
            $chatrooms[$x]['messages'][0]['time_ago'] = $time_ago;
        }
        return view('chatrooms.index', ['chatrooms' => $chatrooms]);
    }

    public function startChat(User $user)
    {
        $authUser = Auth::user();
        $chatroomDtoArr = [
            'uid_main' => strval($authUser->id),
            'name_main' => strval($authUser->name),
            'uid_target' => strval($user->id),
            'name_target' => strval($user->name),
        ];
        $chatroomDtoXml = new SimpleXMLElement('<chatroom/>');
        arrayToXml($chatroomDtoArr, $chatroomDtoXml);

        $chatroom = Http::post(env('CHAT_APP_URL') . 'chatroom', ['body' => $chatroomDtoXml])->body();

        return redirect()->route('chat-show', $user->id);
    }

    public function show(User $user)
    {
        $authUser = Auth::user();
        $chatroom = Http::get(env('CHAT_APP_URL') . 'chatroom/' . $authUser->id . '/' . $user->id)->body();
        $decodedChatroom = json_decode($chatroom, true);
        if (array_key_exists('messages', $decodedChatroom)) {
            for ($i = 0; $i < count($decodedChatroom['messages']); $i++) {
                $time_ago = Carbon::createFromFormat('m/d/Y G:i:s', date('m/d/Y G:i:s', strtotime($decodedChatroom['messages'][$i]['date_created'])))->diffForHumans();
                $decodedChatroom['messages'][$i]['time_ago'] = $time_ago;
            }
        }

        return view('chatrooms.show', [
            'chatroom' => $decodedChatroom,
        ]);
    }

    // public function store(Request $req){
    //     $user1 = Auth::user()->id;
    //     $req->validate([
    //         'user_id' => ['required', 'exists:users,id']
    //     ]);
    //     $user2 = $req->user_id;

    //     $chatroom = Chatroom::create();
    //     $chatroom->users()->toggle([$user1, $user2]);
    //     return redirect()->route('chatrooms-show', $chatroom->id);
    // }

    // public function destroy(Chatroom $chatroom){
    //     $chatroom->delete();
    // }
}

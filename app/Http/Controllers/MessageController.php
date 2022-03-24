<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class MessageController extends Controller
{
    public function store(Request $req, $sender_id, $target_id)
    {
        $req->validate([
            'text' => ['required', 'string', 'max:2500'],
        ]);
        $messageDtoArr = [
            'text' => $req->text,
        ];
        $messageDtoXml = new SimpleXMLElement('<message/>');
        arrayToXml($messageDtoArr, $messageDtoXml);

        $resposne = Http::post(env('CHAT_APP_URL') . 'message/' . $sender_id . '/' . $target_id, ['body' => $messageDtoXml])->body();

        return redirect()->route('chat-show', $target_id);
    }
}

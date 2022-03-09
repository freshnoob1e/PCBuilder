<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(Post $post, Request $req){
        $req->validate([
            'text' => ['required', 'string']
        ]);
        $user_id = auth()->user()->id;
        $post_id = $post->id;

        PostComment::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'text' => $req->text
        ]);

        return redirect()->route('post', $post_id);
    }

    public function destroy(Post $post, $comment){
        $post = $post->load('user');
        $user = auth()->user();
        if(!$user->isAdmin && !$user->isMod){
            if($user->id != $post->user->id){
                abort(401);
            }
        }
        $post->comments()->find($comment)->delete();
        return redirect()->route('post', $post->id);
    }
}

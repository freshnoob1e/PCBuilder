<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->with(['user'])->get();
        return view('forum', [
            'posts' => $posts
        ]);
    }

    public function store(Request $req){
        $req->validate([
            'content' => ['required', 'string']
        ]);
        $user_id = auth()->user()->id;
        Post::create([
            'user_id' => $user_id,
            'content' => $req->content,
            'likes' => 0
        ]);
        return redirect()->route('forum');
    }

    public function show(Post $post){
        $post = $post->load(['user', 'comments', 'reviews.rating']);

        // foreach ($post->comments as $comment) {
        //     $comment->timeDiff = $comment->created_at->diffForHumans()
        // }
        return view('posts.show', [
            'post' => $post
        ]);
    }
}

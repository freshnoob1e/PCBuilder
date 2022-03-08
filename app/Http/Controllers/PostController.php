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

    public function edit(Post $post){
        $post = $post->load('user');
        if(auth()->user()->id != $post->user->id){
            abort(401);
        }
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post, Request $req){
        $post = $post->load('user');
        if(auth()->user()->id != $post->user->id){
            abort(401);
        }
        $req->validate([
            'content' => ['required', 'string']
        ]);
        $post->update([
            'content' => $req->content
        ]);
        return redirect()->route('post', $post->id);
    }

    public function show(Post $post){
        $post = $post->load(['user', 'comments', 'reviews.rating']);
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function destroy(Post $post){
        $post = $post->load('user');
        if(auth()->user()->id != $post->user->id){
            abort(401);
        }
        $post->delete();
        return redirect()->route('forum');
    }
}

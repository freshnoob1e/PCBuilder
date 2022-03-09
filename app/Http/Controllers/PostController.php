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
        $post = $post->load(['user', 'comments.user', 'reviews.rating']);
        $user = auth()->user();
        $isPostOwner = false;
        if($user->id == $post->id){
            $isPostOwner = true;
        }
        $roles = $user->roles;
        $isAdmin = false;
        $isMod = false;
        foreach($roles as $role){
            if($role->name == 'Admin'){
                $isAdmin = true;
            } else if($role->name == 'Mod'){
                $isMod = true;
            }
        }
        return view('posts.show', [
            'post' => $post,
            'isPostOwner' => $isPostOwner,
            'isAdmin' => $isAdmin,
            'isMod' => $isMod
        ]);
    }

    public function destroy(Post $post){
        $post = $post->load('user');
        $user = auth()->user();
        if(!$user->isAdmin && !$user->isMod){
            if($user->id != $post->user->id){
                abort(401);
            }
        }
        $post->delete();
        return redirect()->route('forum');
    }
}

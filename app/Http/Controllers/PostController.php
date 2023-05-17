<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    function index()
    {
        $posts = Post::get();
        return view('posts.index', compact('posts'));
    }

    function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $request->user()->posts()->create([
            'content' => $request->content,
        ]);

        // Post::create([
        //     'content'=>$request->content,
        //     'user_id'=>auth()->id(),
        // ]);

        session()->flash('add', 'New Post Added !');
        return back();
    }

    function show(Post $post)
    {
        $mPost = $post;
        return view('posts.show', compact('mPost'));
    }
    function delete(Post $post)
    {
        $post->delete();
        $post->likes()->where('post_id', $post->id)->delete();
        session()->flash('del', 'Post Deleted !!');
        return back();
    }

    function postLike(Post $post)
    {
        $post->likes()->create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);
        // Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        return back();
    }
    function postUNLike(Post $post)
    {
        $post->likes()->delete();
        return back();
    }
}
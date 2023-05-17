<?php

namespace App\Http\Livewire;

use App\Mail\PostLiked;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;

/**
 * Summary of Counter
 */
class Counter extends Component
{
    use WithPagination;


    function store(Request $request, Post $post)
    {
        if ($post->likedBy($request->user())) {
            return response(null, 409);
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);
        // Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        return redirect()->back();
    }
    function destroy(Request $request, Post $post)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }

    function delete(Post $post)
    {
        // $this->authorize('deletePost', $post);
        if (auth()->user()->can('deletePost', $post)) {
            $post->delete();
            session()->flash('delete', 'Post Deleted !!');
            return back();
        } else {
            return abort(401);
        }
    }

    public function render()
    {
        $posts = Post::with(['user', 'likes'])->latest()->paginate(4);
        return view('livewire.counter', compact('posts'));
    }
}

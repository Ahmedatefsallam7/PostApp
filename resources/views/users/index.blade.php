@extends('main_page')

@section('title', 'User posts')

@section('content')

    @if (session('del'))
        <div style="font-size: 25px;width:100%; border-radius:5px;color: rgba(239, 14, 70, 0.958)">
            {{ session()->get('delete') }}
        </div>
    @endif

    <div style="background-color: white;width: 70%;margin-left:220px;margin-top:-17px;border-radius: 10px">
        <div style="margin: 20px; padding: 20px;">
            <strong style="font-size: 40px"> {{ $user->name }} </strong>
            <p style="font-size: 25px">
                Posted {{ count($user->posts) }} {{ Str::plural('post', count($user->posts)) }}
                and Recived {{ count($user->receivedLikes) }} {{ Str::plural('like', count($user->receivedLikes)) }}
            </p>



        </div>
    </div>

    @if (count($posts))
        <div style="background-color: white;width: 70%;margin-left:220px;margin-top:-17px;border-radius: 10px">
            <div style="margin: 20px; padding: 20px">
                @foreach ($posts as $post)
                    <a style="text-decoration-line: none;color: black" href="">
                        <strong> {{ $post->user->name }}</strong>
                    </a>
                    <span style="margin-left:15px ">date : {{ $post->created_at->diffForHumans() }}</span>
                    <p>{{ $post->content }}</p>

                    @auth
                        @can('deletePost', $post)
                            <form style="display: inline-block" action="{{ route('postDel', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button
                                    style="cursor: pointer;display: inline-block;background-color: blue;border:none;border-radius:7px ;color: white "
                                    type="submit">Delete</button>
                            </form>
                        @endcan
                        @if (!$post->likedBy(auth()->user()))
                            <form style="display: inline-block" method="post" action="{{ route('mLike', $post->id) }}">
                                @csrf
                                <button
                                    style="cursor: pointer;display: inline-block;background-color: blue;border:none;border-radius:7px ;color: white "
                                    type="submit">Like</button>
                            </form>
                        @else
                            <form style="display: inline-block" method="post" action="{{ route('unLike', $post->id) }}">
                                @csrf
                                <button
                                    style="cursor: pointer;display: inline-block;background-color: blue;border:none;border-radius:7px ;color: white "
                                    type="submit">UnLike</button>
                            </form>
                        @endif

                    @endauth
                    <span>{{ count($post->likes) }} {{ Str::plural('like', count($post->likes)) }}</span>
                    <hr>
                @endforeach
            </div>
            {{ $posts->links() }}
        </div>
    @else
        <div
            style="background-color: white;width: 70%;height: 50px;;margin-left:220px;margin-top:-17px;border-radius: 10px">
            <div style="margin: 20px; padding: 20px;height: 25px;">
                <h2 style="color: red;margin-left:40%;margin-top:-10px ">There's No Posts For This User</h2>
            </div>
        </div>
    @endif

@endsection

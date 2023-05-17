@extends('main_page')

@section('title', 'post')

@section('content')

    <div style="background-color: white;width: 70%;margin-left:220px;margin-top:50px;border-radius: 10px">
        <div style="padding: 40px">
            @if ($mPost->id)
                <strong>{{ $mPost->user->name }}</strong>
                <span style="margin-left: 17px"> date: {{ $mPost->created_at->diffForHumans() }}</span>
                <p>{{ $mPost->content }}</p>
                @auth
                    @can('deletePost', $mPost)
                        <form style="display: inline-block" action="{{ route('postDel', $mPost->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button
                                style="cursor: pointer;display: inline-block;background-color: blue;border:none;border-radius:7px ;color: white "
                                type="submit">Delete</button>
                        </form>
                    @endcan
                    @if (!$mPost->likedBy(auth()->user()))
                        <form style="display: inline-block" method="post" action="{{ route('mLike', $mPost->id) }}">
                            @csrf
                            <button
                                style="cursor: pointer;display: inline-block;background-color: blue;border:none;border-radius:7px ;color: white "
                                type="submit">Like</button>
                        </form>
                    @else
                        <form style="display: inline-block" method="post" action="{{ route('unLike', $mPost->id) }}">
                            @csrf
                            <button
                                style="cursor: pointer;display: inline-block;background-color: blue;border:none;border-radius:7px ;color: white "
                                type="submit">UnLike</button>
                        </form>
                    @endif

                @endauth
                <span>{{ count($mPost->likes) }} {{ Str::plural('like', count($mPost->likes)) }}</span>
            @else
                <div
                    style="background-color: white;width: 70%;height: 50px;;margin-left:220px;margin-top:-17px;border-radius: 10px">
                    <div style="margin: 20px; padding: 20px;height: 25px;">
                        <h2 style="color: red;margin-left:40%;margin-top:-10px ">There's No Posts Here</h2>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

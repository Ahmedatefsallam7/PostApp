<div wire:poll>
    @auth
        <div style="background-color: white;width: 70%;margin-left:220px;margin-top:-10px;border-radius: 10px">
            <div style="margin: 20px; padding: 20px">
                @if (session('add'))
                    <div style="font-size: 25px;width:100%; border-radius:5px;color: rgba(18, 239, 14, 0.958)">
                        {{ session()->get('add') }}
                    </div>
                @endif
                @if (session('delete'))
                    <div style="font-size: 25px;width:100%; border-radius:5px;color: rgba(239, 14, 70, 0.958)">
                        {{ session()->get('delete') }}
                    </div>
                @endif

                <form action="{{ route('storePost') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <textarea style="background-color: rgb(233, 239, 249);border-radius:8px; padding: 6px;" autofocus name="content"
                            id="content" cols="130" rows="10" class="bg-gray-100" placeholder="Post Something!"></textarea>
                        @error('content')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        <button type="submit"
                            style="cursor: pointer;margin: 10px ;width: 70px;height: 40px;font-size: 130%;border: none; border-radius:7px;color: white;background-color: rgb(18, 18, 238)">Post</button>
                    </div>
                </form>

            </div>
        </div>
    @endauth
    @if (count($posts))
        <div style="background-color: white;width: 70%;margin-left:220px;margin-top:-17px;border-radius: 10px">
            <div style="margin: 20px; padding: 20px">
                @foreach ($posts as $post)
                    <a style="text-decoration-line: none;color: black" href="{{ route('userInfo', $post->user) }}">
                        <strong> {{ $post->user->name }}</strong>
                    </a>
                    <span style="margin-left:15px ">date : {{ $post->created_at->diffForHumans() }}</span>
                    <p>{{ $post->content }}</p>

                    @auth
                        @can('deletePost', $post)
                            <form style="display: inline-block" wire:submit.prevent="delete({{ $post->id }})">
                                @csrf
                                <button onclick="window.scrollTo(0,0)"
                                    style="cursor: pointer;display: inline-block;background-color: blue;border:none;border-radius:7px ;color: white "
                                    type="submit">Delete</button>
                            </form>
                        @endcan
                        @if (!$post->likedBy(auth()->user()))
                            <form style="display: inline-block" wire:submit.prevent="store({{ $post->id }})">
                                @csrf
                                <button
                                    style="cursor: pointer;display: inline-block;background-color: blue;border:none;border-radius:7px ;color: white "
                                    type="submit">Like</button>
                            </form>
                        @else
                            <form style="display: inline-block" wire:submit.prevent="destroy({{ $post->id }})">
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
                <h2 style="color: red;margin-left:40%;margin-top:-10px ">There's No Posts Here</h2>
            </div>
        </div>
    @endif

</div>

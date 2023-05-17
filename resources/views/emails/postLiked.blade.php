<x-mail::message>
# Your Post Was Liked

<strong>{{ $liker->name }}</strong> Liked One Of Your Posts

<x-mail::button :url="route('post.show',$post)">
Show Post
</x-mail::button>

Thanks For Choosing,<br>
{{ config('app.name') }}
</x-mail::message>

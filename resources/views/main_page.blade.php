<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post App | @yield('title', 'Unknown Title')</title>
    @livewireStyles
</head>

<body style="background-color: rgb(232, 238, 253)">
    <div style="margin-left: -90px;margin-top:-33px">
        <nav style="background-color: white ;margin-left:5%;margin-top:2%;height: 50px; padding: 10px"
            class="nav main-nav flex-column flex-md-row">
            <div class="col1" style="display: inline-block;margin-left:3%;margin-top:15px  ">
                <a style="font-size: 20px; margin-left: 10px ; color: #000; text-decoration-line: none" class="nav-link"
                    href="{{ route('dashboard') }}">Dashboard</a>
                <a style="font-size: 20px; margin-left: 10px ; color: #000; text-decoration-line: none" class="nav-link"
                    href="{{ route('posts') }}">Posts</a>

            </div>
            <div class="col2" style="display: inline-block;margin-left:60%">
                @auth
                    <p
                        style="display: inline;font-size: 20px; margin-left: 10px ; color:rgb(0, 255,0);text-decoration-line: none">
                        {{ auth()->user()->name }}
                    </p>
                    <a style="font-size: 20px; margin-left: 10px ; color: #000; text-decoration-line: none" class="nav-link"
                        href="{{ route('logout') }}">Logout</a>
                @endauth
                @guest
                    <a style="font-size: 20px; margin-left: 10px ; color: #000; text-decoration-line: none" class="nav-link"
                        href="{{ route('login') }}">Login</a>
                    <a style="font-size: 20px; margin-left: 10px ; color: #000; text-decoration-line: none" class="nav-link"
                        href="{{ route('register') }}">Register</a>
                @endguest
            </div>
        </nav>
    </div>

    @yield('content')

    @livewireScripts
</body>

</html>

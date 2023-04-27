<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- fontAewsome -->
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@600;700&family=Crimson+Text:ital,wght@0,400;0,600;1,700&family=Dancing+Script&family=DynaPuff:wght@400;500;600;700&family=Faustina&family=Mukta:wght@300&family=Pacifico&family=Signika+Negative:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/imagefeed') }}"style="font-family:Lucida Handwriting;font-weight:bold;">
                    Instagram
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav" style="margin-left:850px;">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                                <li class="nav-item">
                                    <a style="text-decoration:none;font-size:25px;font-family:Matura MT Script Capitals;"id="navbarDropdown" class="text-dark" href="/user/{{auth()->user()->id}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li class="nav-item" style="margin-left:50px;">
                                    <button class="btn btn-dark"><a style="text-decoration:none;color:white;font-family:Tempus Sans ITC;"href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                    </a></button>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <div class="sidebar_section">
            <div class="sidebar_content">
                <h1><a href="/imagefeed">Instagram</a></h1>
                <ul>
                    <li><i class="fa-solid fa-house"></i>Home</li>
                    <li><i class="fa-solid fa-magnifying-glass"></i>Search</li>
                    <li><i class="fa-regular fa-message"></i>Message</li>
                    <li><i class="fa-regular fa-heart"></i>Notification</li>
                    <li>Profile</li>
                    <li><i class="fa-solid fa-bars"></i>More</li>
                    @auth
                    <a href="{{ route('insta.logout') }}"><li><i class="fa-solid fa-bars"></i>Logout</li></a>
                    @else
                    <a href="{{ route('login') }}"><li><i class="fa-solid fa-bars"></i>Login</li></a>
                    @endauth
                </ul>
            </div>

        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src={{asset('js/jquery-1.12.4.min.js')}}></script>
    <script src={{asset('js/insta.js')}}></script>
</body>
</html>

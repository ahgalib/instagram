<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- for dynamic title --}}
    <title> @yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- fontAewsome -->
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Chivo+Mono:wght@600;700&family=Crimson+Text:ital,wght@0,400;0,600;1,700&family=Dancing+Script&family=DynaPuff:wght@400;500;600;700&family=Faustina&family=Mukta:wght@300&family=Pacifico&family=Signika+Negative:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
    <div id="app">
        <div class="sidebar_section">
            <div class="sidebar_content">
                <h1><a href="/">Instagram</a></h1>
                <ul>
                    <li><a href=""><i class="fa-solid fa-house"></i>Home</a></li>
                    @auth
                        @if(auth::user()->profile)
                            @if(auth::user()->profile->image)
                                <li><a href="/user/{{auth()->user()->id}}"><img src="{{asset('uploads/profile')}}/{{auth()->user()->profile->image}}" alt="" style="width:30px;height:30px;border-radius:50%;border:1px solid white;margin-right:10px;">Profile</a></li>
                            @else
                                <li><a href="/user/{{auth()->user()->id}}"><img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"alt="" style="width:30px;height:30px;border-radius:50%;border:1px solid white;margin-right:10px;">Profile</a></li>
                            @endif
                        @else
                            <li><a href="/profile/create"><img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"alt="" style="width:30px;height:30px;border-radius:50%;border:1px solid white;margin-right:10px;">Profile</a></li>
                        @endif
                    @else
                        <a href="{{ route('login') }}"><li><i class="fa-solid fa-bars"></i></li>Login</a>
                    @endauth

                    <li><a href=""><i class="fa-solid fa-magnifying-glass"></i>Search</a></li>
                    <li><a href=""><i class="fa-regular fa-message"></i>Message</a></li>
                    <li><a href=""><i class="fa-regular fa-heart"></i>Notification</a></li>
                    <li><i class="fa-solid fa-bars"></i>More</li>
                    @auth
                        <a href="{{ route('insta.logout') }}"><li><i class="fa-solid fa-bars"></i>Logout</li></a>
                    @else
                        <a href="{{ route('login') }}"><li><i class="fa-solid fa-bars"></i>Login</li></a>
                    @endauth
                </ul>
            </div>

        </div>

        <main class="py-0">
            @yield('content')
        </main>

        <div class="footer">
            <div class="footer_content">
                <ul>
                    <li><a href="/"><i class="fa-solid fa-house"></i></a></li>
                    <li><i class="fa-solid fa-magnifying-glass"></i></li>
                    @auth
                        @if(auth::user()->profile)
                            @if(auth::user()->profile->image)
                                <li><a href="/user/{{auth()->user()->id}}"><img src="{{asset('uploads/profile')}}/{{auth()->user()->profile->image}}" alt="" style="width:40px;height:40px;border-radius:50%;border:1px solid white;"></a></li>
                            @else
                                <li><a href="/user/{{auth()->user()->id}}"><img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"alt="" style="width:40px;height:40px;border-radius:50%;border:1px solid white;"></a></li>
                            @endif
                        @else
                            <li><a href="/profile/create"><img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"alt="" style="width:40px;height:40px;border-radius:50%;border:1px solid white;"></a></li>
                        @endif
                    @endauth
                    <li><i class="fa-solid fa-bars"></i></li>
                    @auth
                    <a href="{{ route('insta.logout') }}"><li>logout</li></a>
                    @else
                    <a href="{{ route('login') }}"><li><i class="fa-solid fa-bars"></i></li></a>
                    @endauth
                </ul>
            </div>
        </div>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src={{asset('js/jquery-1.12.4.min.js')}}></script>
     <script src={{asset('js/insta.js')}}></script>
</body>
</html>

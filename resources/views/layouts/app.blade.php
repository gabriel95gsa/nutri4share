<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'nutri4share') }}</title>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images\nutriforshare_newLogo_blank.png') }}"/>

    <!-- Styles -->
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-theme.css') }}">--}}
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-theme.min.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app/timeline.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
</head>
<body>
    <div class="post-content-midia-container">
        <div class="post-content-midia-close-area"></div>
        <div class="post-content-midia-galery">
            <div class="post-content-midia-close">
                <button type="button" class="post-content-midia-close-btn">
                    <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                </button>
            </div>
            <img class="post-content-midia-img" src="">
        </div>
    </div>

    <div class="app-main-header">
        <div class="navbar-app-main">
            <div class="navbar-app-main-left">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-main-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img id="nutri4share_logo" src="{{ asset('images\nutriforshare_newLogo_blank.png') }}">
                </a>
            </div>
            
            <div class="collapse navbar-collapse" id="top-navbar-main-collapse">
                <ul class="nav navbar-nav navbar-right navbar-fields">
                    <li>
                        <a href="/profile/{{ Auth::user()->username }}">
                            {{ Auth::user()->name }}
                            <img class="img-profile-main-navbar" src="{{ asset('images\eu.jpg') }}">
                        </a>
                    </li>
                    <li>
                        <a href="/">
                            <i class="fa fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/">
                            <i class="fa fa-envelope-o"></i>
                        </a>
                    </li>
                    <li>
                        <a href="/">
                            <i class="fa fa-exclamation"></i>
                        </a>
                    </li>
                    <li class="dropdown top-menu-main">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    Edit Profile
                                </a>
                            </li>
                            <li>
                                <a href="/posts/create">
                                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                                    Create Post
                                </a>
                            </li>
                            <li>
                                <a href="/posts">
                                    <i class="fa fa-globe" aria-hidden="true"></i>
                                    News Feed
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-cogs" aria-hidden="true"></i>
                                    Settings
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="app-main-body">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        var token = '{{ Session::token() }}';
        var us_id = '{{ Auth::user()->id }}';
    </script>
</body>
</html>
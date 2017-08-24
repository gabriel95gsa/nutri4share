<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is social network html5 template available in themeforest......" />
    <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'Nutri4Share') }}</title>
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images\nutriforshare_newLogo_blank.png') }}"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/ionicons/css/ionicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" />
    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
</head>
<body>
    <!-- Header ================================================= -->
    <div id="header-login-page">
        <div class="container">
            <a id="brand-logo" href="{{ url('/') }}"><img id="brand-logo" src="{{ 'images\nutriforshare_newLogo_blank.png' }}" alt="logo" /></a>
        </div>
    </div>
    <!--Header End-->
    
    <div id="lp-register">
        <div class="container wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-5">
                        <div class="intro-texts">
                            <h1 class="text-white">Welcome!!!</h1>
                            <p>Enjoy the opportunity to share your experiences and accomplishments in the fitness world. <br /> <br />What are you waiting for? Sign up now.</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-sm-offset-1">
                        <div class="reg-form-container">
                            <!-- Register/Login Tabs-->
                            <div class="reg-options">
                                <ul class="nav nav-tabs">
                                    <li><a href="{{ url('/register') }}">Sign up</a></li>
                                    <li class="active"><a href="{{ url('/login') }}">Login</a></li>
                                </ul><!--Tabs End-->
                            </div>
                            
                            <!-- Sign Up/Log In Form Contents -->
                            <div class="tab-content">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    
    <div class="container wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-4 info-content">
                    <i class="fa fa-comments fa-5x" aria-hidden="true"></i>
                    <p>Enjoy many experiences with your friends by talking about health, life quality and wellness.</p>
                </div>
                <div class="col-sm-4 info-content">
                    <i class="fa fa-users fa-5x" aria-hidden="true"></i>
                    <p>Discover a new world where other people are also sharing goals and concepts</p>
                </div>
                <div class="col-sm-4 info-content">
                    <i class="fa fa-picture-o fa-5x" aria-hidden="true"></i>
                    <p>Live the emotion of sharing and viewing experiences with other people</p>
                </div>
            </div>
        </div>
    </div>
    
    <div id="footer-login">
        <ul class="list-unstyled list-inline">
            <li><a href="#">About</a></li>
            <li><a href="#">Help/Contact</a></li>
            <li><a href="#">Developers</a></li>
            <li><a href="#">Terms of Use</a></li>
            <li><a href="#">Privacy Policy</a></li>
        </ul>
    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.appear.min.js') }}"></script>
</body>
</html>

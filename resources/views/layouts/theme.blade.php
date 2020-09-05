<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>POS</title>


    <!--- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!--- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin-top: 50px;
        }

        .full-height {
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }


        .m-b-md {
            margin-bottom: 30px;
        }
    </style>

    <!---new -->

    <!--<link rel="icon" href="{{ asset('images/favicons/favicon.icon') }}'">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('images/favicons/favicon-152.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('images/favicons/favicon-120.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/favicons/ favicon-72.png' )}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicons/favicon-57.png' )}}">-->
    <link href='https://fonts.googleapis.com/css?family=Libre+Baskerville:400,600|Poppins:400,500,700' rel='stylesheet'
          type='text/css'>

    <!--- ICON FONT -->
    <link rel="stylesheet" href="{{ asset('assets/icons/styles.css' )}}">

    <!--- Third Party CSS including Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/third-party.css' )}}">

    <!--- STYLESHEETS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css' )}}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">


    <!---new -->

</head>
<body>
<div id="app">
    <!--- NAVIGATION -->
    <nav class="navbar navbar-expand-md navbar-left bg-white shadow-sm ">
        <div class="  navbar-inverse bs-docs-nav navbar-fixed-top sticky-navigation" role="navigation">
            <div class="container">
                <div class="navbar-header">

                    <!--- NAVBAR EXPAND COLLAPSE ON MOBILE -->
                    <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#posNav">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon icon-menu"></span>
                    </button>

                    <!--- LOGO -->
                    <a class="navbar-brand" href="{{route('welcome')}}">
                        <img src="{{ asset('images/newLog.png') }}" width="50" height="50" alt="LOGO">
                    </a>

                </div>

                <div class="navbar-collapse collapse" id="posNav">
                    <!--- NAVIGATION LINK -->
                    <ul class="nav navbar-nav navbar-right main-navigation mr-auto " id="internal-scroll">
                        <li class="nav-item "><a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="nav-item"><a href="#section1">About</a>
                        </li>
                        <li class="nav-item"><a href="#section2">Services</a>
                        </li>
                        <li class="nav-item"><a href="#section4">Team</a>
                        </li>
                        <li class="nav-item"><a href="#section10">Contact</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('   Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    @endguest

                    <!--- <li><a href="http://example.com" class="external">External Link Example</a></li> -->
                    </ul>
                </div>

            </div>
            <!--- /END CONTAINER -->
        </div>

    </nav>
    <!--- /END NAIVATION -->

    <main class="py-4">
        <br/>
        <!-- =========================
        JS SCRIPTS
       ============================== -->
        <script src="{{ asset('js/jquery-1.11.3.min.js' )}}"></script>
        <script src="{{ asset('js/third-party-scripts.js' )}}"></script>
        <script src="{{ asset('js/custom.js' )}}"></script>
        <!-- =========================
         JS SCRIPTS
        ============================== -->
        @yield('content')
    </main>
</div>


</body>
</html>



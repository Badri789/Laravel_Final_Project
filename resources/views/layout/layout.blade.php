<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}" type="text/css">
    @section('title')
        <title>Layout</title>
    @show
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    @if(\Illuminate\Support\Facades\Auth::check())
        <a class="navbar-brand" href="{{route('user-quizzes.all')}}">
            <img src="{{asset("icons/logo.svg")}}" alt="Blog" width="60em">
        </a>
        <div>
            <img class="d-inline" src="{{asset("icons/user.svg")}}" alt=""
                 width="30em" style="margin: 0 auto">
            <h6 class="d-inline text-white">
                {{\Illuminate\Support\Facades\Auth::user()->name}}
            </h6>
        </div>
    @else
        <a class="navbar-brand" href="{{route('login')}}">
            <img src="{{asset("icons/logo.svg")}}" alt="Blog" width="60em">
        </a>
    @endif

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav ml-auto">
            @auth
                @if(\Illuminate\Support\Facades\Auth::user()->is_admin == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('quizzes.create')}}">
                        Create Quiz
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('quizzes.all')}}">
                        Manage Quizzes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('categories.create')}}">
                        Create Category
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('categories.all')}}">
                        Manage Categories
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user-quizzes.all')}}">
                        My Quizzes
                    </a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('results.all')}}">
                            Results
                        </a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        <img class="d-inline" src="{{asset("icons/logout.svg")}}" alt=""
                             width="20em">
                        Logout
                    </a>
                    <form id="logout-form" action="{{route('logout')}}" method="post">
                        {{csrf_field()}}
                    </form>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">
                        <img class="d-inline" src="{{asset("icons/login.svg")}}" alt=""
                             width="20em">
                        Login
                    </a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">
                            <img class="d-inline" src="{{asset("icons/register.svg")}}" alt=""
                                 width="20em">
                            Register
                        </a>
                    </li>
            @endguest
        </ul>
    </div>
</nav>
@yield('content')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>

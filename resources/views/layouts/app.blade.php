<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{--  <link href="{{ asset('css/app.css') }}" rel="stylesheet">  --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    {{--  @vite(['resources/sass/app.scss', 'resources/js/app.js'])  --}}

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        #sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        #content {
            margin-left: 250px;
            padding: 20px;
        }

        .sidebar-link {
            padding: 8px;
            text-decoration: none;
            color: #495057;
            display: block;
        }

        .sidebar-link:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <title>Bootstrap Sidebar</title>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Employees System') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="navbar-brand">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="navbar-brand" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <section class="content w-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-lg-2">
                    @auth
                        <div id="sidebar">
                            <a href="#" class="sidebar-link">Home</a>
                            <a href="{{ route('departments.index') }}" class="sidebar-link">Departments</a>
                            <a href="{{ route('employees.index') }}" class="sidebar-link">Employees</a>
                            {{--  @can('publish tasks')
                                <a href="{{ route('tasks.index') }}" class="sidebar-link">Tasks</a>
                            @endcan  --}}
                        </div>
                    @endauth
                    </div>
                </div>
                <div class="container mt-3">
                    @yield('content')
                </div>
            </div>
        </section>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/c0f4bce580.js" crossorigin="anonymous"></script>

<!-- JQuery Scripts --->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>

<!-- Toaster Scripts --->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/4.0.1/css/bootstrap-toaster.min.css" integrity="sha512-RLiJ5uLcu8jWxsJBevOZWLU0zWv51vwpha0Gh4jRKOqkcWbVR7+U8kKaiGsMhSua3fIkviCHRClSH+XZYKIoZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Sweetalert Scripts --->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        'rtl': false
    }
</html>

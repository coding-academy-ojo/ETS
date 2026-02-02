<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    <link rel="stylesheet" href="resources\css\main.css">

    <link href="https://fonts.googleapis.com/css?family=" rel="stylesheet">
    <!-- fontawosme link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/boosted.min.css" rel="stylesheet"
        integrity="sha384-laZ3JUZ5Ln2YqhfBvadDpNyBo7w5qmWaRnnXuRwNhJeTEFuSdGbzl4ZGHAEnTozR" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/js/boosted.bundle.min.js"
        integrity="sha384-3RoJImQ+Yz4jAyP6xW29kJhqJOE3rdjuu9wkNycjCuDnGAtC/crm79mLcwj1w2o/" crossorigin="anonymous">
    </script>

</head>

<body class="" >
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow ">
        <nav class="navbar navbar-expand-lg bg-dark container-fluid" data-bs-theme="dark" aria-label="Main navigation">
            <div class="container-fluid ms-2">
                <a class="navbar-brand me-auto me-lg-4" href="/">
                    <img src="https://boosted.orange.com/docs/5.3/assets/brand/orange-logo.svg" width="50" height="50"
                        alt="Boosted - Back to Home" loading="lazy">
                </a>

                <div id="bd-navbar1" class="navbar-collapse collapse me-lg-auto bd-navbar mb-0 border-0">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('employer.dashboard')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('employer.shortList')}}">
                                <i class="fa-regular fa-star text-primary"></i>
                                Candidate Shortlisted({{$numberOfTrainees}})
                            </a>
                        </li> </ul>
                </div>
            </div>



            <div class="div3 ">

                <ul class="navbar-nav ">
                    <div class="container">
                        <div class="ms-3">

                            @guest('employer')
                            @if (Route::has('login'))
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('empLogin') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::guard('employer')->user()->name}}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('employer.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    style="">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('employer.logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                        </div>
                    </div>
                </ul>
            </div>
            </div>
        </nav>
    </header>


    <main>
        @yield('content')
    </main>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybBogGzOg5U4lNY3pNj5svPf1L3eF5rM5zztV5UGWzUUeg+ge" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1jLDlgU4tOXF4p4" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>

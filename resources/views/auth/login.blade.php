<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>


    <!-- Fonts -->
      <link rel="preload" href="{{asset('/assets/fonts/HelveticaNeue-Medium.ttf')}}" as="font" type="font/ttf" crossorigin>
      <link rel="preload" href="{{asset('/assets/fonts/HelveticaNeue-Bold.ttf')}}" as="font" type="font/ttf" crossorigin>


    <!-- Styles -->
    <!-- Copyright © 2014 Monotype Imaging Inc. All rights reserved -->
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/orange-helvetica.min.css" rel="stylesheet" integrity="sha384-A0Qk1uKfS1i83/YuU13i2nx5pk79PkIfNFOVzTcjCMPGKIDj9Lqx9lJmV7cdBVQZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/boosted.min.css" rel="stylesheet" integrity="sha384-laZ3JUZ5Ln2YqhfBvadDpNyBo7w5qmWaRnnXuRwNhJeTEFuSdGbzl4ZGHAEnTozR" crossorigin="anonymous">

    {{--favicon--}}
    <link rel="icon" type="image/svg+xml" href="https://boosted.orange.com/docs/5.3/assets/brand/orange-logo.svg">
</head>
<style>
    body {
        background-color: #000;
        font-family: "HelveticaNeue-Bold","HelvNeue75_W1G",sans-serif !important;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-form {
        background-color: #fff;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.3);
        width:150%;
    }
    h2{
    font-weight: bolder;
    }
</style>
<body>
<div id="app">
    <main class="py-4">
        <div class="container" >
            <div class="row ">
                <div class="col-md-12">
                    <div class="login-form">
                        <h2 class="mb-4"><img class="ml-1" src="{{ asset('Orange.png') }}" alt="Orange" height="30" class="mr-2">Orange
                            Jordan</h2>
                        <h3 style="margin-">Identification</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror                        </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary btn-block"
                                        style="background-color: #000; color: white; font-weight: bold;">Log in
                                </button>
                            </div>
                        </form>
                        <div class="form-group">
                            <div>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                       style="color: #000; text-decoration: none; font-weight: bold; font-size: 12px;">
                                        {{ __('Forgot Your Password') }}
                                    </a>

                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/boosted.bundle.min.js') }}" defer></script>
</body>
</html>


{{-- OLD Login --}}

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}





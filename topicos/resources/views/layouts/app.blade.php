<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <nav id="navbar">
        <ul>
            <li class="left"><a class="active" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a></li>
            &nbsp; <li class="left"><a href="{{ route('admin.customers.index') }}">Clients</a></li>
                    
            @if (Auth::guest())
                <li class="right"><a href="{{ route('login') }}">Login</a></li>
                <li class="right"><a href="{{ route('register') }}">Register</a></li>
            @else
            <li class="right">
                <a href="#" class="drop">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <ul>
                    <li class="right">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </nav>
    <div id="app">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

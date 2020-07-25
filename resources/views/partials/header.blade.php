<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="icon" href="{{ asset('pizza.png') }}" type="img/png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/general.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
    </script>

    @yield('additional-scripts')

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
<div id="app">
    <nav>
        <div class="nav-wrapper z-depth-1">
            <a href="#" class="brand-logo center">Madplan</a>
            {{--<ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="sass.html">Sass</a></li>
                <li><a href="badges.html">Components</a></li>
                <li><a href="collapsible.html">JavaScript</a></li>
            </ul>--}}
        </div>
    </nav>
</div>

<main class="py-4">
    @yield('content')
</main>

</body>
</html>

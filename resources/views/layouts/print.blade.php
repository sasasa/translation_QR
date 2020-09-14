<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="@yield('description')">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?{{ str_random(8) }}" rel="stylesheet">
    <link href="{{ asset('css/print.css') }}?{{ str_random(8) }}" rel="stylesheet">
</head>
<body>
    <main id="app">
        @yield('content')
    </main>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?{{ str_random(8) }}" defer></script>
    @yield('script')
</body>
</html>

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
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/print.css') }}" rel="stylesheet">
</head>
<body>
    <main id="app">
        @yield('content')
    </main>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('script')
</body>
</html>

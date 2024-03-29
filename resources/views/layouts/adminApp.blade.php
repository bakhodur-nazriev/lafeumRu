<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="robots" content="noindex,nofollow"/>
    <meta name="robots" content="none"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Личный кабинет</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<v-app id="app">
    @yield('layout')
</v-app>

<script>
    window.Laravel = {!! json_encode([
        'csrf_token'   => csrf_token(),
        'asset_path'   => asset(''),
        'auth'         => Auth::user(),
        'avatars_path' => asset('img/avatars')
    ]); !!}
</script>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>

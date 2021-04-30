<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#04718c">

    <!--  Font  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700&display=swap"
        rel="stylesheet">

    <link rel="alternate" hreflang="ru" href="{{url('/')}}">
    <link rel="alternate" hreflang="x-default" href="{{url('/')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@yield('meta-tags', View::make('layouts.meta-tags'))

<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<v-app id="app">
    <front-navbar></front-navbar>
    <v-main class="grey lighten-3">
        <v-container>
            <v-row class="justify-center">
                @yield('layout')
            </v-row>
        </v-container>
    </v-main>
    <front-footer></front-footer>
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

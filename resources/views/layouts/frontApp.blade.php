<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#04718c">


    <link rel="alternate" hreflang="ru" href="{{url('/')}}">
    <link rel="alternate" hreflang="x-default" href="{{url('/')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

@yield('meta-tags', View::make('layouts.meta-tags'))

{{--    <link rel="icon" href="{{url("/img/cropped-favi-32x32.png")}}" sizes="32x32">--}}
{{--    <link rel="icon" href="{{url("/img/cropped-favi-192x192.png")}}" sizes="192x192">--}}
{{--    <link rel="apple-touch-icon-precomposed" href="{{url("/img/cropped-favi-180x180.png")}}">--}}
{{--    <meta name="msapplication-TileImage" content="{{url("/img/cropped-favi-270x270.png")}}">--}}


{{--<script src="{{ asset('js/helper.js') }}" defer></script>--}}

<!-- Font -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<v-app id="app">
    <v-main class="grey lighten-3">
        <v-container>
            <v-row>
                @yield('layout')
            </v-row>
        </v-container>
    </v-main>
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

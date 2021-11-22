<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#04718c">

    <!--  Font  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link rel="alternate" hreflang="ru" href="{{url('/')}}">
    <link rel="alternate" hreflang="x-default" href="{{url('/')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta-tags', View::make('layouts.meta-tags'))

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script
            src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit"
            async
            defer
    ></script>
</head>
<body>

<v-app id="app" class="overflow-hidden">
    <front-navbar></front-navbar>
    <v-main class="grey lighten-3 py-0">
        <v-container>
            <v-row justify="center">
                @yield('layout')
            </v-row>
        </v-container>
    </v-main>
    <front-footer></front-footer>

    <scroller-component></scroller-component>
</v-app>


<script>
    window.Laravel = {!!
        json_encode([
            'csrf_token'   => csrf_token(),
            'asset_path'   => asset(''),
            'auth'         => Auth::user(),
            'avatars_path' => asset('img/avatars')
        ])
    !!}
</script>
<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>

@extends('layouts.frontApp')

@section('layout')
    @include('layouts.navbar')
        @yield('content')
    @include('layouts.footer')
@endsection

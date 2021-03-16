@extends('layouts.frontApp')

@section('layout')
    @yield('content')
    <right-side-bar :daily-posts="{{ $dailyPosts }}"></right-side-bar>
@endsection
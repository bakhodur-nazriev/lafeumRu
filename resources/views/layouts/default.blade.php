@extends('layouts.frontApp')

@section('layout')
    <left-side-bar :categories="{{ $categories }}"></left-side-bar>
    @yield('content')
    <right-side-bar :daily-posts="{{ $dailyPosts }}"></right-side-bar>
@endsection

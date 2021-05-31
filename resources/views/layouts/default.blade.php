@extends('layouts.frontApp')

@section('layout')
    <v-container>
        <v-row justify="center">
            @yield('content')
            <right-side-bar :daily-posts="{{ $dailyPosts }}"></right-side-bar>
        </v-row>
    </v-container>
@endsection


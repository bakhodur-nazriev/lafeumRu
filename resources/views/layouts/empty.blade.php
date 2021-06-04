@extends('layouts.frontApp')

@section('layout')
    <v-container>
        <v-row justify="center">
            @yield('content')
        </v-row>
    </v-container>
@endsection

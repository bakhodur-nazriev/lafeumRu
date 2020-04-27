@extends('layouts.frontApp')

@section('layout')
    @include('layouts.navbar')
    <div class="pt-0 container" style="max-width: 100%">
        @yield('content')
    </div>
    @include('layouts.footer')
@endsection

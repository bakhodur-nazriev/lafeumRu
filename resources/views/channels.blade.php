@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Каналы YouTube',
        'description' => ''
    ])
@endsection

@section('content')
    <channels :channels="{{ $channels }}"></channels>
@endsection

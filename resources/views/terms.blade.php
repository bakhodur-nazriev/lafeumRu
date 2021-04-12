@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Термины',
        'description' => ''
    ])
@endsection

@section('content')
    <left-side-bar :categories="{{ $categories }}"></left-side-bar>
    <terms></terms>
@endsection

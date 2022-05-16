@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Видео',
        'description' => ''
    ])
@endsection

@section('content')
    <left-side-bar :categories="{{ $categories }}"></left-side-bar>
    <videos></videos>
@endsection
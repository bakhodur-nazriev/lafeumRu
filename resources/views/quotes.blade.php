@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Цитаты, афоризмы и высказывания.',
        'description' => 'Красивые цитаты и афоризмы великих людей, жизненные со смыслом высказывания известнейших поэтов, писателей и философов.',
    ])
@endsection

@section('left-side-bar')
@endsection

@section('content')
    @include('layouts.left-sidebar.leftSideBar', ['type' => 'App\Quote'])

    {{--    <left-side-bar :categories="{{ $categories }}"></left-side-bar>--}}
    <quotes></quotes>
@endsection

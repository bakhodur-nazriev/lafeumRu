@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Цитаты, афоризмы и высказывания.',
        'description' => 'Красивые цитаты и афоризмы великих людей, жизненные со смыслом высказывания известнейших поэтов, писателей и философов.',
        'next' => $quotes->nextPageUrl(),
        'prev' => $quotes->previousPageUrl()
    ])
@endsection

@section('left-side-bar')
    @include('layouts.left-sidebar.leftSidebar', ['type' => 'App\Quote'])
@endsection

@section('content')
    <quotes></quotes>
@endsection

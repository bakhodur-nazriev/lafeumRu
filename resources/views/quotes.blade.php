@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => 'Цитаты, афоризмы и высказывания.',
        'description' => 'Красивые цитаты и афоризмы великих людей, жизненные со смыслом высказывания известнейших поэтов, писателей и философов.',
    ])
@endsection

@section('content')
    @include('layouts.left-sidebar.leftSideBar')

    <quotes></quotes>
@endsection

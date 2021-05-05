@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => $currentAuthor->name . ". Цитаты, афоризмы и высказывания.",
        'description' => $currentAuthor->biography
    ])
@endsection

@section('content')
    <authors-left-sidebar
        :authors="{{ $authors }}"
        :current="{{ $currentAuthor }}"
    ></authors-left-sidebar>
    <author-show
        :current="{{ $currentAuthor }}"
    ></author-show>
@endsection

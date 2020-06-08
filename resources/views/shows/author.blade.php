@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => $currentAuthor->name . ". Цитаты, афоризмы и высказывания.",
        'description' => $currentAuthor->biography
    ])
@endsection

@section('left-side-bar')
<div>
    <h3 class="secondary">Авторы</h3>
    @foreach($authors as $author)
        <a class="d-block" href="/authors/{{$author->slug}}">
            {{ $author->name }}
        </a>
    @endforeach
</div>
@endsection

@section('content')
    <h3 class="secondary mb-2">{{$currentAuthor->name}}</h3>
    <p>{{$currentAuthor->biography}}</p>
    @foreach($currentAuthor->quotes as $quote)
        @include('layouts.quoteItem')
    @endforeach
@endsection

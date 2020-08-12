@extends('layouts.default')

@section('meta-tags')
    @include('layouts.meta-tags', [
        'title' => $currentAuthor->name . ". Цитаты, афоризмы и высказывания.",
        'description' => $currentAuthor->biography
    ])
@endsection

@section('left-side-bar')
    <h3 class="secondary">{{isset($authorListTitle) ? $authorListTitle: 'Авторы'}}</h3>
    <div class="input-group my-2">
        <input
            type="text"
            id="authors-search"
            class="form-control"
            placeholder="Введите имя автора"
        >
    </div>
    <small id="authors-search-result" class="form-text text-muted ml-1"></small>
    <ul class="authors list-inline py-1">
        @foreach($authors as $author)
            <li><a class="categories-color d-block" href="/authors/{{$author->slug}}">{{ $author->name }}</a></li>
        @endforeach
    </ul>
    <script>
        $(document).ready(() => {
            attachSearch(
                "#authors-search",
                ".authors",
                "#authors-search-result"
            )
        })
    </script>
@endsection

@section('content')
    <div class="d-flex">
        <img class="mr-3 mb-3 rounded-circle" style="width: 120px; height: 120px" src="{{$currentAuthor->photo}}" alt="">
        <div>
            <h3 class="secondary mb-2">{{$currentAuthor->name}}</h3>
            <p>{{$currentAuthor->biography}}</p>
        </div>
    </div>
    @foreach($currentAuthor->quotes as $quote)
        @include('layouts.quoteItem')
    @endforeach
@endsection

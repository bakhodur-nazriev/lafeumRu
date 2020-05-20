@extends('layouts.default')

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
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="secondary mb-2">{{$currentAuthor->name}}</h3>
                <p>{{$currentAuthor->biography}}</p>
                @foreach($currentAuthor->quotes as $quote)
                    @include('layouts.quoteItem')
                @endforeach
            </div>
            <button class="btn btn-primary btnScrollToTop">
                <i class="fa fa-arrow-up"></i>
            </button>
        </div>
    </div>
@endsection

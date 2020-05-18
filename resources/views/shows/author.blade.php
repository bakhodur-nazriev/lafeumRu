@extends('layouts.default')

@section('content')
    <div class="left-sidebar-block">
        <h3 class="secondary">Авторы</h3>
        @foreach($authors as $author)
            <a class="d-block" href="/author/{{$author->slug}}">
                {{ $author->name }}
            </a>
        @endforeach
    </div>
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
    @include('layouts.right-sidebar.rightSidebar')
@endsection

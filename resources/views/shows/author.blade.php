@extends('layouts.default')

@section('content')
    <div class="row card-main-block">
        <div class="col-md-3 col-xl-3 col-sm-12 p-0">
            <div class="left-sidebar-block">
                <h3 class="secondary">Авторы</h3>
                @foreach($authors as $author)
                    <div><a href="/author/{{$author->slug}}">{{ $author->name }}</a></div>
                @endforeach
            </div>
        </div>
        <div class="col-md-9 d-flex justify-content-around">
            <div class="col-md-7 col-lg-7">
                <h3 class="secondary mb-2">{{$currentAuthor->name}}</h3>
                <p>{{$currentAuthor->biography}}</p>
                @foreach($currentAuthor->quotes as $quote)
                    @include('layouts.quoteItem')
                @endforeach
            </div>
            @include('layouts.rightSidebar')
        </div>
    </div>
@endsection

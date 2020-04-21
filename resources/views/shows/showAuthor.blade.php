@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row card-main-block">
            <div class="col-md-3 col-sm-12">
                <h3 class="secondary">Авторы</h3>
                @foreach($authors as $author)
                    <div><a href="/author/{{$author->slug}}">{{ $author->name }}</a></div>
                @endforeach
            </div>
            <div class="col-md-9 col-xl-9">
                <h3 class="secondary mb-2">{{$currentAuthor->name}}</h3>
                <p>{{$currentAuthor->biography}}</p>
                @foreach($currentAuthor->quotes as $quote)
                    <div class="card-block">
                        <div class="row px-3 mb-2">
                            <div class="py-0">
                                <a href="#" class="secondary">
                                    <i class="fa fa-user" style="margin-right: 5px;"></i>
                                    {{ $currentAuthor->name }}
                                </a>
                            </div>
                            <div class="col p-0 text-right">
                                <i data-id="{{$quote->id}}"
                                   class="fa fa-star favourite-quote-btn {{$quote->isFavorited() ? " fa-star-active": ""}}"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Избранный"
                                ></i>
                            </div>
                        </div>
                        <div>{{ $quote->body }}</div>
                        <div class="tags-block">
                            @foreach($quote->categories as $cat)
                                <a href="#">
                                    <i class="fa fa-tags"></i>
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                        <div class="my-main-divider"></div>
                        <a class="share-button">
                            <div class="share-text">Поделиться</div>
                            <div class="share"></div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

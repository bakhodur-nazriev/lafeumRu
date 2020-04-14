@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row card-main-block">
            <div class="col-md-3 col-sm-12">
                <h3 class="secondary">Темы</h3>
                @foreach($categories as $category)
                    <div class="categories-main-name">
                        <a href="#"><b>{{ $category->name }}</b></a>
                    </div>
                    @foreach($category->children as $subCategory)
                        <div><a href="#">{{$subCategory->name}}</a></div>
                    @endforeach
                @endforeach
            </div>
            <div class="col-md-9 col-xl-9">
                <h3 class="secondary mb-4">{{$author->name}}</h3>
                <p>{{$author->biography}}</p>
                @foreach($author->quote as $q)
                    <div class="card-block">
                        <div class="row px-3 mb-2">
                            <div class="py-0">
                                {{ $q->body }}
                                <a href="#" class="secondary">
                                    <i class="fa fa-user" style="margin-right: 5px;"></i>
                                    Just Test!
                                </a>
                            </div>
                            <div class="col py-0 text-right">
                                {{--<i data-id="{{$quote->id}}"
                                   class="fa fa-star favourite-quote-btn {{$quote->isFavorited() ? " fa-star-active": ""}}"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Избранный"
                                ></i>--}}
                            </div>
                        </div>
                        <div class="tags-block">
                            @foreach($author->categories as $category)
                                <a href="#">
                                    <i class="fa fa-tags"></i>
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                        <div class="my-main-divider"></div>
                        <div>
                            <button class="btn share-button">Поделиться</button>
                        </div>
                    </div>
                @endforeach
                {{--<div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <div class="row d-flex justify-content-center my-6">
                                 {!! $author->links(); !!}
                            </div>
                        </nav>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
@endsection

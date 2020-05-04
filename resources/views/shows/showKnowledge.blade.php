@extends('layouts.default')

@section('content')
    <div class="row card-main-block">
        <div class="col-md-3 col-sm-12 p-0">
            <div class="left-sidebar-block">
                <h3 class="secondary">Области знаний</h3>
                @foreach($knowledgeAreas as $knowledgeArea)
                    <div><a href="#">{{ $knowledgeArea->name }}</a></div>
                @endforeach
            </div>
        </div>
        <div class="col-md-9 d-flex justify-content-around">
            <div class="col-md-7">

                <h3 class="secondary mb-2">{{ $currentKnowledgeArea->name }}</h3>
                <p>{{ $currentKnowledgeArea->description }}</p>
                @foreach($currentKnowledgeArea->terms as $term)
                    <div class="card-block">
                        <div class="row px-3 mb-2">
                            <div class="py-0">
                                <span>
                                    <i class="fa fa-diamond secondary"></i>
                                    <i class="fa fa-diamond secondary"></i>
                                    <i class="fa fa-diamond secondary"></i>
                                </span>
                            </div>
                            <div class="col p-0 text-right">
                                <i data-id="{{$term->id}}"
                                   class="fa fa-star favourite-quote-btn {{$term->isFavorited() ? " fa-star-active": ""}}"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Избранный"
                                ></i>
                            </div>
                        </div>
                        <div class="mb-1">{!! $term->body !!}</div>
                        <div class="tags-block ">
                            @foreach($term->categories as $category)
                                <a href="#">
                                    <i class="fa fa-tags"></i>
                                    {{ $category->name }}
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
            @include('layouts.rightSidebar')
        </div>
    </div>
@endsection
